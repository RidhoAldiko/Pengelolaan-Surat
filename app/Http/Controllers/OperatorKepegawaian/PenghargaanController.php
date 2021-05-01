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
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama

        Penghargaan::create($data);
        return redirect()->route('pegawai-penghargaan.create')->with('status','Data penghargaan berhasil ditambah');
    }
}
