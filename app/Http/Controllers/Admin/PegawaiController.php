<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OperatorKepegawaian\PegawaiRequest;
use Yajra\DataTables\DataTables;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Unit_kerja as Unit;
use App\Models\Hobi;
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
use App\Models\Jabatan;
use App\Models\Asisten;
use App\Models\Bagian;
use App\Models\SubBagian;
use App\Models\Staf_ahli as Staf;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $data = Pegawai::select('pegawai.*','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
        // ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        // ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
        // ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
        // ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
        // ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
        // ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
        // ->get();
        // return $data;
        return view('admin.pegawai.pegawai');
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
                                <a href="'.route('admin-pegawai.show',$data->nip_pegawai).'" class="btn btn-success text-white btn-sm" title="Edit">
                                <i class="fas fa-info"></i> Detail
                                </a>
                                <a href="'.route('admin-pegawai.edit',$data->nip_pegawai).'" class="btn btn-warning text-white btn-sm" title="Edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                ';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }
    
    public function create(){
        $jabatan = Jabatan::where('status','=',0)->get();
        return view('admin.pegawai.pegawai-create',\compact('jabatan'));
    }

    public function store(PegawaiRequest $request){
        $this->validate($request,[
            'nip_pegawai' => 'unique:pegawai'
        ],[
            'nip_pegawai.unique' => 'Nip pegawai tidak boleh sama',
        ]);
        $data = $request->all();
        $data['status'] = 0;
        $data['tanggal_lahir'] = date('Y-m-d H:i:s',strtotime($data['tanggal_lahir'] ));
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
        
        
        
        return redirect()->route('admin-pegawai.index')->with('status',"Data Berhasil Ditambah");
    }

    public function edit($id){
        $jabatan = Jabatan::all();
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
        // dd($result);


        return view('admin.pegawai.pegawai-edit',\compact('result','jabatan','staf_ahli','asisten','bagian','sub_bagian'));
    }

    public function update(Request $request,$id){
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
            User::where('id', $data['nip_pegawai'])->update(['id_level_surat' => $data['id_jabatan']]);
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
            User::where('id', $data['nip_pegawai'])->update(['id_level_surat' => $data['id_jabatan']]);
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
            User::where('id', $data['nip_pegawai'])->update(['id_level_surat' => $data['id_jabatan']]);
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
            User::where('id', $data['nip_pegawai'])->update(['id_level_surat' => $data['id_jabatan']]);
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
            User::where('id', $data['nip_pegawai'])->update(['id_level_surat' => $data['id_jabatan']]);
        }
        
        return redirect()->route('admin-pegawai.index')->with('status',"Data Berhasil Diubah");

    }

    public function show($id){
        $result = Pegawai::select('pegawai.*','nama_jabatan','unit_kerja.id_staf_ahli','unit_kerja.id_asisten','unit_kerja.id_bagian','unit_kerja.id_sub_bagian','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
        ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
        ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
        ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
        ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
        ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
        ->Where('pegawai.nip_pegawai',$id)
        ->first();
        return view('admin.pegawai.pegawai-detail',\compact('result'));
    }

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
        
        return redirect()->route('admin-pegawai.index')->with('status',"Data Berhasil Dihapus");
    }
}
