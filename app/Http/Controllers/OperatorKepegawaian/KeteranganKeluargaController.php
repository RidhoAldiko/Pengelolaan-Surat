<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\KeteranganKeluargaRequest;
use Illuminate\Http\Request;

class KeteranganKeluargaController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.keterangan-keluarga.keterangan-keluarga');
    }

    public function store(KeteranganKeluargaRequest $request)
    {
        $data = $request->all();
        dd($data);
    }
}
