<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\PenggunaRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\PenggunaSistem;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\User;
use Exception;

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
        $pengguna = User::select('users.*')
        ->join('pegawai', 'nip_pegawai', '=', 'users.id')
        ->count();

        $pegawai = Pegawai::all()->count();

        // dd($pengguna);
        return view('admin.dashboard',compact('pengguna','pegawai'));
    }

    //function halaman data pengguna
    public function data_pengguna(){
        $results = User::select('users.*','nama_pegawai','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
        ->join('pegawai', 'nip_pegawai', '=', 'users.id')
        ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
        ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
        ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
        ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
        ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
        ->orderBy('created_at','DESC')->get();

        // $results = User::select('users.*','nama_pegawai','pegawai.id_jabatan','nama_jabatan','unit_kerja.id_unit','nama_unit')
        //         ->join('pegawai', 'nip_pegawai', '=', 'users.id')
        //         ->join('unit_kerja', 'unit_kerja.id_unit', '=', 'pegawai.id_unit')
        //         ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        //         ->get();
        // dd($results);
        return view('admin.pengguna.pengguna',\compact('results'));
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
            // $results = $pegawai->where('id_jabatan','!=',7);
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

        $user = User::where('id',$data['id']);
        if ($user->count() != 1) {
            try {
                Mail::to($data['email'])->send(new PenggunaSistem());
                //cari tanggal lahir berdasarkan nip
                $result = Pegawai::where('nip_pegawai',$data['id'])->first();
                $date = date('d-m-Y', strtotime($result->tanggal_lahir));
                //bersihkan  dash (-) pada tanggal lahir
                $tanggal_lahir = str_replace("-", "", $date);
                $data['flag'] = '0';
                $data['password'] = Hash::make($tanggal_lahir);
                $data['role'] = '3';
                $data['id_level_surat'] = $result->id_jabatan;
                $user = User::create($data);
                return redirect()->route('data-pengguna.index')->with('status','Pengguna Berhasil Ditambah');
            } catch (Exception $ex) {
                return redirect()->route('data-pengguna.add')->with('warning','Koneksi internet anda tidak stabil,Pengguna gagal Ditambahkan, Silahkan ulangi lagi!');
            }

        } else {
            return back()->withErrors(['nip_pegawai'=>'Nip pegawai sudah terdaftar!']);
        }
        

        
        //arahkan ke halaman tabel data pengguna
        // return redirect()->route('data-pengguna.index')->with('status','Pengguna Berhasil Ditambah');
    }

    public function disable($id){
        User::where('id', $id)->update(['flag' => 1]);
        return redirect()->route('data-pengguna.index')->with('status','Pengguna Berhasil Dinonaktifkan');
    }

    public function enable($id){
        User::where('id', $id)->update(['flag' => 0]);
        return redirect()->route('data-pengguna.index')->with('status','Pengguna Berhasil Aktifkan');
    }
}
