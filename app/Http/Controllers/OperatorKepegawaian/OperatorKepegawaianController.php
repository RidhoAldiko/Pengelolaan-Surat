<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\PegawaiRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
//inisialisasi model yang digunakan
use App\Models\Pegawai;
use App\Models\Asisten;
use App\Models\Bagian;
use App\Models\SubBagian;
use App\Models\Staf_ahli as Staf;
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

    public function pegawai_serverSide(){
        //get data pegawai 
        $data = Pegawai::select('pegawai.*','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
        ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
        ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
        ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
        ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
        ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
        ->get();
        return DataTables::of($data)
                ->addIndexColumn()
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
                    
                    if($data->id_jabatan < 3) {
                        return '-';
                    } else 
                    if($data->id_jabatan == 3) {
                        return $data->nama_staf_ahli;
                    } else 
                    if($data->id_jabatan == 4) {
                        return $data->nama_asisten;
                    } else 
                    if($data->id_jabatan == 5) {
                        return $data->nama_bagian;
                    } else 
                    if($data->id_jabatan >= 6) {
                        return $data->nama_sub_bagian;
                    }
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
    public function store_pegawai(PegawaiRequest $request){
        $this->validate($request,[
            'nip_pegawai' => 'unique:pegawai'
        ],[
            'nip_pegawai.unique' => 'Nip pegawai tidak boleh sama',
        ]);
        $data = $request->all();
        $data['status'] = 0;
        $store = Pegawai::create($data);

        if ($data['id_jabatan'] < 3) {
            $staf_ahli = Staf::Where('nama_staf_ahli','-')->first('id_staf_ahli');
            $asisten = Asisten::Where('nama_asisten','-')->first('id_asisten');
            $bagian = Bagian::Where('nama_bagian','-')->first('id_bagian');
            $sub_bagian = SubBagian::Where('nama_sub_bagian','-')->first('id_sub_bagian');
            $unit_kerja = Unit::create([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $staf_ahli['id_staf_ahli'],
                'id_asisten' => $asisten['id_asisten'],
                'id_bagian' => $bagian['id_bagian'],
                'id_sub_bagian' => $sub_bagian['id_sub_bagian'],
            ]);
        } else 
        if ($data['id_jabatan'] == 3){
            $asisten = Asisten::Where('nama_asisten','-')->first('id_asisten');
            $bagian = Bagian::Where('nama_bagian','-')->first('id_bagian');
            $sub_bagian = SubBagian::Where('nama_sub_bagian','-')->first('id_sub_bagian');
            $unit_kerja = Unit::create([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $data['id_staf_ahli'],
                'id_asisten' => $asisten['id_asisten'],
                'id_bagian' => $bagian['id_bagian'],
                'id_sub_bagian' => $sub_bagian['id_sub_bagian'],
            ]);
        } else 
        if ($data['id_jabatan'] == 4) {
            $staf_ahli = Staf::Where('nama_staf_ahli','-')->first('id_staf_ahli');
            $bagian = Bagian::Where('nama_bagian','-')->first('id_bagian');
            $sub_bagian = SubBagian::Where('nama_sub_bagian','-')->first('id_sub_bagian');
            $unit_kerja = Unit::create([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $staf_ahli['id_staf_ahli'],
                'id_asisten' => $data['id_asisten'],
                'id_bagian' => $bagian['id_bagian'],
                'id_sub_bagian' => $sub_bagian['id_sub_bagian'],
            ]);
        } else 
        if ($data['id_jabatan'] == 5) {
            $staf_ahli = Staf::Where('nama_staf_ahli','-')->first('id_staf_ahli');
            $sub_bagian = SubBagian::Where('nama_sub_bagian','-')->first('id_sub_bagian');
            $unit_kerja = Unit::create([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $staf_ahli['id_staf_ahli'],
                'id_asisten' => $data['id_asisten'],
                'id_bagian' => $data['id_bagian'],
                'id_sub_bagian' => $sub_bagian['id_sub_bagian'],
            ]);
        }else 
        if ($data['id_jabatan'] > 5) {
            $staf_ahli = Staf::Where('nama_staf_ahli','-')->first('id_staf_ahli');
            $unit_kerja = Unit::create([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $staf_ahli['id_staf_ahli'],
                'id_asisten' => $data['id_asisten'],
                'id_bagian' => $data['id_bagian'],
                'id_sub_bagian' => $data['id_sub_bagian'],
            ]);
        }
        
        
        
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
        $result = Pegawai::select('pegawai.*','nama_jabatan','unit_kerja.id_staf_ahli','unit_kerja.id_asisten','unit_kerja.id_bagian','unit_kerja.id_sub_bagian','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
        ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
        ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
        ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
        ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
        ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
        ->Where('pegawai.nip_pegawai',$id)
        ->first();

        $staf_ahli = Staf::all();
        $asisten = Asisten::all();
        $bagian = Bagian::Where('id_asisten',$result->id_asisten)->get();
        $sub_bagian = SubBagian::Where('id_bagian',$result->id_bagian)->get();
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
        
        return view('operator-kepegawaian.pegawai.pegawai-edit',\compact('jabatan','result','staf_ahli','asisten','bagian','sub_bagian','pegawai','organisasi1','organisasi2','organisasi3','kgb','pangkat_cpns','pangkat_pns'));
    }

    public function update(PegawaiRequest $request, $id)
    {
        $data = $request->all();
        $item   = Pegawai::findOrFail($id);
        $item->update($data);
        if ($data['id_jabatan'] < 3) {
            $staf_ahli = Staf::Where('nama_staf_ahli','-')->first('id_staf_ahli');
            $asisten = Asisten::Where('nama_asisten','-')->first('id_asisten');
            $bagian = Bagian::Where('nama_bagian','-')->first('id_bagian');
            $sub_bagian = SubBagian::Where('nama_sub_bagian','-')->first('id_sub_bagian');
            $unit_kerja = Unit::where('nip_pegawai', $data['nip_pegawai'])->update([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $staf_ahli['id_staf_ahli'],
                'id_asisten' => $asisten['id_asisten'],
                'id_bagian' => $bagian['id_bagian'],
                'id_sub_bagian' => $sub_bagian['id_sub_bagian'],
            ]);
        } else 
        if ($data['id_jabatan'] == 3){
            $asisten = Asisten::Where('nama_asisten','-')->first('id_asisten');
            $bagian = Bagian::Where('nama_bagian','-')->first('id_bagian');
            $sub_bagian = SubBagian::Where('nama_sub_bagian','-')->first('id_sub_bagian');
            $unit_kerja = Unit::where('nip_pegawai', $data['nip_pegawai'])->update([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $data['id_staf_ahli'],
                'id_asisten' => $asisten['id_asisten'],
                'id_bagian' => $bagian['id_bagian'],
                'id_sub_bagian' => $sub_bagian['id_sub_bagian'],
            ]);
        } else 
        if ($data['id_jabatan'] == 4) {
            $staf_ahli = Staf::Where('nama_staf_ahli','-')->first('id_staf_ahli');
            $bagian = Bagian::Where('nama_bagian','-')->first('id_bagian');
            $sub_bagian = SubBagian::Where('nama_sub_bagian','-')->first('id_sub_bagian');
            $unit_kerja = Unit::where('nip_pegawai', $data['nip_pegawai'])->update([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $staf_ahli['id_staf_ahli'],
                'id_asisten' => $data['id_asisten'],
                'id_bagian' => $bagian['id_bagian'],
                'id_sub_bagian' => $sub_bagian['id_sub_bagian'],
            ]);
        } else 
        if ($data['id_jabatan'] == 5) {
            $staf_ahli = Staf::Where('nama_staf_ahli','-')->first('id_staf_ahli');
            $sub_bagian = SubBagian::Where('nama_sub_bagian','-')->first('id_sub_bagian');
            $unit_kerja = Unit::where('nip_pegawai', $data['nip_pegawai'])->update([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $staf_ahli['id_staf_ahli'],
                'id_asisten' => $data['id_asisten'],
                'id_bagian' => $data['id_bagian'],
                'id_sub_bagian' => $sub_bagian['id_sub_bagian'],
            ]);
        }else 
        if ($data['id_jabatan'] > 5) {
            $staf_ahli = Staf::Where('nama_staf_ahli','-')->first('id_staf_ahli');
            $unit_kerja = Unit::where('nip_pegawai', $data['nip_pegawai'])->update([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $staf_ahli['id_staf_ahli'],
                'id_asisten' => $data['id_asisten'],
                'id_bagian' => $data['id_bagian'],
                'id_sub_bagian' => $data['id_sub_bagian'],
            ]);
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
        Unit::where('nip_pegawai',$data_pegawai->nip_pegawai)->delete();
        Pegawai::destroy($data_pegawai->nip_pegawai);
        
        return redirect()->route('data-pegawai.index')->with('status','Data Berhasil Dihapus');
    }

}
