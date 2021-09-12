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
use Exception;

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
                ->orWhere('status','3')//berjalan
                ->orderBy('id_disposisi_surat_masuk','DESC')
                ->get();
        return view('operator-surat.disposisi.disposisi-surat',\compact('results'));
    }

    public function ingatkan($id){
        $user = User::findOrFail($id);
        
        try {
            Mail::to($user->email)->send(new DisposisiSurat());
            return redirect()->route('disposisi-surat-masuk.index')->with('status',"Pengingat disposisi berhasil diteruskan kepada pengguna");
        } catch (Exception $ex) {
            return redirect()->route('disposisi-surat-masuk.index')->with('warning',"Koneksi internet anda tidak stabil, disposisi gagal diteruskan kepada pengguna, silahkan ulangi lagi!");
        }
        
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
        return redirect()->route('surat-masuk.index')->with('status',"Surat Masuk berhasil diarsipkan");
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
        // Notifikasi::create($notif = [
        //     'judul' => 'Disposisi Surat Masuk',
        //     'pesan' =>'Disposisi surat belum diteruskan',
        //     'id_user' => $explode[0],
        //     'status' => '0',
        // ]);
        $result = SuratMasuk::join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->where('id_disposisi_surat_masuk',$request->id_disposisi_surat_masuk)
                ->first('surat_masuk.id_surat_masuk');
        $user = User::where('id',$explode)->first();
        
        try {
            Mail::to('coba@gmail.com')->send(new DisposisiSurat());
            TeruskanDisposisiMasuk::create($data);
            SuratMasuk::where('id_surat_masuk', $result->id_surat_masuk)->update(['status' => '2']);
            return redirect()->route('disposisi-surat-masuk.index')->with('status',"Disposisi Surat Masuk berhasil diteruskan kepada pengguna");
        } catch (Exception $ex) {
            return redirect()->route('disposisi-surat-masuk.forward',$request->id_disposisi_surat_masuk)->with('warning',"Koneksi internet anda tidak stabil, disposisi Surat Masuk gagal diteruskan kepada pengguna,Silahkan ulangi!");
            
        }
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
        $data['tanggal_disposisi'] = date('Y-m-d H:i:s',strtotime($data['tanggal_disposisi'] ));
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
        $data['tanggal_surat'] = date('Y-m-d H:i:s',strtotime($data['tanggal_surat'] ));
        $data['tanggal_disposisi'] = date('Y-m-d H:i:s',strtotime($data['tanggal_disposisi'] ));
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
            'tanggal_disposisi' => date('Y-m-d H:i:s',strtotime($request->tanggal_disposisi)),
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

    public function cetak_disposisi($id){
        $result = SuratMasuk::select('surat_masuk.*','indeks','id_disposisi_surat_masuk','tanggal_disposisi')
        ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
        ->where('id_disposisi_surat_masuk',$id)
        ->first();
        $data = TeruskanDisposisiMasuk::select('teruskan_disposisi_masuk.*', 'nama_pegawai','jabatan.id_jabatan','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
        ->join('pegawai', 'pegawai.nip_pegawai', '=', 'teruskan_disposisi_masuk.id')
        ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
        ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
        ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
        ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
        ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
        ->where('id_disposisi_surat_masuk','=',$result->id_disposisi_surat_masuk)
        ->orderBy('id_teruskan_surat_masuk','ASC')
        ->get();
        
        return view('operator-surat.disposisi.cetak_disposisi',\compact('result','data'));
    }

    public function arsip($id){
        $update=SuratMasuk::where('id_surat_masuk', $id)->update(['status' => '4']);
        return redirect()->route('disposisi-surat-masuk.index')->with('status',"Data Disposisi Surat Masuk berhasil diarsipkan");
    }
}
