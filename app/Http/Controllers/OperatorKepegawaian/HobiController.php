<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\HobiRequest;
use App\Models\Hobi;
use Illuminate\Http\Request;

class HobiController extends Controller
{
    public function destroy($id)
    {
        $data  = Hobi::findOrFail($id);
        $data->delete($data);

        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data hobi berhasil dihapus");
    }

    public function store(HobiRequest $request)
    {
        $data = $request->all();
         //hitung berapa banyak hobi yang dipunya
         if (count($data['hobi'])) {
            foreach ($data['hobi'] as $item => $value) {
                $data2 = [
                    'hobi'          => $data['hobi'][$item],
                    'nip_pegawai'   => $data['nip_pegawai']
                ];
                Hobi::create($data2);
            }
        }
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data hobi berhasil dihapus");
    }
}
