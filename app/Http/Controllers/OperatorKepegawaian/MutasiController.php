<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\MutasiRequest;
use Yajra\DataTables\DataTables;
use App\Models\Mutasi;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index()
    {
        return view('operator-kepegawaian.mutasi.data-mutasi');
    }

    public function mutasi_serverSide(){
        //get data pegawai 
        $data = Mutasi::with(['pegawai'])->orderBy('id_mutasi','DESC')->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('nip', function($data){ 
                    return $data->nip_pegawai; 
                })
                ->editColumn('nama', function($data){ 
                    return $data->pegawai->nama_pegawai; 
                })
                ->editColumn('jenis_mutasi', function($data){ 
                    return $data->jenis_mutasi; 
                })
                ->editColumn('asal', function($data){ 
                    return $data->asal; 
                })
                ->editColumn('tujuan', function($data){ 
                    return $data->tujuan; 
                })
                ->editColumn('tanggal', function($data){ 
                    return date('d/m/Y',strtotime($data->tanggal));
                })
                ->make(true);
    }
    
    public function create()
    {
        return view('operator-kepegawaian.mutasi.mutasi-create');
    }

    public function store(MutasiRequest $request)
    {
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        $data ['nip_pegawai'] = $explode[0];
            
            if ($data['jenis_mutasi']=='Keluar') {
                $item = Pegawai::findOrFail($data ['nip_pegawai']);
                $item->update([ 'status' => 1 ]);
            }else{
                $item = Pegawai::findOrFail($data ['nip_pegawai']);
                $item->update([ 'status' => 0 ]);
            }
        $data['tanggal'] = date('Y-m-d H:i:s',strtotime($data['tanggal'] ));

        Mutasi::create($data);
        return redirect()->route('pegawai-mutasi.index')->with('status','Data Mutasi berhasil ditambah');
    }

    public function edit($id)
    {
        $pegawai = Mutasi::findOrFail($id);
        return view('operator-kepegawaian.mutasi.mutasi-edit',compact('pegawai'));
    }

    public function update(MutasiRequest $request, $id)
    {
        $data = $request->all();
        $data['tanggal'] = date('Y-m-d H:i:s',strtotime($data['tanggal'] ));

        $item = Mutasi::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Mutasi berhasil diedit");
    }

    public function destroy($id)
    {
        $data = Mutasi::findOrFail($id);
        $data->delete();
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data Mutasi berhasil dihapus");
    }
}
