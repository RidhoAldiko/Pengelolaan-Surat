<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\DiklatPenjenjanganRequest;
use App\Models\DiklatPenjenjangan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DiklatPenjenjanganController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.diklat-penjenjangan.diklat-penjenjangan-create');
    }

    public function store(DiklatPenjenjanganRequest $request)
    {
        $data = $request->all();

        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
        $data ['nip_pegawai'] = $explode[0];
        
        DiklatPenjenjangan::create($data);
        return redirect()->route('pegawai-diklat-penjenjangan.create')->with('status','Data diklat penjenjangan berhasil ditambah');
    }

    public function edit($id)
    {
        $pegawai = DiklatPenjenjangan::findOrFail($id);
        return view('operator-kepegawaian.diklat-penjenjangan.diklat-penjenjangan-edit',compact('pegawai'));
    }

    public function update(DiklatPenjenjanganRequest $request, $id)
    {
        $data           = $request->all();
        $item           = DiklatPenjenjangan::findOrFail($id);

        $item->update($data);
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data diklat penjenjangan berhasil diedit");
    }

    public function destroy($id)
    {
        $data = DiklatPenjenjangan::findOrFail($id);
        $data->delete();
        
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data diklat penjenjangan berhasil dihapus");
    }
}
