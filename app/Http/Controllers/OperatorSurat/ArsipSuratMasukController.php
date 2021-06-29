<?php

namespace App\Http\Controllers\OperatorSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\SuratMasuk;

class ArsipSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator-surat.arsip.arsip-surat-masuk');
    }
    public function arsip_surat_serverside(){
        $data = SuratMasuk::where('status','1')->orWhere('status','3')->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('pengirim', function($data){ 
                    return $data->pengirim; 
                })
                ->editColumn('nomor_surat', function($data){ 
                    return $data->nomor_surat; 
                })
                ->editColumn('tanggal_surat', function($data){ 
                    return date("d/m/Y", strtotime($data->tanggal_surat));
                })
                ->addColumn('status', function($data) {
                    if ($data->status == 0) {
                        return "didisposisi";
                    }else
                    if ($data->status == 1) {
                        return "Tidak didisposisi";
                    }else
                    if ($data->status == 3) {
                        return "Selesai didisposisi";
                    }
                })
                ->addColumn('aksi', function($data) {
                    $button = '<a href="#" class="btn btn-success text-white btn-sm" title="Edit">
                                    <i class="fas fa-info"></i> Detail
                                </a>
                            ';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }
}
