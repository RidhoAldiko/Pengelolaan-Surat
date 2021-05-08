<?php

namespace App\Http\Controllers\OperatorSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Models\SuratMasuk;
use App\Models\User;
use App\Http\Requests\OperatorSurat\SuratMasukRequest;
use App\Models\DisposisiSuratMasuk as DisposisiMasuk;
use App\Models\TeruskanDisposisiMasuk;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $results = SuratMasuk::where('status','0')->get();
        return view('operator-surat.surat-masuk.surat-masuk',\compact('results'));
    }

    function search_pengguna(Request $request)
    {
        if ($request->has('data')) {
            $data = $request->data;
            //get nip pegawai 
            // $results = User::where('id', 'LIKE' ,'%' . $data . '%')
            //                     ->get();
            $results = User::select('users.*','nama_pegawai','pegawai.id_jabatan','nama_jabatan','unit_kerja.id_unit','nama_unit')
                ->join('pegawai', 'nip_pegawai', '=', 'users.id')
                ->join('unit_kerja', 'unit_kerja.id_unit', '=', 'pegawai.id_unit')
                ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
                ->where('nama_pegawai', 'LIKE' ,'%' . $data . '%')
                ->orWhere('nama_unit', 'LIKE' ,'%' . $data . '%')
                ->get();
            //make output
            $output = '<div class="list-group  mt-2">';
            //cek jika data tersedia
            if ($results->count() >= 1) {
                //looping data
                foreach ($results as $result) {
                    //concat output untuk menampilkan data
                    $output .= '
                        <a href="#" class="list-group-item list-group-item-action">'
                            .$result->id. ' - '. $result->nama_jabatan .' - '. $result->nama_unit . '  
                        </a>
                    ';
                }
            }
            //jika data tidak tersedia
            else { 
                // concat output untuk menampilkan message
                $output .= '
                        <li href="#" class="list-group-item list-group-item-action">
                            Peengguna tidak ditemukan ini!
                        </li>
                    ';
            }
            //concat output tutup dari div
            $output .= '</div>';
            //menampilkan output
            echo $output;
        } else {
            return view('admin.pengguna.pengguna-add');
        }
    }

    public function disposisi($id){
        
        return view('operator-surat.surat-masuk.surat-masuk-disposisi',["id"=>$id]);
    }

    public function disposisi_store(Request $request){
        $data = $request->all();
        $data['status'] = '0';//terdaftar
        // dd($data);
        $create=DisposisiMasuk::create($data);
        $update=SuratMasuk::where('id_surat_masuk', $request->id_surat_masuk)->update(['status' => '1']);
        return redirect()->route('disposisi_surat_masuk.index')->with('status',"Data Disposisi Surat Masuk berhasil ditambah");
    }

    public function data_disposisi(){
        $results = SuratMasuk::select('surat_masuk.*','indeks','id_disposisi_surat_masuk','tanggal_disposisi','disposisi_surat_masuk.status')
                ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->where('disposisi_surat_masuk.status','1')
                ->orWhere('disposisi_surat_masuk.status','0')
                ->get();
        return view('operator-surat.disposisi.disposisi-masuk',\compact('results'));
    }

    public function ignore_disposisi($id){
        $update=SuratMasuk::where('id_surat_masuk', $id)->update(['status' => '2']);
        return redirect()->route('arsip-surat-masuk.index')->with('status',"Surat Masuk berhasil diarsipkan");
    }

    public function teruskan_disposisi($id){
        return view('operator-surat.disposisi.disposisi-teruskan',["id"=>$id]);
    }

    public function teruskan_disposisi_store(Request $request){
        $data = $request->all();
        $explode = explode(' - ',$request->id,-1);
        //masukan nip ke variabel data['id]
        $data ['id'] = $explode[0];
        $create=TeruskanDisposisiMasuk::create($data);
        $update=DisposisiMasuk::where('id_disposisi_surat_masuk', $request->id_disposisi_surat_masuk)->update(['status' => '1']);
        return redirect()->route('disposisi_surat_masuk.index')->with('status',"Disposisi Surat Masuk berhasil diteruskan kepada pengguna");
    }
    public function create()
    {
        return view('operator-surat.surat-masuk.surat-masuk-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuratMasukRequest $request)
    {
        $data = $request->all();
        $data['file_surat'] = $request->file('file_surat')->store(
            'assets/surat-masuk','public'
        );
        $data['status'] = '0';//0= disposisi
        $create=SuratMasuk::create($data);
        return redirect()->route('surat-masuk.index')->with('status',"Data surat masuk berhasil ditambah");
    }

    
}
