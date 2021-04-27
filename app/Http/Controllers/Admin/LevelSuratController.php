<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OperatorKepegawaian\LevelSuratRequest;
use App\Models\Level_Surat as Level;

class LevelSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data   = Level::all();
        return view('admin.masterdata.level-surat.level-surat',[
            'items' => $data
        ]);
    }

    public function data_level_surat(){
        $results = Level::all();
        $output = '<label for="nip_pegawai">Pilih Level Disposis Surat</label>';
        $output .= '<select class="form-control role-user" id="id_level_surat" name="id_level_surat">">';
        foreach ($results as $result) {
            $output .= ' <option value="'.$result->id_level_surat.'">'.$result->nama_level.'</option>';
        }
        $output .= '</select>';
        echo $output;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.masterdata.level-surat.level-surat-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LevelSuratRequest $request)
    {
        $data           = $request->all();
        Level::create($data);

        return redirect()->route('data-level_surat.index')->with('status','Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data          = Level::findOrFail($id);
        return view('admin.masterdata.level-surat.level-surat-edit',[
            'item' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LevelSuratRequest $request, $id)
    {
        $data       = $request->all();
        $item       = Level::findOrFail($id); 
        $item->update($data);
        return redirect()->route('data-level_surat.index')->with('status','Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $data_level_surat)
    {
        Level::destroy($data_level_surat->id_level_surat);
        return redirect()->route('data-level_surat.index')->with('status','Data Berhasil Dihapus');
    }
}
