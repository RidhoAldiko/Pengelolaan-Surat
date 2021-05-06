<?php

namespace App\Http\Controllers\OperatorSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Models\SuratMasuk;
use App\Models\User;
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
        return view('operator-surat.surat-masuk.surat-masuk');
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

    public function surat_masuk_serverside(){
        $data = SuratMasuk::where('status','0')->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('pengirim', function($data){ 
                    return $data->pengirim; 
                })
                ->editColumn('nomor_surat', function($data){ 
                    return $data->nomor_surat; 
                })
                ->editColumn('tanggal_surat', function($data){ 
                    return date("d/m/Y", strtotime($data->tanggal_surat));
                })
                ->addColumn('file_surat', function($data) {
                    $file = '<a href="'.Storage::url($data->file_surat).'" target="_blank"> <i class="fa fa-file-pdf fa-2x"></i></a>';
                    return $file;
                })
                ->addColumn('disposisi', function($data) {
                    $button = '
                            <a href="'.route('disposisi-surat-masuk.ignore',$data->id_surat_masuk).'" class="btn btn-danger btn-sm" >
                            <i class="fas fa-times"></i>
                            </a>
                            <a href="'.route('disposisi-surat-masuk.create',$data->id_surat_masuk).'" class="btn btn-success btn-sm" >
                            <i class="fas fa-check"></i>
                            </a>
                            
                            ';
                    return $button;
                })
                ->addColumn('aksi', function($data) {
                    $button = '
                            <a href="'.route('surat-masuk.edit',$data->id_surat_masuk).'" class="btn btn-success text-white btn-sm" title="Edit">
                            <i class="fas fa-info"></i> Detail
                            </a>
                            <a href="'.route('surat-masuk.edit',$data->id_surat_masuk).'" class="btn btn-warning text-white btn-sm" title="Edit">
                            <i class="fas fa-pencil-alt"></i> Edit
                            </a>
                            <a href="#" class="btn btn-danger btn-sm getIdSurat" data-toggle="modal" data-target="#deleteSurat" data-id="'.$data->id_surat.'" >
                                <i class="fas fa-trash fa-sm"></i> Hapus
                            </a>
                            
                            ';
                    return $button;
                })
                ->rawColumns(['file_surat','disposisi','aksi'])
                ->make(true);
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
        // $data = SuratMasuk::select('surat_masuk.*','indeks','tanggal_disposisi')
        //         ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
        //         ->where('status','1')
        //         ->get();
        // dd($data);
        return view('operator-surat.disposisi.disposisi-masuk');
    }

    public function ignore_disposisi($id){
        $update=SuratMasuk::where('id_surat_masuk', $id)->update(['status' => '2']);
        return redirect()->route('disposisi_surat_masuk.index')->with('status',"Surat Masuk tidak di disposisikan");
    }

    public function disposisi_masuk_serverside(){
        $data = SuratMasuk::select('surat_masuk.*','indeks','id_disposisi_surat_masuk','tanggal_disposisi','disposisi_surat_masuk.status')
                ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('indeks', function($data){ 
                    return $data->indeks; 
                })
                ->editColumn('pengirim', function($data){ 
                    return $data->pengirim; 
                })
                ->editColumn('nomor_surat', function($data){ 
                    return $data->nomor_surat; 
                })
                ->editColumn('tanggal_surat', function($data){ 
                    return date("d/m/Y", strtotime($data->tanggal_surat));
                })
                ->editColumn('tanggal_penyelesaian', function($data){ 
                    return date("d/m/Y", strtotime($data->tanggal_disposisi));
                })
                ->addColumn('status', function($data) {
                    if ($data->status == 0) {
                        return "Terdaftar";
                    }else
                    if ($data->status == 1) {
                        return "Berjalan";
                    }
                })
                ->addColumn('aksi', function($data) {
                    if ($data->status == 0) {
                        $button = '
                            <a href="'.route('disposisi-surat-masuk.teruskan',$data->id_disposisi_surat_masuk).'" class="btn btn-primary btn-sm" >
                            <i class="fas fa-angle-right"></i> Teruskan
                            </a>
                            <a href="'.route('surat-masuk.edit',$data->id_disposisi_surat_masuk).'" class="btn btn-success text-white btn-sm" title="Edit">
                            <i class="fas fa-info"></i> Detail
                            </a>
                            <a href="'.route('surat-masuk.edit',$data->id_disposisi_surat_masuk).'" class="btn btn-warning text-white btn-sm" title="Edit">
                            <i class="fas fa-pencil-alt"></i> Edit
                            </a>
                            <a href="#" class="btn btn-danger btn-sm getIdSurat" data-toggle="modal" data-target="#deleteSurat" data-id="'.$data->id_disposisi_surat_masuk.'" >
                                <i class="fas fa-trash fa-sm"></i> Hapus
                            </a>
                            
                            ';
                    }else
                    if ($data->status == 1) {
                        $button = '
                            <a href="'.route('surat-masuk.edit',$data->id_disposisi_surat_masuk).'" class="btn btn-success text-white btn-sm" title="Edit">
                            <i class="fas fa-info"></i> Detail
                            </a>
                            <a href="'.route('surat-masuk.edit',$data->id_disposisi_surat_masuk).'" class="btn btn-warning text-white btn-sm" title="Edit">
                            <i class="fas fa-pencil-alt"></i> Edit
                            </a>
                            <a href="#" class="btn btn-danger btn-sm getIdSurat" data-toggle="modal" data-target="#deleteSurat" data-id="'.$data->id_disposisi_surat_masuk.'" >
                                <i class="fas fa-trash fa-sm"></i> Hapus
                            </a>
                            
                            ';
                    }
                    
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
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
