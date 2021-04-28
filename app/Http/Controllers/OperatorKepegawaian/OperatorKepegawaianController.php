<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\PegawaiRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
//inisialisasi model yang digunakan
use App\Models\Pegawai;
use App\Models\Unit_kerja as Unit;
use App\Models\Golongan;
use App\Models\Hobi;
use App\Models\Jabatan;
use App\Models\Alamat;
use App\Models\KeteranganBadan;
use App\Models\RiwayatPendidikan;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;

class OperatorKepegawaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //method dashboad
    public function index()
    {   
        return view('operator-kepegawaian.dashboard');
    }
    // method form data pegawai
    public function data_pegawai(){
        return view('operator-kepegawaian.pegawai.pegawai');
    }
    // method get server side data pegawai
    public function pegawai_serverSide(){
        //get data pegawai 
        $data = Pegawai::select('pegawai.*','nama_unit','nama_golongan','nama_jabatan')
                ->join('unit_kerja', 'unit_kerja.id_unit', '=', 'pegawai.id_unit')
                ->join('golongan', 'golongan.id_golongan', '=', 'pegawai.id_golongan')
                ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
                ->get();
        return DataTables::of($data)
                ->editColumn('nip', function($data){ 
                    return $data->nip_pegawai; 
                })
                ->editColumn('nama', function($data){ 
                    return $data->nama_pegawai; 
                })
                ->editColumn('unit', function($data){ 
                    return $data->nama_unit; 
                })
                ->editColumn('golongan', function($data){ 
                    return $data->nama_golongan; 
                })
                ->editColumn('jabatan', function($data){ 
                    return $data->nama_jabatan; 
                })
                ->editColumn('status', function($data){ 
                    return ($data->status == 0) ? 'Aktif' : 'Nonaktif';
                })
                ->addColumn('aksi', function($data) {
                    $button = ' 
                                <a href="'.route('data-pegawai.show',$data->nip_pegawai).'" class="btn btn-success text-white btn-sm" title="Edit">
                                <i class="fas fa-info"></i> Detail
                                </a>
                                <a href="'.route('data-pegawai.edit',$data->nip_pegawai).'" class="btn btn-warning text-white btn-sm" title="Edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <a href="#" class="btn btn-danger btn-sm getIdPegawai" data-toggle="modal" data-target="#deletePegawai" data-id="'.$data->nip_pegawai.'" >
                                    <i class="fas fa-trash fa-sm"></i> Hapus
                                </a>
                                ';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }
    //method form data pegawai
    public function add_pegawai(){
        //get data unit kerja
        $unit = Unit::where('status','=',0)->get();
        //get data golongan
        $golongan = Golongan::where('status','=',0)->get();
        //get data jabatan
        $jabatan = Jabatan::where('status','=',0)->get();
        return view('operator-kepegawaian.pegawai.pegawai-add',\compact('unit','jabatan','golongan'));
    }

    //method store data pegawai
    public function store_pegawai(PegawaiRequest $request){
        
        $this->validate($request,[
            'nip_pegawai' => 'unique:pegawai'
        ],[
            'nip_pegawai.unique' => 'Nip pegawai tidak boleh sama',
        ]);
        $data = $request->all();
        $data['status'] = 0;
        // dd($data);
        //store data pegawai
        $store = Pegawai::create($data);
       
        return redirect()->route('data-pegawai.index')->with('status',"Data Berhasil Ditambah");
    }

    //method untuk detail pegawai
    public function show($id)
    {
        $datapegawai        = Pegawai::with(['jabatan','golongan','unit_kerja','hobi','alamat','keterangan_badan','riwayat_pendidikan','keterangan_keluarga','orangtua_kandung'])->where('nip_pegawai',$id)->findOrFail($id);
        
        return view('operator-kepegawaian.pegawai.pegawai-detail',[
            'pegawai'       => $datapegawai,
        ]);
    }

    //method edit data
    public function edit($id)
    {
        //get data unit kerja
        $unit = Unit::where('status','=',0)->get();
        //get data golongan
        $golongan = Golongan::where('status','=',0)->get();
        //get data jabatan
        $jabatan = Jabatan::where('status','=',0)->get();
        //untuk mendapatkan data pegawai dan data milik pegawai
        $pegawai = Pegawai::with(['jabatan','golongan','unit_kerja','hobi','alamat','keterangan_badan','riwayat_pendidikan','keterangan_keluarga','orangtua_kandung'])->where('nip_pegawai',$id)->findOrFail($id);
        
        return view('operator-kepegawaian.pegawai.pegawai-edit',\compact('unit','jabatan','golongan','pegawai'));
    }

    public function update(PegawaiRequest $request, $id)
    {
        $data = $request->all();
        $item = Pegawai::findOrFail($id);
        $image = $item->foto;
        $this->validate($request,[
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
        ],[
            'foto.mimes' => 'Format harus PNG/jpg/jpeg',
            'foto.image' => 'Data yang di upload berbentuk foto',
            'foto.max'   => 'Foto maksimal berukuran 2MB'
        ]);
            //cek apakah ada foto yang diupload
            if ($request->hasFile('foto')) {
                    //mengecek apakah yang dinputkan sudah pernah inputkan atau belum
                    if ($image) {
                        //hapus foto yang sudah ada
                        Storage::delete('/public/foto/'.$image);
                    }
                    //simpan foto yang baru distorege
                    $filenameWithExt    = $request->file('foto')->getClientOriginalName();
                    $filename           = pathinfo($filenameWithExt,PATHINFO_FILENAME);
                    $extension          = $request->file('foto')->getClientOriginalExtension();
                    $filenameSimpan     = $filename.'_'.time().'.'.$extension;
                    $path               = $request->file('foto')->storeAs('public/foto',$filenameSimpan);
                    
                    $data['foto']          = $filenameSimpan;
                    $data['tanggal_lahir'] = date('Y-m-d', strtotime($data['tanggal_lahir']));
                    $item->update($data);
                
            }else{
                //jika tidak ada foto simpan data yang ada saja
                $data['tanggal_lahir'] = date('Y-m-d', strtotime($data['tanggal_lahir']));
                $item->update($data);
            }
                
        return redirect()->route('data-pegawai.index')->with('status',"Data Berhasil Edit");
    }
    //metod untuk menghapus data pegawai serta data yang berhubungan dengan pegawai
    public function destroy(Pegawai $data_pegawai)
    {
        $data = Pegawai::with(['hobi','alamat','keterangan_badan'])->where('nip_pegawai',$data_pegawai->nip_pegawai)->findOrFail($data_pegawai->nip_pegawai);
           
            //jika databasenya ada alamat maka hapus alamatnya
            if ($data->alamat->count() > 0) {
                Alamat::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada hobi maka hapus hobinya
            if ($data->hobi->count() > 0) {
                Hobi::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada keterangan badan maka hpus keterangan badanya
            if ($data->keterangan_badan->count() > 0) {
                KeteranganBadan::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //untuk menghapus foto yang tersimpan
            if ($data->foto) {
                Storage::delete('/public/foto/'.$data->foto);
            }
        Pegawai::destroy($data_pegawai->nip_pegawai);
        
        return redirect()->route('data-pegawai.index')->with('status','Data Berhasil Dihapus');
    }

}
