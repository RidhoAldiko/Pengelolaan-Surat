<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //function dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    //function halaman data pengguna
    public function data_pengguna(){
        return view('admin.pengguna.pengguna');
    }

    //function form tambah pengguna
    public function add_pengguna(){
        return view('admin.pengguna.pengguna-add');
    }
}
