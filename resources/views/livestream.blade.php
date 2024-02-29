@extends('layouts.dash')
@section('title', 'Beranda')

@section('content')

{{-- tengah --}}
<div class="col-md-7 border-end border-start">

    <div class="d-flex align-items-center py-2 px-2 border-bottom">
        <a href="/dashboard" class="back"><i class="fas fa-chevron-left"></i></a>
        <div class="ms-5">
            <strong>Livestream</strong>           
        </div>
    </div>

    <div class="mt-3 px-2 py-3">
        <div class="lipestrim">
            <video autoplay="true" id="video-webcam">
                Browsermu tidak mendukung bro, upgrade donk!
            </video>
        </div>
        <div class="icons">
        <a href="https://saweria.co/marsfhria" target="_blank"><i class="fas fa-gift"></i></a>
        </div>
    </div>

</div>

<script type="text/javascript">
    // seleksi elemen video
    var video = document.querySelector("#video-webcam");

    // minta izin user
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

    // jika user memberikan izin
    if (navigator.getUserMedia) {
        // jalankan fungsi handleVideo, dan videoError jika izin ditolak
        navigator.getUserMedia({ video: true }, handleVideo, videoError);
    }

    // fungsi ini akan dieksekusi jika  izin telah diberikan
    function handleVideo(stream) {
        video.srcObject = stream;
    }

    // fungsi ini akan dieksekusi kalau user menolak izin
    function videoError(e) {
        // do something
        alert("Izinkan menggunakan webcam untuk demo!")
    }
</script>

@endsection