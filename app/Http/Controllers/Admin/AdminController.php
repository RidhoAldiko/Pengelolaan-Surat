<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\PenggunaRequest;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\User;

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
        $data = User::select('users.*','nama_pegawai','pegawai.id_jabatan','nama_jabatan','unit_kerja.id_unit','nama_unit')
                ->join('pegawai', 'nip_pegawai', '=', 'users.id')
                ->join('unit_kerja', 'unit_kerja.id_unit', '=', 'pegawai.id_unit')
                ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
                ->get();
        // dd($data);
        return view('admin.pengguna.pengguna');
    }

    //function search nip pegawai
    function search_pegawai(Request $request)
    {
        if ($request->has('data')) {
            $data = $request->data;
            //get nip pegawai 
            $results = Pegawai::where('nip_pegawai', 'LIKE' ,'%' . $data . '%')
                                ->orWhere('nama_pegawai', 'LIKE' ,'%' . $data . '%')
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
                            .$result->nip_pegawai. ' - '.$result->nama_pegawai.
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

    //function store data pengguna
    public function store(PenggunaRequest $request){
        //request semua data inputan
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //masukan nip ke variabel data['id]
        $data ['id'] = $explode[0];
        //cari tanggal lahir berdasarkan nip
        $result = Pegawai::where('nip_pegawai',$data['id'])->first('tanggal_lahir');
        //bersihkan  dash (-) pada tanggal lahir
        $tanggal_lahir = str_replace("-", "", $result->tanggal_lahir);
        //set nilai flag=0 (aktif)
        $data['flag'] = '0';
        //buat password dari tanggal lahir
        $data['password'] = Hash::make($tanggal_lahir);
        //create data ke database user
        $user = User::create($data);
        //arahkan ke halaman tabel data pengguna
        return redirect()->route('data-pengguna.index')->with('status','Pengguna Berhasil Ditambah');
    }
}
