<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\DokumenPegawaiRequest;
use App\Models\DokumenPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenPegawaiController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.dokumen-pegawai.dokumen-pegawai-create');
    }

    public function store(DokumenPegawaiRequest $request)
    {
        $data = $request->all();
        $this->validate($request,[
            'file_dokumen'   => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ],[
            'file_dokumen.required'    => 'Bukti lulus tidak boleh kosong',
            'file_dokumen.mimes'     => 'Format harus PDF,jpg,jpeg,png',
            'file_dokumen.file'      => 'Data yang di upload berbentuk file pdf',
            'file_dokumen.max'       => 'Bukti lulus maksimal berukuran 2MB'
        ]);
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
        $data ['nip_pegawai'] = $explode[0];

        //cek apakah ada file yang di inputkan
        if ($request->hasFile('file_dokumen')) {
             //simpan foto yang baru distorege
             $filenameWithExt    = $request->file('file_dokumen')->getClientOriginalName();
             $filename           = pathinfo($filenameWithExt,PATHINFO_FILENAME);
             $extension          = $request->file('file_dokumen')->getClientOriginalExtension();
             $filenameSimpan     = $filename.'_'.time().'.'.$extension;
             $path               = $request->file('file_dokumen')->storeAs('public/file_dokumen',$filenameSimpan);
             $data['file_dokumen']          = $filenameSimpan;
        }
        
        DokumenPegawai::create($data);
        return redirect()->route('dokumen-pegawai.create')->with('status','Data dokumen pegawai berhasil ditambah');
    }

    public function edit($id)
    {
        $pegawai = DokumenPegawai::findOrFail($id);
        return view('operator-kepegawaian.dokumen-pegawai.dokumen-pegawai-edit',compact('pegawai'));
    }

    public function update(DokumenPegawaiRequest $request, $id)
    {
        $data           = $request->all();
        $item           = DokumenPegawai::findOrFail($id);
        $berkas_lama    = $item->file_dokumen;
        //cek apakah ada input berkas atau tidak
        if ($request->hasFile('file_dokumen')) {
            
            if ($berkas_lama) {
               //hapus berkas yang sudah ada
               Storage::delete('/public/file_dokumen/'.$berkas_lama);
            }
            //simpan foto yang baru distorege
            $filenameWithExt    = $request->file('file_dokumen')->getClientOriginalName();
            $filename           = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension          = $request->file('file_dokumen')->getClientOriginalExtension();
            $filenameSimpan     = $filename.'_'.time().'.'.$extension;
            $path               = $request->file('file_dokumen')->storeAs('public/file_dokumen',$filenameSimpan);
            $data['file_dokumen']          = $filenameSimpan;

            $item->update($data);
            
        } else {
            //jika tidak ada berkas maka update data yang ada saja
            $item->update($data);
        }

        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data dokumen pegawai berhasil diedit");
    }

    public function destroy($id)
    {
        $data = DokumenPegawai::findOrFail($id);
        //untuk menghapus berkas yang tersimpan
        if ($data->file_dokumen) {
            Storage::delete('/public/file_dokumen/'.$data->file_dokumen);
        }
        $data->delete();
        
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data dokumen pegawai berhasil dihapus");
    }
}
