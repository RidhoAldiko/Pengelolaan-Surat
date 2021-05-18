<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\AlamatRequest;
use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function store(AlamatRequest $request)
    {
        $data = $request->all();
        Alamat::create($data);
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Alamat berhasil ditambah");
    }

    public function update(AlamatRequest $request, $id) 
    {
        $data   = $request->all();
        $item   = Alamat::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Alamat berhasil diedit");
    }
}
