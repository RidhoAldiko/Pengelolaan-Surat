<?php

namespace App\Http\Controllers\OperatorSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovalSuratKeluar;
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
                ->orWhere('status','3')//berjalan
                ->orWhere('status','4')//berjalan
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
        $data['tanggal_effort'] = date('Y-m-d H:i:s',strtotime($data['tanggal_effort'] ));
        $create=EffortSurat::create($data);
        $update=SuratKeluar::where('id_surat_keluar', $request->id_surat_keluar)->update(['status' => '0']);
        return redirect()->route('effort-surat.index')->with('status',"Data Approval Surat Masuk berhasil ditambah");
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
        $data['tanggal_surat'] = date('Y-m-d H:i:s',strtotime($data['tanggal_surat'] ));
        $data['tanggal_effort'] = date('Y-m-d H:i:s',strtotime($data['tanggal_effort'] ));
        // dd($data);
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
            'tanggal_effort' => date('Y-m-d H:i:s',strtotime($request->tanggal_effort)),
            ]);
        return redirect()->route('effort-surat.index')->with('status',"Data Approval Surat Keluar berhasil diubah");
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
        TeruskanEffortSurat::where('id_effort_surat',$disposisi->id_effort_surat)->delete();
        $disposisi->delete();
        Storage::delete('public/'.$data->file_surat);
        SuratKeluar::destroy($data->id_surat_keluar);
        return redirect()->route('effort-surat.index')->with('status',"Data Approval Surat Keluar berhasil dihapus");
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
        
        // dd($data);
        $result = SuratKeluar::join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('id_effort_surat',$request->id_effort_surat)
                ->first('surat_keluar.id_surat_keluar');
        $user = User::where('id',$explode)->first();
        Mail::to($user->email)->send(new ApprovalSuratKeluar());
        $create=TeruskanEffortSurat::create($data);
        $update=SuratKeluar::where('id_surat_keluar', $result->id_surat_keluar)->update(['status' => '2']);
        return redirect()->route('effort-surat.index')->with('status',"Approval Surat Keluar berhasil diteruskan kepada pengguna");
    }

    public function arsipkan($id){
        $update=SuratKeluar::where('id_surat_keluar', $id)->update(['status' => '5']);
        return redirect()->route('effort-surat.index')->with('status',"Approval Surat Keluar Berhasil Di Arsipkan");
    }

    public function cetak($id){
        $result = SuratKeluar::select('surat_keluar.*','indeks','id_effort_surat','tanggal_effort')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('id_effort_surat',$id)
                ->first();
        $data = TeruskanEffortSurat::select('teruskan_effort_surat.*', 'nama_pegawai','jabatan.id_jabatan','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian','instruksi')
        ->join('pegawai', 'pegawai.nip_pegawai', '=', 'teruskan_effort_surat.id')
        ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
        ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
        ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
        ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
        ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
        ->where('id_effort_surat','=',$result->id_effort_surat)
        ->orderBy('id_teruskan_effort_surat','ASC')
        ->get();
        return view('operator-surat.effort.effort-surat-cetak', \compact('result','data'));
    }

    public function ingatkan($id){
        $user = User::findOrFail($id);
        // dd($user->email);
        Mail::to($user->email)->send(new ApprovalSuratKeluar());
        return redirect()->route('effort-surat.index')->with('status',"Pengingat approval berhasil dikirim kepada pengguna");
    }
}
