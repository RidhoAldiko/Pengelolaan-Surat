<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //function dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    //function halaman data pengguna
    public function data_pengguna(){
        return view('admin.pengguna.pengguna');
    }

    //function search nip pegawai
    function search_pegawai(Request $request)
    {
        if ($request->has('data')) {
            $data = $request->data;
            //get nip pegawai 
            $results = Pegawai::where('nip_pegawai', 'LIKE' ,'%' . $data . '%')->get('nip_pegawai');
            //make output
            $output = '<div class="list-group  mt-2">';
            //cek jika data tersedia
            if ($results->count() > 1) {
                //looping data
                foreach ($results as $result) {
                    //concat output untuk menampilkan data
                    $output .= '
                        <a href="#" class="list-group-item list-group-item-action">'
                            .$result->nip_pegawai.
                        '</a>
                    ';
                }
            }
            //jika data tidak tersedia
            else { 
                // concat output untuk menampilkan message
                $output .= '
                        <li href="#" class="list-group-item list-group-item-action">
                            Pegawai tidak ditemukan!
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

    //function form tambah pengguna
    public function add_pengguna(){
        return view('admin.pengguna.pengguna-add');
    }
}
