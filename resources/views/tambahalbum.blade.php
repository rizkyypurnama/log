@extends('layouts.dash')
@section('title', 'Album')

@section('content')

{{-- tengah --}}
<div class="col-md-7 border-end border-start">

    <div class="posting py-3 px-3 border-bottom">
        <h5>Tambah album</h5>
        <div class="d-flex w-100">
            
            <div class="w-100 pl-2">
                <form action="/insertalbum" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="namaalbum" placeholder="Nama Album" class="form-control border-0 border-bottom" required>
                    <input type="text" name="deskripsi" placeholder="Deskripsi . . ." class="form-control border-0 border-bottom" required>
                    <input type="text" name="userid" value="{{auth()->user()->id}}" hidden >
                    <div class="mt-2 d-flex justify-content-between">
                        <div class="icons text-dark" style="font-size: 14pt;">
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#insertfoto">Tambah foto</button>
                        </div>
                        <div class="share">
                            <button type="submit" class="btn btn-dark">Simpan</button>
                        </div>
                    </div>
                </form>
                
            </div>
            
        </div>
    </div>

    <div class="d-flex align-items-center border-bottom py-2">
        
        <div class="container">
            <div class="row">
                
                @foreach ($keranjang as $item)
                <div class="col-md-4 mb-1">
                    <img src="{{asset('postfoto/'.$item->lokasifile)}}" style="width: 200px; height:200px; object-fit:cover;">
                </div>
                @endforeach
                
            </div>
        </div>
    </div>

  <!-- Modal -->
  {{-- modal insert foto --}}
  <div class="modal fade" id="insertfoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Foto</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/insertkeranjang" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="judulfoto" placeholder="Beri judul Fotomu . . ." class="form-control border-0 border-bottom" required>
                <input type="text" name="deskripsifoto" placeholder="Deskripsi . . ." class="form-control border-0" required>
                <input type="file" name="lokasifile" class="form-control mt-1" required>
                <input type="text" hidden name="userid" value="{{auth()->user()->id}}">
                <input type="date" hidden name="tanggalunggah" value="{{date('Y-m-d')}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  {{-- endmodal insert foto --}}
  {{-- endmodal --}}

</div>
@endsection