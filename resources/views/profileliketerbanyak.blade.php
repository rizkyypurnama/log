@extends('layouts.profiledash')
@section('isi')

{{-- navbar --}}
<div class="d-flex align-items-center border-bottom">
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-0 px0 mb-0">
        <ul class="navbar navbar-nav px-3">
            <a href="/profile/{{$idacc}}"><li style="width:100px;" class="navbar-item mediaprofile"><button class=" border-0 w-100 btnicon">Foto</button></li></a>
            <a href="/profilealbum/{{$idacc}}"><li style="width:100px;" class="navbar-item mediaprofile"><button class=" border-0 w-100 btnicon">Album</button></li></a>
            <a href="/profileliketerbanyak/{{$idacc}}"><li style="border-bottom: dodgerblue solid 1px; width:100px;" class="navbar-item mediaprofile"><button class=" border-0 w-100 btnicon">Most Liked</button></li></a>
            <a href="/profilekomenterbanyak/{{$idacc}}"><li style="width:150px;" class="navbar-item mediaprofile"><button class=" border-0 w-100 btnicon">Most Comment</button></li></a>
        </ul>
    </nav>
</div>

{{-- isi --}}
<div class="d-flex align-items-center border-bottom py-2">
    <div class="container">
        <div class="row">
            @foreach ($feed as $list)
            @if ($list->foto->userid == auth()->user()->id)
            <div class="col-md-4 mb-1 itembanget">
                <a href="/detailpost/{{$list->foto->id}}"><button style="width: 200px; height:200px; border:none; "><strong><i style="color: #dc143c86" class="fas fa-heart"></i> {{$list->mycount}}</strong></button></a>
                <a href="/detailpost/{{$list->foto->id}}"><img src="{{asset('postfoto/'.$list->foto->lokasifile)}}" style="width: 200px; height:200px; object-fit:cover;"></a>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>

@endsection