<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function insertkeranjang(Request $request){
        $data= Keranjang::create($request->all());
        if ($request->hasFile('lokasifile')) {
            $request->file('lokasifile')->move('postfoto/',$request->file('lokasifile')->getClientOriginalName());
            $data->lokasifile = $request->file('lokasifile')->getClientOriginalName();
            $data->save();
        }
        return redirect()->back();
    }
}
