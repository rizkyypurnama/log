<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Keranjang;
use App\Models\Like;
use App\Models\User;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function index(){
        $pengguna = auth()->user()->id;
        $data['user'] = User::where('id','!=',auth()->user()->id)->with('foto')->get();
        $data['album'] = Album::where('userid', '=', $pengguna)->get();
        $data['feeds'] = Foto::with('user')->orderBy('id', 'DESC')->get();
        $data['liketrend'] = Like::select('fotoid', DB::raw('COUNT(likeid) as mycount'))
        ->groupBy('fotoid')
        ->orderByDesc('mycount')
        ->limit(1)
        ->with('foto')
        ->get();
        return view('album', $data);
    }
    public function tambahalbum(){
        $pengguna = auth()->user()->id;
        $data['user'] = User::where('id','!=',auth()->user()->id)->with('foto')->get();
        $data['album'] = Album::where('userid', '=', $pengguna)->get();
        $data['feeds'] = Foto::with('user')->orderBy('id', 'DESC')->get();
        $data['liketrend'] = Like::select('fotoid', DB::raw('COUNT(likeid) as mycount'))
        ->groupBy('fotoid')
        ->orderByDesc('mycount')
        ->limit(1)
        ->with('foto')
        ->get();
        $data['keranjang'] = Keranjang::all();
        return view('tambahalbum', $data);
    }

    public function insertalbum(Request $request){
        $lasttrans=Album::max('id');
        $lastnum=intval(substr($lasttrans,5));
        $newnum=$lastnum+ 1;
        $notrans=date("Y") . str_pad($newnum,3,'0',STR_PAD_LEFT);

        $keranjang=Keranjang::all();

        $data= Album::create([
            'id' => $notrans,
            'namaalbum' => $request->input('namaalbum'),
            'deskripsi' => $request->input('deskripsi'),
            'userid' => $request->input('userid'),
            'tanggaldibuat' => date('Y-m-d')
        ]);

        foreach ($keranjang as $rahmat) {
            $datakeranjang = Foto::create([
                'judulfoto' => $rahmat->judulfoto,
                'deskripsifoto' => $rahmat->deskripsifoto,
                'tanggalunggah' => $rahmat->tanggalunggah,
                'lokasifile' => $rahmat->lokasifile,
                'albumid' => $notrans,
                'userid' => $rahmat->userid,
            ]);
        }

        DB::table('keranjang')->truncate();

        return redirect()->route('album');
    }

    public function editalbum(Request $request, $id){
        $data = Album::find($id);
        $data->update($request->all());

        return redirect()->route('album');
    }
    public function editalbumprofile(Request $request, $idalbum, $id){
        $data = Album::find($idalbum);
        $data->update($request->all());

        return redirect()->route('profilealbum',$id);
    }

    public function hapusalbum($id){
        $data = Album::find($id);
        $data->delete();

        return redirect()->route('album');
    }
    public function hapusalbumprofile($id){
        $data = Album::find($id);
        $data->delete();

        return redirect()->route('profilealbum');
    }
}
