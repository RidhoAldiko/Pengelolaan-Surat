<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\OrangtuaKandungRequest;
use App\Models\OrangtuaKandung;
use Illuminate\Http\Request;

class OrangtuaKandungController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.orangtua-kandung.orangtua-kandung-create');
    }

    public function store(OrangtuaKandungRequest $request)
    {
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //masukan nip ke variabel data['id]
        $data ['nip_pegawai'] = $explode[0];
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama

        OrangtuaKandung::create($data);
        return redirect()->route('pegawai-orangtua-kandung.create')->with('status','Data Orang tua kandung berhasil ditambah');
    }

    public function edit($id)
    {
        $pegawai = OrangtuaKandung::findOrFail($id);
        return view('operator-kepegawaian.orangtua-kandung.orangtua-kandung-edit',compact('pegawai'));
    }

    public function update(OrangtuaKandungRequest $request, $id)
    {
        $data   = $request->all();
        $item   = OrangtuaKandung::findOrFail($id);
        $item->update($data);
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Orang tua kandung berhasil diedit");
    }

    public function destroy($id)
    {
        $data = OrangtuaKandung::findOrFail($id);
        $data->delete();
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data Orang tua kandung berhasil dihapus");
    }
}
