<?php

namespace App\Http\Controllers\UserDisposisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DataDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //cek id user yang login
        $id = Auth::user()->id;
        //cek level surat user yang login
        // $level = User::select('users.*','urutan_level','nama_level')
        //         ->join('level_surat','level_surat.id_level_surat','=','users.id_level_surat')
        //         ->where('id',$id)
        //         ->first();
        //tampilkan disposisi surat masuk berdasarkan id user
        $results = SuratMasuk::select('surat_masuk.*','indeks','disposisi_surat_masuk.id_disposisi_surat_masuk','tanggal_disposisi','teruskan_disposisi_masuk.id')
                ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->join('teruskan_disposisi_masuk', 'teruskan_disposisi_masuk.id_disposisi_surat_masuk', '=', 'disposisi_surat_masuk.id_disposisi_surat_masuk')
                ->where('teruskan_disposisi_masuk.status',null)
                ->where('id',$id)
                ->get();
        return view('user-disposisi.disposisi.disposisi',\compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('user-disposisi.disposisi.disposisi-teruskan',['id'=>$id]);
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
