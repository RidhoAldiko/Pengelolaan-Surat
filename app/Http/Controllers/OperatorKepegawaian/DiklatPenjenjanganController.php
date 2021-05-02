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
        $this->validate($request,[
            'bukti_lulus'   => 'required|file|mimes:pdf|max:2048'
        ],[
            'bukti_lulus.required'    => 'Bukti lulus tidak boleh kosong',
            'bukti_lulus.mimes'     => 'Format harus PDF',
            'bukti_lulus.file'      => 'Data yang di upload berbentuk file pdf',
            'bukti_lulus.max'       => 'Bukti lulus maksimal berukuran 2MB'
        ]);
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
        $data ['nip_pegawai'] = $explode[0];
        
        //cek apakah ada file yang di inputkan
        if ($request->hasFile('bukti_lulus')) {
             //simpan foto yang baru distorege
             $filenameWithExt    = $request->file('bukti_lulus')->getClientOriginalName();
             $filename           = pathinfo($filenameWithExt,PATHINFO_FILENAME);
             $extension          = $request->file('bukti_lulus')->getClientOriginalExtension();
             $filenameSimpan     = $filename.'_'.time().'.'.$extension;
             $path               = $request->file('bukti_lulus')->storeAs('public/bukti_lulus',$filenameSimpan);
             $data['bukti_lulus']          = $filenameSimpan;
        }
        
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
        $berkas_lama    = $item->bukti_lulus;
        //cek apakah ada input berkas atau tidak
        if ($request->hasFile('bukti_lulus')) {
            
            if ($berkas_lama) {
               //hapus berkas yang sudah ada
               Storage::delete('/public/bukti_lulus/'.$berkas_lama);
            }
            //simpan foto yang baru distorege
            $filenameWithExt    = $request->file('bukti_lulus')->getClientOriginalName();
            $filename           = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension          = $request->file('bukti_lulus')->getClientOriginalExtension();
            $filenameSimpan     = $filename.'_'.time().'.'.$extension;
            $path               = $request->file('bukti_lulus')->storeAs('public/bukti_lulus',$filenameSimpan);
            $data['bukti_lulus']          = $filenameSimpan;

            $item->update($data);
            
        } else {
            //jika tidak ada berkas maka update data yang ada saja
            $item->update($data);
        }

        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data diklat penjenjangan berhasil diedit");
    }

    public function destroy($id)
    {
        $data = DiklatPenjenjangan::findOrFail($id);
        //untuk menghapus berkas yang tersimpan
        if ($data->bukti_lulus) {
            Storage::delete('/public/bukti_lulus/'.$data->bukti_lulus);
        }
        $data->delete();
        
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data diklat penjenjangan berhasil dihapus");
    }
}
