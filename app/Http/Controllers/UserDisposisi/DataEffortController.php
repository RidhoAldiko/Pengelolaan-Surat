<?php

namespace App\Http\Controllers\UserDisposisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovalSuratKeluar;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratKeluar;
use App\Models\TeruskanEffortSurat;
use App\Models\User;
use App\Models\Pegawai;
use Exception;

class DataEffortController extends Controller
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
        $results = SuratKeluar::select('surat_keluar.*','id_teruskan_effort_surat','indeks','effort_surat_keluar.id_effort_surat','tanggal_effort','teruskan_effort_surat.id','teruskan_effort_surat.status as status_teruskan','urutan_level')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->join('teruskan_effort_surat', 'teruskan_effort_surat.id_effort_surat', '=', 'effort_surat_keluar.id_effort_surat')
                ->join('users','users.id','=','teruskan_effort_surat.id')
                ->join('level_surat','level_surat.id_level_surat','=','users.id_level_surat')
                ->where('urutan_level',$level->urutan_level)
                ->where('surat_keluar.status','2')
                ->where('users.id',$id)
                ->get();
        // dd($results);
        return view('user-disposisi.effort.effort',\compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $result = Pegawai::select('pegawai.*','nama_jabatan')
                            ->join('jabatan','jabatan.id_jabatan','=' , 'pegawai.id_jabatan')
                            ->where('jabatan.id_jabatan',1)
                            ->orWhere('jabatan.id_jabatan',2)
                            ->get();
        return view('user-disposisi.effort.effort-forward',['id'=>$id],\compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $level = Auth::user()->id_level_surat;
        $data = $request->all();
        
        if ($level > 4 ) {
            $explode = explode(' - ',$request->id,-1);
            //masukan nip ke variabel data['id]
            $data ['id'] = $explode[0];
        } else {
            $explode = $data['id'];
        }
        $data ['status'] = '0';
        $user = User::where('id',$explode)->first();
        // dd($data);
        $result = SuratKeluar::join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('id_effort_surat',$request->id_effort_surat)
                ->first('surat_keluar.id_surat_keluar');
        $user = User::where('id',$explode)->first();
        
        try {
            Mail::to($user->email)->send(new ApprovalSuratKeluar());
            TeruskanEffortSurat::where('id_effort_surat', $data['id_effort_surat'])->update(['status' => '1']);
            TeruskanEffortSurat::create($data);
            SuratKeluar::where('id_surat_keluar', $result->id_surat_keluar)->update(['status' => '2']);
            return redirect()->route('data-effort.index')->with('status',"Approval Surat Keluar berhasil diteruskan kepada pengguna");
        } catch (Exception $ex) {
            return redirect()->route('data-effort.index')->with('warning',"Koneksi internet anda tidak stabil, apporval gagal diteruskan kepada pengguna, silahkan ulangi lagi!");
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
        $result = SuratKeluar::select('surat_keluar.*','indeks','id_effort_surat','tanggal_effort')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('id_effort_surat',$id)
                ->first();
        // dd($result);
        return view('user-disposisi.effort.effort-detail',\compact('result'));
    }

    
    public function finish($id){

        $result = SuratKeluar::select('surat_keluar.*','indeks','id_effort_surat','tanggal_effort')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('effort_surat_keluar.id_surat_keluar',$id)
                ->first();
        SuratKeluar::where('id_surat_keluar', $id)->update(['status' => '3']);
        TeruskanEffortSurat::where('id_effort_surat', $result->id_effort_surat)->update(['status' => '1']);
        return redirect()->route('data-effort.index')->with('status',"Approval Surat Masuk berhasil di selesaikan");
    }

    public function ignore($id){
        $result = SuratKeluar::select('surat_keluar.*','indeks','id_effort_surat','tanggal_effort')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('effort_surat_keluar.id_surat_keluar',$id)
                ->first();
        SuratKeluar::where('id_surat_keluar', $id)->update(['status' => '4']);
        TeruskanEffortSurat::where('id_effort_surat', $result->id_effort_surat)->update(['status' => '1']);
        return redirect()->route('data-effort.index')->with('status',"Approval Surat Masuk berhasil ditolak");
    }

    
}
