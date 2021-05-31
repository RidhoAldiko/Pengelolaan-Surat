<?php

namespace App\Http\Controllers\OperatorSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EffortSuratKeluar;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\OperatorSurat\EffortSuratRequest;
use App\Http\Requests\OperatorSurat\TeruskanEffortSuratRequest;
use App\Http\Requests\OperatorSurat\SuratKeluarRequest;
use App\Models\EffortSuratKeluar as EffortSurat;
use App\Models\SuratKeluar;
use App\Models\User;
use App\Models\TeruskanEffortSurat;

class EffortSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = SuratKeluar::select('surat_keluar.*','indeks','id_effort_surat','tanggal_effort')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('status','0')//terdaftar
                ->orWhere('status','2')//berjalan
                ->get();
        // dd($results);
        return view('operator-surat.effort.effort-surat',\compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('operator-surat.surat-keluar.surat-keluar-effort',['id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EffortSuratRequest $request)
    {
        $data = $request->all();
        $create=EffortSurat::create($data);
        $update=SuratKeluar::where('id_surat_keluar', $request->id_surat_keluar)->update(['status' => '0']);
        return redirect()->route('effort-surat.index')->with('status',"Data Effort Surat Masuk berhasil ditambah");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = SuratKeluar::select('surat_keluar.*','indeks','id_effort_surat','tanggal_effort')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('id_effort_surat',$id)
                ->first();
        // dd($result);
        return view('operator-surat.effort.effort-surat-detail',\compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = SuratKeluar::select('surat_keluar.*','indeks','id_effort_surat','tanggal_effort')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('id_effort_surat',$id)
                ->first();
        // dd($result);
        return view('operator-surat.effort.effort-surat-edit',\compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuratKeluarRequest $request, $id)
    {
        $data = $request->all();
        $surat = SuratKeluar::findOrFail($id);
        if ($request->hasFile('file_surat')) {
            // jika file surat ada
            if ($surat->file_surat) {
                // hapus file surat di folder public
                Storage::delete('public/'.$surat->file_surat);
            }
            // simpan file yang diupload ke folder assets/honorer yang ada di public lalu simpan dalam variable data[foto]
            $data['file_surat'] = $request->file('file_surat')->store(
                'assets/surat-keluar','public'
            );
        }
        //update data surat
        $surat->update($data);
        //update data disposisi surat
        $update = EffortSurat::where('id_surat_keluar',$id)->update([
            'indeks' => $request->indeks,
            'tanggal_effort' => $request->tanggal_effort,
            ]);
        return redirect()->route('effort-surat.index')->with('status',"Data Effort Surat Keluar berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratKeluar $data)
    {
        $disposisi = EffortSurat::where('id_surat_keluar',$data->id_surat_keluar)->first();
        $disposisi->delete();
        Storage::delete('public/'.$data->file_surat);
        SuratKeluar::destroy($data->id_surat_keluar);
        return redirect()->route('effort-surat.index')->with('status',"Data Effort Surat Keluar berhasil dihapus");
    }

    public function forward($id){
        return view('operator-surat.effort.effort-surat-forward',['id'=>$id]);
    }

    public function store_forward(TeruskanEffortSuratRequest $request){
        $data = $request->all();
        $explode = explode(' - ',$request->id,-1);
        //masukan nip ke variabel data['id]
        $data ['id'] = $explode[0];
        $data ['status'] = '0';
        $result = SuratKeluar::join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('id_effort_surat',$request->id_effort_surat)
                ->first('surat_keluar.id_surat_keluar');
        $user = User::where('id',$explode)->first();
        Mail::to($user->email)->send(new EffortSuratKeluar());
        $create=TeruskanEffortSurat::create($data);
        $update=SuratKeluar::where('id_surat_keluar', $result->id_surat_keluar)->update(['status' => '2']);
        return redirect()->route('effort-surat.index')->with('status',"Effort Surat Keluar berhasil diteruskan kepada pengguna");
    }
}
