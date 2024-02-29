@extends('layouts.dash')
@section('title', 'Beranda')

@section('content')

{{-- tengah --}}
<div class="col-md-7 border-end border-start">

    {{-- bar atas --}}
    <div class="d-flex align-items-center py-2 px-2 border-bottom">
        <a href="/dashboard" class="back"><i class="fas fa-chevron-left"></i></a>
        <div class="ms-5">
            <strong>Notifikasi</strong>           
        </div>
    </div>

    <div class="mt-3 px-2 py-3">
        <table class="table">
            @foreach ($like->where('userid','!=',auth()->user()->id) as $item)
            @if ($item->foto->userid == auth()->user()->id)
            <tr>
                <td>
                    <a href="/profile/{{$item->user->id}}" style="text-decoration: none; color: black;">
                        <small>{{$item->tanggallike}}</small><br>
                        <img src="{{asset('profileimg/'.$item->user->fotoprofile)}}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 100%;" alt="">
                        <strong>{{'@'.$item->user->username}}</strong>
                    </a>
                    <small>memberi laik.</small>
                </td>
                <td><a href="/detailpost/{{$item->foto->id}}"><img src="{{asset('postfoto/'.$item->foto->lokasifile)}}" style="width: 70px; height:70px; object-fit:cover; border-radius:8px;" alt=""></a></td>
            </tr>
            @endif
            @endforeach
        </table>
    </div>

</div>

@endsection