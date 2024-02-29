<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Like;
use App\Models\User;
use App\Models\Album;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index($id){
        $data['user']=User::where('id','!=',auth()->user()->id)->with('foto')->get();
        $data['userprofile']=User::find($id);
        $data['jumpost']=Foto::where('userid','=',$id)->count();
        $data['jumalbum']=Album::where('userid','=',$id)->count();
        $data['jumlike'] = Like::all();
        $data['jumkomen'] = Komentar::all();
        $data['feed']=Foto::where('userid','=',$id)->orderByDesc('id')->get();
        $data['idacc']=$id;
        $data['feeds'] = Foto::with('user')->orderBy('id', 'DESC')->get();
        $data['liketrend'] = Like::select('fotoid', DB::raw('COUNT(likeid) as mycount'))
        ->groupBy('fotoid')
        ->orderByDesc('mycount')
        ->limit(1)
        ->with('foto')
        ->get();
        return view('profile', $data,);
    }
    public function profilealbum($id){
        $data['user']=User::where('id','!=',auth()->user()->id)->with('foto')->get();
        $data['userprofile']=User::find($id);
        $data['jumpost']=Foto::where('userid','=',$id)->count();
        $data['jumalbum']=Album::where('userid','=',$id)->count();
        $data['album'] = Album::where('userid', '=', $id)->get();
        $data['idacc']=$id;
        $data['feeds'] = Foto::with('user')->orderBy('id', 'DESC')->get();
        $data['liketrend'] = Like::select('fotoid', DB::raw('COUNT(likeid) as mycount'))
        ->groupBy('fotoid')
        ->orderByDesc('mycount')
        ->limit(1)
        ->with('foto')
        ->get();
        return view('profilealbum', $data,);
    }

    public function editprofile(Request $request, $id){
        $data=User::find($id);
        
        $data->update($request->all());
        if ($request->hasFile('fotoprofile')) {
            $request->file('fotoprofile')->move('profileimg/',$request->file('fotoprofile')->getClientOriginalName());
            $data->fotoprofile = $request->file('fotoprofile')->getClientOriginalName();
        }
        $data->save();
        if ($request->hasFile('backimg')) {
            $request->file('backimg')->move('latarimg/',$request->file('backimg')->getClientOriginalName());
            $data->backimg = $request->file('backimg')->getClientOriginalName();
        }
        $data->save();

        return redirect()->route('profile',$id);
    }

    public function profileliketerbanyak($id){
        $data['user']=User::where('id','!=',auth()->user()->id)->with('foto')->get();
        $data['userprofile']=User::find($id);
        $data['jumpost']=Foto::where('userid','=',$id)->count();
        $data['jumalbum']=Album::where('userid','=',$id)->count();
        $data['feed']=Like::select('fotoid', DB::raw('COUNT(likeid) as mycount'))
        ->groupBy('fotoid')
        ->orderByDesc('mycount')
        ->with('foto')
        ->get();
        $data['idacc']=$id;
        $data['feeds'] = Foto::with('user')->orderBy('id', 'DESC')->get();
        $data['liketrend'] = Like::select('fotoid', DB::raw('COUNT(likeid) as mycount'))
        ->groupBy('fotoid')
        ->orderByDesc('mycount')
        ->limit(1)
        ->with('foto')
        ->get();
        return view('profileliketerbanyak', $data,);
    }

    public function profilekomenterbanyak($id){
        $data['user']=User::where('id','!=',auth()->user()->id)->with('foto')->get();
        $data['userprofile']=User::find($id);
        $data['jumpost']=Foto::where('userid','=',$id)->count();
        $data['jumalbum']=Album::where('userid','=',$id)->count();
        $data['feed']=Komentar::select('fotoid', DB::raw('COUNT(komentarid) as mycount'))
        ->groupBy('fotoid')
        ->orderByDesc('mycount')
        ->with('foto')
        ->get();
        $data['idacc']=$id;
        $data['feeds'] = Foto::with('user')->orderBy('id', 'DESC')->get();
        $data['liketrend'] = Like::select('fotoid', DB::raw('COUNT(likeid) as mycount'))
        ->groupBy('fotoid')
        ->orderByDesc('mycount')
        ->limit(1)
        ->with('foto')
        ->get();
        return view('profilekomenterbanyak', $data,);
    }
}
