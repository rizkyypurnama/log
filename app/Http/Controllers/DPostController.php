<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Like;
use App\Models\User;
use App\Models\Album;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DPostController extends Controller
{
    public function index($id){
        $pengguna = auth()->user()->id;
        $data['user'] = User::where('id','!=',auth()->user()->id)->with('foto')->get();
        $data['feed'] = Foto::with('user')->with('album')->orderBy('id', 'DESC')->find($id);
        $data['feeds'] = Foto::with('user')->orderBy('id', 'DESC')->get();

        $data['jumlike'] = Like::all();
        $data['album'] = Album::where('userid','=',$pengguna)->get();
        $data['like'] = Like::where('userid' , $pengguna)->get();
        $data['comment'] = Komentar::with('user')->orderBy('komentarid', 'DESC')->get();
        $data['liketrend'] = Like::select('fotoid', DB::raw('COUNT(likeid) as mycount'))
        ->groupBy('fotoid')
        ->orderByDesc('mycount')
        ->limit(1)
        ->with('foto')
        ->get();
        return view('detailpost', $data);
    }
}
