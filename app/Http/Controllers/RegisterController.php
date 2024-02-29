<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function register(Request $request){
        $poto = 'anon.jpg';
        $latarimg= 'anon.png';
        $validatedData=$request->validate([
            'namalengkap' =>['required'],
            'username' =>['required','min:3','unique:users','not_in:hitler'],
            'alamat' =>['required'],
            'email' =>['required','unique:users','email'],
            'password' =>['required','min:3']
        ]);

        User::create([
            'namalengkap' =>$validatedData['namalengkap'],
            'username' =>$validatedData['username'],
            'alamat' =>$validatedData['alamat'],
            'email' =>$validatedData['email'],
            'password' =>$validatedData['password'],
            'fotoprofile' => $poto,
            'backimg' => $latarimg
        ]);
        return redirect('login')->with('success', 'berhasil membuat akun, silahkan Login');
    }
}
