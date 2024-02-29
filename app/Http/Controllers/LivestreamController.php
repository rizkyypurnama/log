<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LivestreamController extends Controller
{
    public function index(){
        $data['user'] = User::where('id','!=',auth()->user()->id)->with('foto')->get();
        return view('livestream',$data);
    }
}
