<?php

namespace App\Http\Controllers\UserDisposisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OperatorSurat\TeruskanDisposisiMasukRequest;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Mail;
use App\Mail\DisposisiSurat;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
// use App\Models\Notifikasi;
use App\Models\TeruskanDisposisiMasuk;
use Exception;
use Illuminate\Support\Facades\Storage;

class DataDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //cek id user yang login
        $id = Auth::user()->id;
        //cek level surat user yang login
        $level = User::select('users.*','urutan_level','nama_level')
                ->join('level_surat','level_surat.id_level_surat','=','users.id_level_surat')
                ->where('id',$id)
                ->first();
        //tampilkan disposisi surat masuk berdasarkan id user
        $results = SuratMasuk::select('surat_masuk.*','id_teruskan_surat_masuk','indeks','disposisi_surat_masuk.id_disposisi_surat_masuk','tanggal_disposisi','teruskan_disposisi_masuk.id','teruskan_disposisi_masuk.status as status_teruskan','urutan_level')
                ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->join('teruskan_disposisi_masuk', 'teruskan_disposisi_masuk.id_disposisi_surat_masuk', '=', 'disposisi_surat_masuk.id_disposisi_surat_masuk')
                ->join('users','users.id','=','teruskan_disposisi_masuk.id')
                ->join('level_surat','level_surat.id_level_surat','=','users.id_level_surat')
                ->where('urutan_level',$level->urutan_level)
                ->where('surat_masuk.status','2')
                ->where('users.id',$id)
                ->get();
        
        // dd($results);
        return view('user-disposisi.disposisi.disposisi',\compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('user-disposisi.disposisi.disposisi-forward',['id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeruskanDisposisiMasukRequest $request){
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
        // $data['id_disposisi_surat_masuk']
        
        $result = SuratMasuk::join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->where('id_disposisi_surat_masuk',$request->id_disposisi_surat_masuk)
                ->first('surat_masuk.id_surat_masuk');

        $user = User::where('id',$explode)->first();
        try {
            Mail::to($user->email)->send(new DisposisiSurat());
            TeruskanDisposisiMasuk::where('id_disposisi_surat_masuk', $data['id_disposisi_surat_masuk'])->update(['status' => '1']);
            TeruskanDisposisiMasuk::create($data);
            return redirect()->route('data-disposisi.index')->with('status',"Disposisi Surat Masuk berhasil diteruskan kepada pengguna");
        } catch (Exception $ex) {
            return redirect()->route('data-disposisi.forward',$request->id_disposisi_surat_masuk)->with('warning',"Koneksi internet anda tidak stabil, disposisi Surat Masuk gagal diteruskan kepada pengguna,Silahkan ulangi!");
        }
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
        return view('user-disposisi.disposisi.disposisi-detail',\compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function finish($id){
        
        $result = SuratMasuk::select('surat_masuk.*','indeks','disposisi_surat_masuk.id_disposisi_surat_masuk','tanggal_disposisi','id_teruskan_surat_masuk')
                ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->join('teruskan_disposisi_masuk', 'teruskan_disposisi_masuk.id_disposisi_surat_masuk', '=', 'disposisi_surat_masuk.id_disposisi_surat_masuk')
                ->where('disposisi_surat_masuk.id_surat_masuk',$id)
                ->first();
                
        // dd($result->id_disposisi_surat_masuk);
        TeruskanDisposisiMasuk::where('id_disposisi_surat_masuk', $result->id_disposisi_surat_masuk)->update(['status' => '1']);
        SuratMasuk::where('id_surat_masuk', $result->id_surat_masuk)->update(['status' => '3']);
        return redirect()->route('data-disposisi.index')->with('status',"Data Disposisi Surat Masuk berhasil di selesaikan");
    }

}
