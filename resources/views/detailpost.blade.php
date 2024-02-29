@extends('layouts.dash')
@section('title', 'Beranda')

@section('content')

{{-- tengah --}}
<div class="col-md-7 border-end border-start">

        {{-- bar atas --}}
    <div class="d-flex align-items-center py-2 px-2">
        <a href="/dashboard" class="back"><i class="fas fa-chevron-left"></i></a>
        <div class="ms-5">
            <strong>Postingan</strong>           
        </div>
    </div>

    {{-- postingan --}}
    <div class="feed-items py-3 px-3 border-bottom">
        <div class="d-flex w-100">
            <div class="image">
                <img style="width: 40px; height: 40px; object-fit: cover; border-radius: 100%;" src="{{asset('profileimg/'.$feed->user->fotoprofile)}}" alt="">
            </div>
            <div class="content">
                
                <div class="icons">
                    <a href="/profile/{{$feed->userid}}"><strong>{{$feed->user->namalengkap}}</strong></a>
                    @if ($feed->userid == auth()->user()->id)
                        <button class="btnicon btncog dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item">
                                    <button class="btnicon" data-bs-toggle="modal" data-bs-target="#editpost{{$feed->id}}">
                                        <i style="color: sandybrown" class="fas fa-edit"></i> Edit Postingan
                                    </button>
                                </li>
                                <li class="dropdown-item">
                                    <button class="btnicon" data-bs-toggle="modal" data-bs-target="#hapuspost{{$feed->id}}">
                                        <i style="color: crimson" class="fas fa-trash"></i> Hapus Postingan
                                    </button>
                                </li>
                            </ul>
                        @endif
                        <br>
                    <span style="color: #858585"> {{'@'.$feed->user->username}}</span>
                </div>

                <div class="caption mt-3" style="margin-left: -50px">
                    <h5 class=" ms-2 mb-1">{{$feed->judulfoto}}</h5>
                    <p class="ms-2">{{$feed->deskripsifoto}}</p>
                </div>

                <div class="image mt-2 postingan" style="margin-left: -50px">
                    <button style="border:none; background:transparent;"><img src="{{asset('postfoto/'.$feed->lokasifile)}}"  width="100%" style="object-fit: cover;" max-height="260"></button>
                </div>

                <div class="tanggal mt-1" style="margin-left: -50px">
                    <span class="ms-2" style="color: #858585">{{$feed->tanggalunggah}}</span>
                    @php
                                // $idfoto = $item->id;
                                $suka = $like->where('fotoid', '=', $feed->id)->count();
                                $jumsuka = $jumlike->where('fotoid', '=', $feed->id)->count();
                                @endphp
                            @if ($suka == 1 )
                                    <button onclick="document.getElementById('unlike').submit()" style="margin-left: 470px" class="btnicon">{{$jumsuka}} <i style="color: crimson" class="fas fa-heart"></i></button>
                            </form>
                            @else
                                    <button onclick="document.getElementById('like').submit()" style="margin-left: 470px" class="btnicon">{{$jumsuka}} <i class="far fa-heart"></i></button>
                                    @endif
                                </div>

                                <form action="/likedetail/{{ $feed->id }}" method="POST" id="like" enctype="multipart/form-data" style="display: none;">
                                     @csrf
                                   </form>
                                <form action="/unlikedetail/{{ $feed->id }}" method="POST" id="unlike" enctype="multipart/form-data" style="display: none;">
                                     @csrf
                                   </form>

            </div>

        </div>
    </div>

    {{-- komentar --}}
    <div class="border-bottom px-3 py-3 position-sticky" style="top:0px; background:white;">
    <form action="/insertkomen/{{$feed->id}}" method="post">
             <div class="d-flex w-100">
                @csrf
                <img style="width: 40px; height: 40px; object-fit: cover; border-radius: 100%;" src="{{asset('profileimg/'.auth()->user()->fotoprofile)}}" alt="">
                <div class="col-md-10 ms-2 me-3">
                    <input type="text" name="isikomentar" class="form-control border-0 border-bottom" placeholder="Kirim Balasan Anda" autofocus required>
                </div>
                <button type="submit" class="btniconkomen "><i style="margin-left: -3px" class="fas fa-paper-plane text-center"></i></button>
            </div>
        </form>
    </div>

    {{-- list komentar --}}
    @foreach ($comment->where('fotoid', '=' , $feed->id) as $list)
    <div class="border-bottom px-3 py-3">
        <div class="d-flex w-100">
            <div class="image">
                <img style="width: 40px; height: 40px; object-fit: cover; border-radius: 100%;" src="{{asset('profileimg/'.$list->user->fotoprofile)}}" alt="">
            </div>
            <div class="content">
                <div class="btniconselengkapnyadikomentar">
                <div class="icons">
                    <a href="/profile/{{$list->userid}}"><strong>{{$list->user->namalengkap}}</strong></a>
                    <span style="color: #858585"> {{'@'.$list->user->username}} &bullet; {{$list->tanggalkomentar}}</span>
                    @if ($list->userid == auth()->user()->id)
                    <button  class="btnicon" data-bs-toggle="modal" data-bs-target="#editkomen{{ $list->komentarid }}"><i style="color:sandybrown;" class="fas fa-edit"></i></button>
                    <button  class="btnicon" data-bs-toggle="modal" data-bs-target="#hapuskomen{{ $list->komentarid }}"><i style="color: crimson" class="fas fa-trash"></i></button>
                    @endif
                    <br>
                    <span>{{$list->isikomentar}}</span>
                </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- modal --}}

    {{-- modalhapus --}}
@foreach ($comment->where('fotoid', '=' , $feed->id) as $list)
<div class="modal fade" id="hapuskomen{{ $list->komentarid }}">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h4 class="modal-title">Hapus Komentar?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-footer">
                <form action="/hapuskomen/{{$feed->id}}/{{ $list->komentarid}}" method="get">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Ya</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- modalhapusend --}}
    {{-- hapuspost --}}
        <div class="modal fade" id="hapuspost{{ $feed->id }}">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h4 class="modal-title">Hapus</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </button>
                    </div>
                    <div class="modal-body">
                        Anda yakin ingin menghapus postingan ini?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <form action="/hapuspost/{{$feed->id}}" method="get">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Ya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- endmodal hapus --}}

        {{-- editpostingan --}}
    <div class="modal fade" id="editpost{{$feed->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Postingan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="/editpost/{{ $feed->id }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <div class="form-outline mb-4">
                      <label class="form-label" for="form4Example2">Ubah Judul</label>
                      <input type="text" name="judulfoto"id="form4Example2" class="form-control"
                          value="{{ $feed->judulfoto }}" />
                  </div>

                  <div class="form-outline mb-4">
                      <label class="form-label" for="form4Example2">Ubah Deskripsi juga a?</label>
                      <input type="text" name="deskripsifoto"id="form4Example2" class="form-control"
                          value="{{ $feed->deskripsifoto }}" />
                  </div>

                  <select name="albumid" class="form-select mt-1">
                      <option selected hidden value="{{$feed->album->id}}">Pindahkan dari album {{$feed->album->namaalbum}}?</option>
                      @foreach ($album as $list)
                          <option value="{{$list->id}}">{{$list->namaalbum}}</option>
                      @endforeach
                  </select>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
              </form>
          </div>
        </div>
      </div>
    </div>
  {{-- endmodal editpost --}}

      {{-- editkomen --}}
      @foreach ($comment->where('fotoid', '=' , $feed->id) as $list)
<div class="modal fade" id="editkomen{{ $list->komentarid }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h4 class="modal-title">Edit Komentar</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <form action="/editkomen/{{$feed->id}}/{{$list->komentarid}}" method="post">
                @csrf
            <div class="modal-body">
                <div class="form-outline mb-4">
                    <input type="text" name="isikomentar"id="form4Example2" class="form-control"
                        value="{{ $list->isikomentar }}" />
                </div>
            </div>
            <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-dark">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
    {{-- endmodal editkomen --}}

    {{-- endmodal --}}

</div>
@endsection