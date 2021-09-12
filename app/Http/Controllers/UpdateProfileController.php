<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateProfileController extends Controller
{
    public function form_edit_profile()
    {
        $data = auth()->user();
        return view('edit-profil.edit-profile',compact('data'));
    }

    public function update_profile(Request $request)
    {
        request()->validate([
            'password_lama' => 'required',
            'password' => 'required|min:8|string|confirmed'
        ],[
            'password_lama.required' => 'Password lama tidak boleh kosong',
            'password.min' => 'Minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama'
        ]);

        $password_aktif = auth()->user()->password;
        $data = $request->all();
        if (Hash::check($data['password_lama'],$password_aktif)) {
            auth()->user()->update([
                'password' => bcrypt($data['password'])
            ]);
            return back()->with('status','password berhasil diubah!');
        }else{
            return back()->withErrors(['password_lama'=>'password lama anda tidak sesuai']);
        }
    }
}
