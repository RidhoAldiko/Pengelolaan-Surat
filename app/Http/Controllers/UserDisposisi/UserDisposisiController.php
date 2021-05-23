<?php

namespace App\Http\Controllers\UserDisposisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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

    function search_pengguna(Request $request)
    {
        if ($request->has('data')) {
            $data = $request->data;
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
