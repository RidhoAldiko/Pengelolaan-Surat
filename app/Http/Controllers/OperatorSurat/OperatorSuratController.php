<?php

namespace App\Http\Controllers\OperatorSurat;

use App\Http\Controllers\Controller;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SuratMasuk;

class OperatorSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surat_masuk = SuratMasuk::where('status',null)->count();
        $surat_keluar = SuratKeluar::where('status',null)->count();
        $approval = SuratKeluar::select('surat_keluar.*','indeks','id_effort_surat','tanggal_effort')
        ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
        ->where('status','0')//terdaftar
        ->orWhere('status','2')//berjalan
        ->orWhere('status','3')//berjalan
        ->orWhere('status','4')//berjalan
        ->count();
        $disposisi = SuratMasuk::select('surat_masuk.*','indeks','id_disposisi_surat_masuk','tanggal_disposisi')
        ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
        ->where('status','0')//terdaftar
        ->orWhere('status','2')//berjalan
        ->orWhere('status','3')//berjalan
        ->orderBy('id_disposisi_surat_masuk','DESC')
        ->count();
        // dd($result);
        return view('operator-surat.dashboard',compact('surat_masuk','surat_keluar','approval','disposisi'));

    }

    //method search pengguna untuk tujuan disposisi surat masuk
    function search_pengguna(Request $request)
    {
        if ($request->has('data')) {
            $data = $request->data;
            $results = User::select('users.*','nama_pegawai','jabatan.id_jabatan','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
                ->join('pegawai', 'nip_pegawai', '=', 'users.id')
                ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
                ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
                ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
                ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
                ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
                ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
                ->where('jabatan.id_jabatan',6)
                ->where(function($q) use ($data) {
                    $q->where('nama_pegawai', 'LIKE' ,'%' . $data . '%')
                    ->orWhere('nama_sub_bagian', 'LIKE' ,'%' . $data . '%');
                })
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
                            .$result->id. ' - Sub Bagian '. $result->nama_sub_bagian . '  
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
}
