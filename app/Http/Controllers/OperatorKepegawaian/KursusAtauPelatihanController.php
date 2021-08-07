<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\KursusAtauPelatihanRequest;
use App\Models\KursusAtauPelatihan;
use Illuminate\Http\Request;

class KursusAtauPelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operator-kepegawaian.kursus-pelatihan.kursus-pelatihan-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KursusAtauPelatihanRequest $request)
    {
        $data   = $request->all();
         //pisahkan dan ambil nip pegawai saja
         $explode = explode(' - ',$request->nip_pegawai,-1);
         //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
         $data ['nip_pegawai'] = $explode[0];
         $data['mulai'] = date('Y-m-d H:i:s',strtotime($data['mulai'] ));
         $data['selesai'] = date('Y-m-d H:i:s',strtotime($data['selesai'] ));

         KursusAtauPelatihan::create($data);
         return redirect()->route('kursus-atau-pelatihan.create')->with('status','Data Kursus/ Pelatihan berhasil ditambah');
        
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
        $pegawai = KursusAtauPelatihan::findOrFail($id);
        return view('operator-kepegawaian.kursus-pelatihan.kursus-pelatihan-edit',compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KursusAtauPelatihanRequest $request, $id)
    {
        $data   =  $request->all();
        $data['mulai'] = date('Y-m-d H:i:s',strtotime($data['mulai'] ));
        $data['selesai'] = date('Y-m-d H:i:s',strtotime($data['selesai'] ));
        $item   = KursusAtauPelatihan::findOrFail($id);
        
        $item->update($data);
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Kursus/ Pelatihan berhasil diedit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = KursusAtauPelatihan::findOrFail($id);
        $data->delete();
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data Kursus/ Pelatihan berhasil dihapus");
    }
}
