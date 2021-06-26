<?php

namespace App\Http\Controllers\OperatorSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Models\SuratMasuk;
use App\Models\User;
use App\Http\Requests\OperatorSurat\SuratMasukRequest;
use App\Http\Requests\OperatorSurat\DisposisiMasukRequest;
use App\Http\Requests\OperatorSurat\TeruskanDisposisiMasukRequest;
use App\Models\DisposisiSuratMasuk as DisposisiMasuk;
use App\Models\TeruskanDisposisiMasuk;

class SuratMasukController extends Controller
{
    //method data surat masuk
    public function index()
    {   
        $results = SuratMasuk::where('status',null)->get();
        return view('operator-surat.surat-masuk.surat-masuk',\compact('results'));
    }
    //method create surat masuk
    public function create()
    {
        return view('operator-surat.surat-masuk.surat-masuk-add');
    }
    //method store surat masuk
    public function store(SuratMasukRequest $request)
    {
        $this->validate($request,[
            'file_surat' => 'required'
        ],[
            'file_surat.required' => 'File Surat Tidak Boleh Kosong',
        ]);

        $data = $request->all();
        $data['file_surat'] = $request->file('file_surat')->store(
            'assets/surat-masuk','public'
        );
        $create=SuratMasuk::create($data);
        return redirect()->route('surat-masuk.index')->with('status',"Data surat masuk berhasil ditambah");
    }

    //method detail surat masuk
    public function show($id){
        $result = SuratMasuk::findOrFail($id);
        return view('operator-surat.surat-masuk.surat-masuk-detail',\compact('result'));
    }

    //method form edit surat masuk
    public function edit($id){
        $result = SuratMasuk::findOrFail($id);
        return view('operator-surat.surat-masuk.surat-masuk-edit',\compact('result'));
    }

    //method update surat masuk
    public function update(SuratMasukRequest $request,$id){
        $data = $request->all();
        $surat = SuratMasuk::findOrFail($id);
        if ($request->hasFile('file_surat')) {
            // jika file surat ada
            if ($surat->file_surat) {
                // hapus file surat masuk di folder public
                Storage::delete('public/'.$surat->file_surat);
            }
            // simpan file yang diupload ke folder assets/surat-masuk yang ada di public lalu simpan dalam variable data[foto]
            $data['file_surat'] = $request->file('file_surat')->store(
                'assets/surat-masuk','public'
            );
        }
        //update data surat
        $surat->update($data);
        return redirect()->route('surat-masuk.index')->with('status',"Data Surat Masuk berhasil diubah");
    }
    //method hapus surat masuk
    public function destroy(SuratMasuk $data){
        SuratMasuk::destroy($data->id_surat_masuk);
        Storage::delete('public/'.$data->file_surat);
        return redirect()->route('surat-masuk.index')->with('status','Data Surat Masuk Berhasil Dihapus');
    }
    
    public function cetak_laporan_surat_masuk()
    {
        return view('operator-surat.surat-masuk.cetak_surat_masuk');
    }
}
