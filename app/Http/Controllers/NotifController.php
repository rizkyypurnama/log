<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotifController extends Controller
{
    public function index($id){
        $data['user'] = User::where('id','!=',auth()->user()->id)->with('foto')->get();
        $data['like'] = Like::with('user')->with('foto')->orderBy('likeid', 'DESC')->get();
        $data['foto'] = Foto::where('userid','=',$id)->with('like')->get();
        $data['feeds'] = Foto::with('user')->orderBy('id', 'DESC')->get();
        $data['liketrend'] = Like::select('fotoid', DB::raw('COUNT(likeid) as mycount'))
        ->groupBy('fotoid')
        ->orderByDesc('mycount')
        ->limit(1)
        ->with('foto')
        ->get();
        return view('notif',$data);
    }
}
