<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function insertkomen(Request $request, $id){
        Komentar::create([
            'fotoid' => $id,
            'userid' => auth()->user()->id,
            'isikomentar' => $request->input('isikomentar'),
            'tanggalkomentar' => date('Y-m-d')
        ]);
        return redirect()->route('detailpost',$id);
    }

    public function hapuskomen($id,$idkomen){
        $data = Komentar::where('komentarid','=',$idkomen);
        $data->delete();

        return redirect()->route('detailpost', $id);
    }

    public function editkomen(Request $request ,$id,$idkomen){
        $data = Komentar::where('komentarid','=',$idkomen);
        $data->update([
            'isikomentar' => $request->input('isikomentar')
        ]);

        return redirect()->route('detailpost',$id);
    }
}
