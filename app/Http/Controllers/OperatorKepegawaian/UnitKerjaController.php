<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\UnitKerjaRequest;
use App\Models\Unit_kerja;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnitKerjaController extends Controller
{
    //method untuk menampilkan tabel data unit kerja
    public function index()
    {
        return view('operator-kepegawaian.masterdata.unit-kerja.unit-kerja');
    }

    //method get server side unit kerja
    public function unitkerja_serverSide()
    {
        $data = Unit_kerja::get();

        return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('nama',function($data){
                    return $data->nama_unit;
                })
                ->editColumn('status',function($data){
                    return ($data->status == 0) ? 'aktif' : 'Nonaktif';
                })
                ->editColumn('aksi',function($data){

                    $button = ' <a href="'.route('data-UnitKerja.edit', $data->id_unit).'" class="btn btn-warning text-white btn-sm" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    //metod untuk menampilkan form tambah unit kerja
    public function create()
    {
        return view('operator-kepegawaian.masterdata.unit-kerja.unit-kerja-add');      
    }

    //method untuk menyinpan data unit kerja
    public function store(UnitKerjaRequest $request)
    {
        $data           = $request->all();
        $data['status'] = '0';

        Unit_kerja::create($data);
        
        return redirect()->route('data-UnitKerja.index')->with('status','Data Berhasil Ditambah');
    }

    //method untuk menampikan form edit data
    public function edit($id)
    {
        $data   = Unit_kerja::findOrFail($id);
         
        return view('operator-kepegawaian.masterdata.unit-kerja.unit-kerja-edit',[
            'item' => $data
        ]);
    }

    //method untuk update data
    public function update(UnitKerjaRequest $request, $id)
    {
        $data   = $request->all();
        $item   = Unit_kerja::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-UnitKerja.index')->with('status','Data Berhasil Edit');
    }
}
