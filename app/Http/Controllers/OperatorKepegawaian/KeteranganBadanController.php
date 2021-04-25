<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\KeteranganBadanRequest;
use App\Models\KeteranganBadan;
use Illuminate\Http\Request;

class KeteranganBadanController extends Controller
{
    public function store(KeteranganBadanRequest $request)
    {
        $data   = $request->all();
        KeteranganBadan::create($data);
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Keterangan Badan berhasil ditambah");
    }

    public function update(KeteranganBadanRequest $request, $id)
    {
        $data   = $request->all();
        $item   = KeteranganBadan::findOrFail($id);
        $item->update($data);
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Keterangan Badan berhasil diedit");
    }
}
