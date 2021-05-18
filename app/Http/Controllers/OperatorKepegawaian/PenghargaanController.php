<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\PenghargaanRequest;
use App\Models\Penghargaan;
use Illuminate\Http\Request;

class PenghargaanController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.penghargaan.penghargaan-create');
    }

    public function store(PenghargaanRequest $request)
    {
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //masukan nip ke variabel data['id]
        $data ['nip_pegawai'] = $explode[0];

        Penghargaan::create($data);
        return redirect()->route('pegawai-penghargaan.create')->with('status','Data penghargaan berhasil ditambah');
    }

    public function edit($id)
    {
        $pegawai = Penghargaan::findOrFail($id);
        return view('operator-kepegawaian.penghargaan.penghargaan-edit',compact('pegawai'));
    }

    public function update(PenghargaanRequest $request, $id)
    {
        $data = $request->all();
        $item = Penghargaan::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data bintang/penghargaan berhasil diedit");
    }

    public function destroy($id)
    {
        $data = Penghargaan::findOrFail($id);
        $data->delete();
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data bintang/penghargaan berhasil dihapus");
    }
}
