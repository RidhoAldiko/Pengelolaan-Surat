<?php

namespace App\Http\Controllers\OperatorSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\OperatorSurat\SuratKeluarRequest;
use App\Models\SuratKeluar;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = SuratKeluar::where('status',null)->get();
        return \view('operator-surat.surat-keluar.surat-keluar',\compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('operator-surat.surat-keluar.surat-keluar-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuratKeluarRequest $request)
    {
        $this->validate($request,[
            'file_surat' => 'required'
        ],[
            'file_surat.required' => 'File Surat Tidak Boleh Kosong',
        ]);

        $data = $request->all();
        $data['file_surat'] = $request->file('file_surat')->store(
            'assets/surat-keluar','public'
        );
        $create=SuratKeluar::create($data);
        return redirect()->route('surat-keluar.index')->with('status',"Data surat keluar berhasil ditambah");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = SuratKeluar::findOrFail($id);
        return view('operator-surat.surat-keluar.surat-keluar-detail',\compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = SuratKeluar::findOrFail($id);
        return view('operator-surat.surat-keluar.surat-keluar-edit',\compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuratKeluarRequest $request, $id)
    {
        $data = $request->all();
        $surat = SuratKeluar::findOrFail($id);
        if ($request->hasFile('file_surat')) {
            // jika file surat ada
            if ($surat->file_surat) {
                // hapus file surat keluar di folder public
                Storage::delete('public/'.$surat->file_surat);
            }
            // simpan file yang diupload ke folder assets/surat-keluar yang ada di public lalu simpan dalam variable data[foto]
            $data['file_surat'] = $request->file('file_surat')->store(
                'assets/surat-keluar','public'
            );
        }
        //update data surat
        $surat->update($data);
        return redirect()->route('surat-keluar.index')->with('status',"Data Surat Keluar berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratKeluar $data)
    {
        SuratKeluar::destroy($data->id_surat_keluar);
        Storage::delete('public/'.$data->file_surat);
        return redirect()->route('surat-keluar.index')->with('status','Data Surat Keluar Berhasil Dihapus');
    }
}
