<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Like;
use App\Models\User;
use App\Models\Album;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $pengguna = auth()->user()->id;
        $data['user'] = User::where('id','!=',auth()->user()->id)->with('foto')->get();
        $data['jumlike'] = Like::all();
        $data['jumcomment'] = Komentar::all();
        $data['comment'] = Komentar::with('user')->orderBy('komentarid', 'DESC')->get();
        $data['album'] = Album::where('userid','=',$pengguna)->get();
        $data['feeds'] = Foto::with('user')->orderBy('id', 'DESC')->get();
        $data['like'] = Like::where('userid' , $pengguna)->get();
        // $data['liketrend'] = Like::get('fotoid')->count('mycount')->groupBy('fotoid');
        $data['liketrend'] = Like::select('fotoid', DB::raw('COUNT(likeid) as mycount'))
            ->groupBy('fotoid')
            ->orderByDesc('mycount')
            ->limit(1)
            ->with('foto')
            ->get();
        // SELECT fotoid,COUNT(likeid) mycount FROM likefoto GROUP BY fotoid ORDER BY mycount DESC;
        // $data['like'] = $data['like']->where('fotoid', '8')->count();
        // dd($data['like']);
        return view('dashboard',$data);
    }

    public function ajax(){
        
    }
    public function listteman(){
        return'silahkan melakukan pencarian data';
    }
    public function cari(Request $request){
        $pengguna = auth()->user()->id;
        $data['user'] = User::where('id','!=',auth()->user()->id)->with('foto')->get();
        $data['jumlike'] = Like::all();
        $data['jumcomment'] = Komentar::all();
        $data['comment'] = Komentar::with('user')->orderBy('komentarid', 'DESC')->get();
        $data['album'] = Album::where('userid','=',$pengguna)->get();
        $data['feeds'] = Foto::with('user')->orderBy('id', 'DESC')->where('deskripsifoto','LIKE',"%{$request->input('cari')}%")->orWhere('judulfoto','LIKE',"%{$request->input('cari')}%")->get();
        $data['like'] = Like::where('userid' , $pengguna)->get();
        // $data['liketrend'] = Like::get('fotoid')->count('mycount')->groupBy('fotoid');
        $data['liketrend'] = Like::select('fotoid', DB::raw('COUNT(likeid) as mycount'))
            ->groupBy('fotoid')
            ->orderByDesc('mycount')
            ->limit(1)
            ->with('foto')
            ->get();
        // SELECT fotoid,COUNT(likeid) mycount FROM likefoto GROUP BY fotoid ORDER BY mycount DESC;
        // $data['like'] = $data['like']->where('fotoid', '8')->count();
        // dd($data['like']);
        return view('dashboard',$data);
    }

}
