<?php

namespace App\Http\Controllers\OperatorSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\DisposisiSurat;
use Yajra\DataTables\DataTables;
use App\Models\SuratMasuk;
use App\Models\User;
use App\Http\Requests\OperatorSurat\SuratMasukRequest;
use App\Http\Requests\OperatorSurat\DisposisiMasukRequest;
use App\Http\Requests\OperatorSurat\TeruskanDisposisiMasukRequest;
use App\Models\DisposisiSuratMasuk as DisposisiMasuk;
use App\Models\TeruskanDisposisiMasuk;
use App\Models\Notifikasi;

class DisposisiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = SuratMasuk::select('surat_masuk.*','indeks','id_disposisi_surat_masuk','tanggal_disposisi')
                ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->where('status','0')//terdaftar
                ->orWhere('status','2')//berjalan
                ->get();
        return view('operator-surat.disposisi.disposisi-surat',\compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('operator-surat.surat-masuk.surat-masuk-disposisi',["id"=>$id]);
    }

    //method jangan disposisikan surat masuk
    public function ignore($id){
        $update=SuratMasuk::where('id_surat_masuk', $id)->update(['status' => '1']);
        return redirect()->route('arsip-surat-masuk.index')->with('status',"Surat Masuk berhasil diarsipkan");
    }

    //method teruskan disposisi surat masuk
    public function forward($id){
        return view('operator-surat.disposisi.disposisi-teruskan',["id"=>$id]);
    }

    public function store_forward(TeruskanDisposisiMasukRequest $request){
        $data = $request->all();
        $explode = explode(' - ',$request->id,-1);
        //masukan nip ke variabel data['id]
        $data ['id'] = $explode[0];
        $data ['status'] = '0';
        Notifikasi::create($notif = [
            'judul' => 'Disposisi Surat Masuk',
            'pesan' =>'Disposisi surat belum diteruskan',
            'id_user' => $explode[0],
            'status' => '0',
        ]);
        $result = SuratMasuk::join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->where('id_disposisi_surat_masuk',$request->id_disposisi_surat_masuk)
                ->first('surat_masuk.id_surat_masuk');
        $user = User::where('id',$explode)->first();
        Mail::to($user->email)->send(new DisposisiSurat());
        $create=TeruskanDisposisiMasuk::create($data);
        $update=SuratMasuk::where('id_surat_masuk', $result->id_surat_masuk)->update(['status' => '2']);
        return redirect()->route('disposisi-surat-masuk.index')->with('status',"Disposisi Surat Masuk berhasil diteruskan kepada pengguna");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisposisiMasukRequest $request)
    {
        $data = $request->all();
        $create=DisposisiMasuk::create($data);
        $update=SuratMasuk::where('id_surat_masuk', $request->id_surat_masuk)->update(['status' => '0']);
        return redirect()->route('disposisi-surat-masuk.index')->with('status',"Data Disposisi Surat Masuk berhasil ditambah");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = SuratMasuk::select('surat_masuk.*','indeks','id_disposisi_surat_masuk','tanggal_disposisi')
                ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->where('id_disposisi_surat_masuk',$id)
                ->first();
        return view('operator-surat.disposisi.disposisi-detail',\compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = SuratMasuk::select('surat_masuk.*','indeks','id_disposisi_surat_masuk','tanggal_disposisi')
                ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->where('id_disposisi_surat_masuk',$id)
                ->first();
        return view('operator-surat.disposisi.diposisi-edit',\compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuratMasukRequest $request, $id)
    {
        $data = $request->all();
        $surat = SuratMasuk::findOrFail($id);
        if ($request->hasFile('file_surat')) {
            // jika file surat ada
            if ($surat->file_surat) {
                // hapus file surat di folder public
                Storage::delete('public/'.$surat->file_surat);
            }
            // simpan file yang diupload ke folder assets/honorer yang ada di public lalu simpan dalam variable data[foto]
            $data['file_surat'] = $request->file('file_surat')->store(
                'assets/surat-masuk','public'
            );
        }
        //update data surat
        $surat->update($data);
        //update data disposisi surat
        $update = DisposisiMasuk::where('id_surat_masuk',$id)->update([
            'indeks' => $request->indeks,
            'tanggal_disposisi' => $request->tanggal_disposisi,
            ]);
        return redirect()->route('disposisi-surat-masuk.index')->with('status',"Data Disposisi Surat Masuk berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratMasuk $data)
    {
        $disposisi = DisposisiMasuk::where('id_surat_masuk',$data->id_surat_masuk)->first();
        $disposisi->delete();
        Storage::delete('public/'.$data->file_surat);
        SuratMasuk::destroy($data->id_surat_masuk);
        return redirect()->route('disposisi-surat-masuk.index')->with('status',"Data Disposisi Surat Masuk berhasil dihapus");
    }
}
