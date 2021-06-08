<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\PegawaiRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
//inisialisasi model yang digunakan
use App\Models\Pegawai;
use App\Models\Unit_kerja as Unit;
use App\Models\Hobi;
use App\Models\Jabatan;
use App\Models\Alamat;
use App\Models\KeteranganBadan;
use App\Models\KeteranganKeluarga;
use App\Models\KeteranganLain;
use App\Models\Mertua;
use App\Models\Mutasi;
use App\Models\OrangtuaKandung;
use App\Models\Organisasi;
use App\Models\PengalamanKeluarNegeri;
use App\Models\Penghargaan;
use App\Models\RiwayatPendidikan;
use App\Models\SaudaraKandung;
use App\Models\DiklatPenjenjangan;
use App\Models\DokumenPegawai;
use App\Models\PangkatCPNS;
use App\Models\PangkatPNS;
use App\Models\RiwayatKGB;
use App\Models\RiwayatPangkat;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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

        $dataKGB             = RiwayatKGB::with(['pegawai','golongan'])->where('status',0)->orderBy('id_riwayat_kgb','desc')->get();
        $datakenaikanpangkat = RiwayatPangkat::with(['pegawai'])->where('status',0)->orderBy('id_riwayat_pangkat','desc')->get();
        
        return view('operator-kepegawaian.dashboard',[
            'total_pegawai'  => Pegawai::count(),
            'total_dokumen'  => DokumenPegawai::count(),
            'total_mutasi'   => Mutasi::count(),
            'total_penghargaan' => Penghargaan::count(),
            'data_kgb'          => $dataKGB,
            'data_pangkat'      => $datakenaikanpangkat
        ]);
    }
    // method form data pegawai
    public function data_pegawai(){
        return view('operator-kepegawaian.pegawai.pegawai');
    }
    // method get server side data pegawai
    public function pegawai_serverSide(){
        //get data pegawai 
        $data = Pegawai::select('pegawai.*','nama_jabatan','nama_unit')
        ->join('unit_kerja','unit_kerja.id_unit','=','pegawai.id_unit' )
        ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        ->get();
        return DataTables::of($data)
                ->editColumn('nip', function($data){ 
                    return $data->nip_pegawai; 
                })
                ->editColumn('nama', function($data){ 
                    return $data->nama_pegawai; 
                })
                ->editColumn('jabatan', function($data){ 
                    return $data->nama_jabatan; 
                })

                ->editColumn('unit', function($data){ 
                    return $data->nama_unit; 
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
                                <a href="'.route('print-pegawai.cetakperorangan',$data->nip_pegawai).'"  target="_blank" class="btn btn-primary text-white btn-sm" title="Edit">
                                <i class="fas fa-print"></i> Print
                                </a>
                                ';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }
    //method form data pegawai
    public function add_pegawai(){
        //get data jabatan
        $jabatan = Jabatan::where('status','=',0)->get();
        return view('operator-kepegawaian.pegawai.pegawai-add',\compact('jabatan'));
    }

    //method store data pegawai
    public function store_pegawai(Request $request){
        
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
        $datapegawai        = Pegawai::with([
                                'jabatan','hobi',
                                'alamat','keterangan_badan',
                                'riwayat_pendidikan',
                                'keterangan_keluarga',
                                'orangtua_kandung',
                                'mertua','saudara_kandung',
                                'penghargaan','pengalaman_keluar_negeri',
                                'organisasi','keterangan_lain',
                                'mutasi','diklat_penjenjangan',
                                'dokumen_pegawai','pangkat_cpns',
                                'pangkat_pns','riwayat_pangkat',
                                'riwayat_kgb',])->where('nip_pegawai',$id)->findOrFail($id);
        
        //untuk mengambil data organisasi pada waktu Semasa SLTA ke bawah                       
        $organisasi1        = Organisasi::where('waktu','Semasa SLTA ke bawah')->where('nip_pegawai',$id)->get();
        //untuk mengambil data organisasi pada waktu Semasa Perguruan Tinggi                      
        $organisasi2        = Organisasi::where('waktu','Semasa Perguruan Tinggi')->where('nip_pegawai',$id)->get();
        //untuk mengambil data organisasi pada waktu Selesai Pendidikan atau Selama Menjadi PNS                      
        $organisasi3        = Organisasi::where('waktu','Selesai Pendidikan atau Selama Menjadi PNS')->where('nip_pegawai',$id)->get();
        $kgb                = RiwayatKGB::with(['golongan'])->where('nip_pegawai',$id)->orderBy('id_riwayat_kgb','desc')->get();
        $pangkatcpns        = PangkatCPNS::with(['golongan'])->where('nip_pegawai',$id)->first();
        $pangkatpns         = PangkatPNS::with(['golongan'])->where('nip_pegawai',$id)->first();

        return view('operator-kepegawaian.pegawai.pegawai-detail',[
            'pegawai'       => $datapegawai,
            'organisasi1'   => $organisasi1,
            'organisasi2'   => $organisasi2,
            'organisasi3'   => $organisasi3,
            'kgb'           => $kgb,
            'pangkat_cpns'  => $pangkatcpns,
            'pangkat_pns'  => $pangkatpns
        ]);
    }

    //method edit data
    public function edit($id)
    {
        //get data jabatan
        $jabatan = Jabatan::where('status','=',0)->get();
        //untuk mendapatkan data pegawai dan data milik pegawai
        $pegawai = Pegawai::with([
                        'jabatan','hobi',
                        'alamat','keterangan_badan',
                        'riwayat_pendidikan',
                        'keterangan_keluarga',
                        'orangtua_kandung',
                        'mertua','saudara_kandung',
                        'penghargaan','pengalaman_keluar_negeri',
                        'organisasi','keterangan_lain',
                        'mutasi','diklat_penjenjangan',
                        'dokumen_pegawai','pangkat_cpns',
                        'pangkat_pns','riwayat_pangkat',
                        'riwayat_kgb'])->where('nip_pegawai',$id)->findOrFail($id);
        //untuk mengambil data organisasi pada waktu Semasa SLTA ke bawah                       
        $organisasi1        = Organisasi::where('waktu','Semasa SLTA ke bawah')->where('nip_pegawai',$id)->get();
        //untuk mengambil data organisasi pada waktu Semasa Perguruan Tinggi                      
        $organisasi2        = Organisasi::where('waktu','Semasa Perguruan Tinggi')->where('nip_pegawai',$id)->get();
        //untuk mengambil data organisasi pada waktu Selesai Pendidikan atau Selama Menjadi PNS                      
        $organisasi3        = Organisasi::where('waktu','Selesai Pendidikan atau Selama Menjadi PNS')->where('nip_pegawai',$id)->get();
        $kgb                = RiwayatKGB::with(['golongan'])->where('nip_pegawai',$id)->orderBy('id_riwayat_kgb','desc')->get();
        $pangkat_cpns        = PangkatCPNS::with(['golongan'])->where('nip_pegawai',$id)->first();
        $pangkat_pns         = PangkatPNS::with(['golongan'])->where('nip_pegawai',$id)->first();
        
        return view('operator-kepegawaian.pegawai.pegawai-edit',\compact('jabatan','pegawai','organisasi1','organisasi2','organisasi3','kgb','pangkat_cpns','pangkat_pns'));
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

        $data = Pegawai::with(['hobi','alamat',
                        'keterangan_badan',
                        'riwayat_pendidikan',
                        'keterangan_keluarga',
                        'orangtua_kandung',
                        'mertua','saudara_kandung',
                        'penghargaan','pengalaman_keluar_negeri',
                        'organisasi','keterangan_lain',
                        'mutasi','diklat_penjenjangan',
                        'dokumen_pegawai','pangkat_cpns',
                        'pangkat_pns','riwayat_pangkat',
                        'riwayat_kgb'])->where('nip_pegawai',$data_pegawai->nip_pegawai)->findOrFail($data_pegawai->nip_pegawai);
    
            //jika databasenya ada alamat maka hapus alamatnya
            if ($data->alamat != null) {
                Alamat::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada hobi maka hapus hobinya
            if ($data->hobi != null) {
                Hobi::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada keterangan badan maka hpus keterangan badanya
            if ($data->keterangan_badan != null) {
                KeteranganBadan::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada riwayat pendidikan maka hpus
            if ($data->riwayat_pendidikan != null) {
                RiwayatPendidikan::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada keterangan keluarga maka hpus
            if ($data->keterangan_keluarga != null) {
                KeteranganKeluarga::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada orang tua kandung maka hpus
            if ($data->orangtua_kandung != null) {
                OrangtuaKandung::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada mertua maka hpus
            if ($data->mertua != null) {
                Mertua::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            } 
            //jika databasenya ada saudara kandung maka hpus
            if ($data->saudara_kandung != null) {
                SaudaraKandung::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada penghargaan maka hpus
            if ($data->penghargaan != null) {
                Penghargaan::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada penghargaan maka hpus
            if ($data->pengalaman_keluar_negeri != null) {
                PengalamanKeluarNegeri::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada organisasi maka hpus
            if ($data->organisasi != null) {
                Organisasi::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada keterangan lain maka hpus
            if ($data->keterangan_lain != null) {
                KeteranganLain::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika databasenya ada mutasi maka hpus
            if ($data->mutasi != null) {
                Mutasi::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika ada diklat hapus 
            if ($data->diklat_penjenjangan != null) {
                DiklatPenjenjangan::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika ada pangkat hapus 
            if ($data->riwayat_pangkat != null) {
                RiwayatPangkat::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika ada pangkat hapus 
            if ($data->pangkat_cpns != null) {
                PangkatCPNS::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika ada pangkat hapus 
            if ($data->pangkat_pns != null) {
                PangkatPNS::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //jika ada pangkat hapus 
            if ($data->riwayat_kgb != null) {
                RiwayatKGB::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //cek apakah ada dokumen atau tidak, jika ada hapus bukti dan datanya
            if ($data->dokumen_pegawai != null) {
                //hapus semua dokumen yang dimiliki
                foreach ($data->dokumen_pegawai as $diklat) {
                    Storage::delete('/public/file_dokumen/'.$diklat->file_dokumen);
                }
                DokumenPegawai::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
            }
            //untuk menghapus foto yang tersimpan
            if ($data->foto) {
                Storage::delete('/public/foto/'.$data->foto);
            }
            
        Pegawai::destroy($data_pegawai->nip_pegawai);
        
        return redirect()->route('data-pegawai.index')->with('status','Data Berhasil Dihapus');
    }

}
