<?php

namespace App\Http\Controllers\UserDisposisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SuratMasuk;
use App\Models\Notifikasi;
use App\Models\SuratKeluar;
use Illuminate\Support\Facades\Auth;

class UserDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        //cek level surat user yang login
        $level = User::select('users.*','urutan_level','nama_level')
                ->join('level_surat','level_surat.id_level_surat','=','users.id_level_surat')
                ->where('id',$id)
                ->first();
        //tampilkan disposisi surat masuk berdasarkan id user
        $disposisi = SuratMasuk::select('surat_masuk.*','id_teruskan_surat_masuk','indeks','disposisi_surat_masuk.id_disposisi_surat_masuk','tanggal_disposisi','teruskan_disposisi_masuk.id','teruskan_disposisi_masuk.status as status_teruskan','urutan_level')
                ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->join('teruskan_disposisi_masuk', 'teruskan_disposisi_masuk.id_disposisi_surat_masuk', '=', 'disposisi_surat_masuk.id_disposisi_surat_masuk')
                ->join('users','users.id','=','teruskan_disposisi_masuk.id')
                ->join('level_surat','level_surat.id_level_surat','=','users.id_level_surat')
                ->where('urutan_level',$level->urutan_level)
                ->where('surat_masuk.status','2')
                ->where('teruskan_disposisi_masuk.status','0')
                ->where('users.id',$id)
                ->count();

        $approval = SuratKeluar::select('surat_keluar.*','id_teruskan_effort_surat','indeks','effort_surat_keluar.id_effort_surat','tanggal_effort','teruskan_effort_surat.id','teruskan_effort_surat.status as status_teruskan','urutan_level')
        ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
        ->join('teruskan_effort_surat', 'teruskan_effort_surat.id_effort_surat', '=', 'effort_surat_keluar.id_effort_surat')
        ->join('users','users.id','=','teruskan_effort_surat.id')
        ->join('level_surat','level_surat.id_level_surat','=','users.id_level_surat')
        ->where('urutan_level',$level->urutan_level)
        ->where('surat_keluar.status','2')
        ->where('teruskan_effort_surat.status','0')
        ->where('users.id',$id)
        ->count();
        // dd($approval);
        return \view('user-disposisi.dashboard',compact('disposisi','approval'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function notifikasi(){
    //     $id = Auth::user()->id;
    //     $results = Notifikasi::where('id_user',$id)->get();
        
    //     foreach ($results as $result) {
    //         $output = ' <div class="dropdown-list-content dropdown-list-message">
    //                     <a href="#" class="dropdown-item dropdown-item-unread">
    //                     <div class="dropdown-item">';
    //         $output .= '<b>'.$result->judul.'</b>';
    //         $output .= '<p>'.$result->pesan.'</p>';
    //         $output .= '</div>
    //             </a>
    //         </div>';
    //     }    
        
    //     echo $output;
    // }
    function search_tujuan(Request $request)
    {
        if ($request->has('data')) {
            $data = $request->data;
            $results = User::select('users.*','jabatan.id_jabatan','nama_pegawai','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
                ->join('pegawai', 'nip_pegawai', '=', 'users.id')
                ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
                ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
                ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
                ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
                ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
                ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
                ->where('nama_pegawai', 'LIKE' ,'%' . $data . '%')
                ->orWhere('nama_jabatan', 'LIKE' ,'%' . $data . '%')
                ->orWhere('nama_staf_ahli', 'LIKE' ,'%' . $data . '%')
                ->orWhere('nama_asisten', 'LIKE' ,'%' . $data . '%')
                ->orWhere('nama_bagian', 'LIKE' ,'%' . $data . '%')
                ->orWhere('nama_sub_bagian', 'LIKE' ,'%' . $data . '%')
                ->get();
            //make output
            $output = '<div class="list-group  mt-2">';
            //cek jika data tersedia
            if ($results->count() >= 1) {
                //looping data
                foreach ($results as $result) {
                    //concat output untuk menampilkan data
                    if ($result->id_jabatan < 3 ) {
                        $output .= '
                        <a href="#" class="list-group-item list-group-item-action">'
                            .$result->id. ' - '. $result->nama_jabatan .'
                        </a>
                    ';
                    } else
                    if ($result->id_jabatan == 3 ) {
                        $output .= '
                        <a href="#" class="list-group-item list-group-item-action">'
                            .$result->id. ' - '. $result->nama_jabatan .' - '. $result->nama_staf_ahli . '  
                        </a>
                    ';
                    } else
                    if ($result->id_jabatan == 4 ) {
                        $output .= '
                        <a href="#" class="list-group-item list-group-item-action">'
                            .$result->id. ' - '. $result->nama_jabatan .' - '. $result->nama_asisten . '  
                        </a>
                    ';
                    } else
                    if ($result->id_jabatan == 5 ) {
                        $output .= '
                        <a href="#" class="list-group-item list-group-item-action">'
                            .$result->id. ' - '. $result->nama_jabatan .' - '. $result->nama_bagian . '  
                        </a>
                    ';
                    } else
                    if ($result->id_jabatan == 6 ) {
                        $output .= '
                        <a href="#" class="list-group-item list-group-item-action">'
                            .$result->id. ' - '. $result->nama_jabatan .' - '. $result->nama_sub_bagian . '  
                        </a>
                    ';
                    }
                    
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


    function search_pengguna(Request $request)
    {
        
        if ($request->has('data')) {
            $data = $request->data;
            //cek level surat user login
            $level = Auth::user()->id_level_surat;
            //jika level pengguna kepala bagian
            if ($level == 5) {
                //cari tujuan approve (staf ahli atau asisten)
                $results = User::select('users.*','nama_pegawai','jabatan.id_jabatan','nama_jabatan','nama_staf_ahli','nama_asisten')
                ->join('pegawai', 'nip_pegawai', '=', 'users.id')
                ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
                ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
                ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
                ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
                ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
                ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')   
                ->where('nama_pegawai', 'LIKE' ,'%' . $data . '%')
                ->orWhere('nama_staf_ahli', 'LIKE' ,'%' . $data . '%')
                ->orWhere('nama_asisten', 'LIKE' ,'%' . $data . '%')
                ->where(function($q) {
                    $q->where('jabatan.id_jabatan',3)
                    ->orWhere('jabatan.id_jabatan',4);
                })
                ->get();
            } else 
            //jika level pengguna kepala sub bagian
            if($level == 6) {
                 //cari tujuan approve (kepala bagian)
                $results = User::select('users.*','nama_pegawai','jabatan.id_jabatan','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
                ->join('pegawai', 'nip_pegawai', '=', 'users.id')
                ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
                ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
                ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
                ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
                ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
                ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
                ->where('jabatan.id_jabatan',5)
                ->where(function($q) use ($data) {
                    $q->where('nama_pegawai', 'LIKE' ,'%' . $data . '%')
                    ->orWhere('nama_bagian', 'LIKE' ,'%' . $data . '%');
                })
                ->get();
            }
            //make output
            $output = '<div class="list-group  mt-2">';
            //cek jika data tersedia
            if ($results->count() >= 1) {
                //jika level pengguna kepala bagaian
                if ($level == 5) {
                    //tampilkan data dari database
                    foreach ($results as $result) {
                        //jika hasil pencarian jabatan adalah staf ahli
                        if ($result->id_jabatan == 3) {
                            //tampilkan data staf ahli
                            $output .= '
                            <a href="#" class="list-group-item list-group-item-action">'
                            .$result->id. ' - ' .$result->nama_jabatan. ' '. $result->nama_staf_ahli . '
                            </a>
                        ';
                        }
                        //jika tidak tampilkan data asisten 
                        else {
                            $output .= '
                            <a href="#" class="list-group-item list-group-item-action">'
                            .$result->id. ' - ' .$result->nama_jabatan. ' '. $result->nama_asisten . '
                            </a>
                        ';
                        }
                    }
                } else 
                if($level == 6){
                    foreach ($results as $result) {
                        $output .= '
                            <a href="#" class="list-group-item list-group-item-action">'
                            .$result->id. ' - ' .$result->nama_jabatan. ' '. $result->nama_bagian . '
                            </a>
                        ';
                    }
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

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
