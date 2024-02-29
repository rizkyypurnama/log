<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request,$id){
        $data= Like::create([
            'fotoid' => $id,
            'userid' => auth()->user()->id,
            'tanggallike' => date('Y-m-d')
        ]);
        return redirect()->back();
    }
    public function likedetail(Request $request,$id){
        $data= Like::create([
            'fotoid' => $id,
            'userid' => auth()->user()->id,
            'tanggallike' => date('Y-m-d')
        ]);
        return redirect()->route('detailpost',$id);
    }

    public function unlike($id){
        $data = Like::where('fotoid','=',$id);
        $data->where('userid', '=',auth()->user()->id);
            $data->delete();

        return redirect()->route('dashboard');
    }
    public function unlikedetail($id){
        $data = Like::where('fotoid','=',$id);
        $data->where('userid', '=',auth()->user()->id);
            $data->delete();

        return redirect()->route('detailpost',$id);
    }
}
