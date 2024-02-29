@extends('layouts.dash')
@section('title', 'Beranda')

@section('content')

<!-- tengah -->
<div class="col-md-7 border-end border-start">
    <!-- bar atas -->
    <div class="d-flex justify-content-between align-items-center py-2 border-bottom position-sticky" style="top:0px; background-color: white">
        <strong style="font-size: 16pt;">Beranda</strong>
        <form action="dashboard" method="POST">
        <div class="search-bar">
                @csrf
            <input type="text" id="cariteman" placeholder="Cari Postingan. . ." name="cari"  style="background-color: #f3f3f3; border-radius: 20px; " class="border-0 py-2 form-control">
        </div>
    </form>
        <i class="far fa-star"></i>
    </div>
    
    <!-- posting -->
    <div class="posting py-3 px-3 border-bottom">
        <div class="d-flex w-100">
            <div class="image" style="margin-right: 20px;">
                <img style="width: 40px; height: 40px; object-fit: cover; border-radius: 100%;" src="{{asset('profileimg/'.auth()->user()->fotoprofile)}}" alt="">
            </div>

            <div class="w-100 pl-2">
                <form action="/insertfoto" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="judulfoto" placeholder="Beri judul Fotomu . . ." class="form-control border-0 border-bottom" required>
                    <input type="text" name="deskripsifoto" placeholder="Deskripsi . . ." class="form-control border-0" required>
                    <input type="file" name="lokasifile" class="form-control mt-1" required>
                    <select name="albumid" class="form-select mt-1" required>
                        <option selected hidden value="">Pilih album</option>
                        @foreach ($album as $list)
                            <option value="{{$list->id}}">{{$list->namaalbum}}</option>
                        @endforeach
                    </select>
                    <input type="text" hidden name="userid" value="{{auth()->user()->id}}">
                    <input type="date" hidden name="tanggalunggah" value="{{date('Y-m-d')}}">
                    <div class="mt-2 d-flex justify-content-between">
                       <div class="icons text-dark" style="font-size: 14pt;">
                           <a href="dashboard"><i class="fas fa-sync-alt"></i></a>
                       </div>
                       <div class="share">
                           <button type="submit" style="background-color: transparent; border:none;"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <!-- feeds -->
    @foreach ($feeds as $item)
        <div class="feed-items{{$item->id}} py-3 px-3 border-bottom timeline-bg">
            <div class="d-flex w-100">
                <div class="image">
                    <img style="width: 40px; height: 40px; object-fit: cover; border-radius: 100%;" src="{{asset('profileimg/'.$item->user->fotoprofile)}}" alt="">
                </div>
                <div class="content" style="margin-left: 15px;">
                    <div class="icons">
                        <a href="/profile/{{$item->user->id}}"><strong>{{$item->user->namalengkap}}</strong></a>
                        <span> {{'@'.$item->user->username}} &bullet; {{$item->tanggalunggah}}</span>
                        @if ($item->userid == auth()->user()->id)
                        <button class="btnicon btncog dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item">
                                    <button class="btnicon" data-bs-toggle="modal" data-bs-target="#editpost{{$item->id}}">
                                        <i style="color: sandybrown" class="fas fa-edit"></i> Edit Postingan
                                    </button>
                                </li>
                                <li class="dropdown-item">
                                    <button class="btnicon" data-bs-toggle="modal" data-bs-target="#hapuspost{{$item->id}}">
                                        <i style="color: crimson" class="fas fa-trash"></i> Hapus Postingan
                                    </button>
                                </li>
                            </ul>
                        @endif
                    </div>
                    
                    <div class="caption mt-1"onClick="location.href='/detailpost/{{$item->id}}'">
                        <h5>{{$item->judulfoto}}</h5>
                        <p>{{$item->deskripsifoto}}</p>
                    </div>
    
                    <div class="image mt-2 postingan"onClick="location.href='/detailpost/{{$item->id}}'">
                        <button style="border:none; background:transparent;"><img src="{{asset('postfoto/'.$item->lokasifile)}}"  width="100%" style="object-fit: cover;" max-height="260"></button>
                    </div>
                    
                    <div class="mt-2 d-flex justify-content-between ps-4 pe-4 icon-share">
                        @php
                            $jumkomeng = $jumcomment->where('fotoid', '=', $item->id)->count();
                            @endphp
                        <div class="komen"onClick="location.href='/detailpost/{{$item->id}}'">
                            <i class="far fa-comment"></i> {{$jumkomeng}}
                        </div>
                        <div class="like">
                            @php
                                // $idfoto = $item->id;
                                $suka = $like->where('fotoid', '=', $item->id)->count();
                                $jumsuka = $jumlike->where('fotoid', '=', $item->id)->count();
                            @endphp
                            @if ($suka == 1 )
                            <form action="/unlike/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <button type="submit" class="btnicon">{{$jumsuka}} <i style="color: crimson" class="fas fa-heart"></i></button>
                            </form>
                            @else
                            <form action="/like/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <button type="submit" class="btnicon">{{$jumsuka}} <i class="far fa-heart"></i></button>
                                </form>
                            @endif
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    @endforeach
    <!-- endfeeds -->
    
    {{-- modal --}}

    {{-- editpostingan --}}
    @foreach ($feeds as $item)
      <div class="modal fade" id="editpost{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header border-0">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Postingan</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/editpost/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-outline mb-4">
                        <label class="form-label" for="form4Example2">Ubah Judul</label>
                        <input type="text" name="judulfoto"id="form4Example2" class="form-control"
                            value="{{ $item->judulfoto }}" />
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="form4Example2">Ubah Deskripsi juga a?</label>
                        <input type="text" name="deskripsifoto"id="form4Example2" class="form-control"
                            value="{{ $item->deskripsifoto }}" />
                    </div>

                    <select name="albumid" class="form-select mt-1">
                        <option selected hidden value="{{$item->album->id}}">Pindahkan dari album {{$item->album->namaalbum}}?</option>
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
    @endforeach
    {{-- endmodal editpost --}}

    {{-- modal hapuspost --}}
    @foreach ($feeds as $list)
        <div class="modal fade" id="hapuspost{{ $list->id }}">
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
                        <form action="/hapuspost/{{ $list->id}}" method="get">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Ya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- endmodal hapuspost --}}

    {{-- modal komentar --}}
    @foreach ($feeds as $item)
  <div class="modal fade" id="komen{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Komentar</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table">
            <tbody>
                @foreach ($comment->where('fotoid', '=' , $item->id) as $list)
                <tr class="border-bottom">
                    <td>
                        <form action="hapuskomen/{{$list->komentarid}}" method="get">
                            @csrf
                            @method('delete')
                        <div class="commentarisasi">
                            <div class="btniconselengkapnyadikomentar">
                        <img style="width: 40px; height: 40px; object-fit: cover; border-radius: 100%;" src="{{asset('profileimg/'.$list->user->fotoprofile)}}" alt="">
                            <strong>{{$list->user->namalengkap}}</strong><small> &bullet; {{'@'.$list->user->username}} {{$list->tanggalkomentar}}</small>
                                @if ($list->userid == auth()->user()->id)
                                <button type="submit" class="btnicon"><small><i class="fas fa-trash"></i></small></button>
                                @endif
                            </div>
                            <div class="ms-5 mt-0">
                                <small>{{$list->isikomentar}}</small>
                            </div>
                        </div>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <form action="/insertkomen/{{$item->id}}" method="post">
            @csrf
        <div class="modal-footer mt-0">
                <i class="fas fa-plus"></i>
                <div class="col-md-10">
                    <input type="text" name="isikomentar" class="form-control" autofocus>
                </div>
                <button type="submit" class="btniconkomen "><i style="margin-left: -3px" class="fas fa-paper-plane"></i></button>
            </div>
        </form>
      </div>
    </div>
  </div>
    @endforeach
    {{-- endmodal komentar --}}

    {{-- endmodalsec --}}

</div>



@endsection