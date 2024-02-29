<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Like;
use App\Models\User;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FotoController extends Controller
{
    public function insertfoto(Request $request){
        $data= Foto::create($request->all());
        if ($request->hasFile('lokasifile')) {
            $request->file('lokasifile')->move('postfoto/',$request->file('lokasifile')->getClientOriginalName());
            $data->lokasifile = $request->file('lokasifile')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('dashboard');
    }
    
    public function editpost(Request $request, $id){
        $data = Foto::find($id);
        $data->update($request->all());

        return redirect()->route('dashboard');
    }

    public function hapuspost($id){
        $data = Foto::find($id);
        $data->delete();

        return redirect()->route('dashboard');
    }

    public function tambahfoto($id){
        $data['album']=Album::all();
        $data['feed']=Album::where('id','=',$id)->with('foto')->get();
        $data['user'] = User::where('id','!=',auth()->user()->id)->with('foto')->get();
        $data['feeds'] = Foto::with('user')->orderBy('id', 'DESC')->get();
        $data['liketrend'] = Like::select('fotoid', DB::raw('COUNT(likeid) as mycount'))
        ->groupBy('fotoid')
        ->orderByDesc('mycount')
        ->limit(1)
        ->with('foto')
        ->get();
        $data['foto']=Foto::all();
        // dd($data['feed']);
        return view('tambahfoto', $data);
    }

    public function inserttambahfoto(Request $request){
        $id = $request->input('albumid');
        $data= Foto::create($request->all());
        if ($request->hasFile('lokasifile')) {
            $request->file('lokasifile')->move('postfoto/',$request->file('lokasifile')->getClientOriginalName());
            $data->lokasifile = $request->file('lokasifile')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('tambahfoto' , $id);
    }
}
