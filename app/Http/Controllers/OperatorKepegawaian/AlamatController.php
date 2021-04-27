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
         //hitung berapa banyak jalan yang dipunya
         if (count($data['jalan'])) {
            foreach ($data['jalan'] as $item => $value) {
                $data2 = [
                    'nip_pegawai'       => $data['nip_pegawai'],
                    'jalan'             => $data['jalan'][$item],
                    'kelurahan_desa'    => $data['kelurahan_desa'][$item],
                    'kecamatan'         => $data['kecamatan'][$item],
                    'kabupaten_kota'    => $data['kabupaten_kota'][$item],
                    'provinsi'          => $data['provinsi'][$item]
                ];
                Alamat::create($data2);
            }
        }
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Alamat berhasil ditambah");
    }

    public function edit($id)
    {
        $pegawai = Alamat::findOrFail($id);
        return view('operator-kepegawaian.alamat.alamat-edit',compact('pegawai'));
    }

    public function update(AlamatRequest $request, $id) 
    {
        $data   = $request->all();
        $item   = Alamat::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Alamat berhasil diedit");
    }

    public function destroy($id_rumah)
    {
        $data = Alamat::findOrFail($id_rumah);
        $data->delete(); 
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data alamat berhasil dihapus");       
    }
}
