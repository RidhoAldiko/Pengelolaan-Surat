<?php

namespace App\Http\Controllers\UserDisposisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notifikasi;
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
        return \view('user-disposisi.dashboard');
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
    function search_pengguna(Request $request)
    {
        
        if ($request->has('data')) {
            $data = $request->data;
            //cek level surat user login
            $level = Auth::user()->id_level_surat;
            //jika level pengguna kepala bagian
            if ($level == 5) {
                //cari tujuan approve (staf ahli atau asisten)
                $results = User::select('users.*','nama_pegawai','jabatan.id_jabatan','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
                ->join('pegawai', 'nip_pegawai', '=', 'users.id')
                ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
                ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
                ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
                ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
                ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
                ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
                ->where(function($q) {
                    $q->where('jabatan.id_jabatan',3)
                    ->orWhere('jabatan.id_jabatan',4);
                })
                ->where('nama_pegawai', 'LIKE' ,'%' . $data . '%')
                ->orWhere('nama_staf_ahli', 'LIKE' ,'%' . $data . '%')
                ->orWhere('nama_asisten', 'LIKE' ,'%' . $data . '%')
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
