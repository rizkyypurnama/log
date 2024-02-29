@extends('layouts.dash')
@section('title', 'Profil')

@section('content')

{{-- tengah --}}
<div class="col-md-7 border-end border-start">

    {{-- bar atas --}}
    <div class="d-flex align-items-center py-2 px-2 border-bottom">
        <a href="/dashboard" class="back"><i class="fas fa-chevron-left"></i></a>
        <div class="ms-5">
            <strong>{{$userprofile->namalengkap}}</strong><br>
            <small>{{$jumpost}} Foto &bullet; {{$jumalbum}} Album</small>            
        </div>
    </div>

    {{-- foto profil dan background --}}
    <div class="d-flex align-items-center border-bottom">
        <img src="{{asset('latarimg/'.$userprofile->backimg)}}" style="width: 100%; height:200px; object-fit:cover;" alt="">
        
        <button class="btnprofile mb-5"><img style="width: 125px; height: 125px; object-fit: cover; border-radius: 100%; border:white solid;" src="{{asset('profileimg/'.$userprofile->fotoprofile)}}" alt=""></button>
    </div>

    {{-- btn edit profile --}}
    <div class="d-flex align-items-center py-2 px-2">
        @if ($idacc == auth()->user()->id)
        <button class=" btneditprofil py-2 px-2 ms-auto" data-bs-toggle="modal" data-bs-target="#editprofil">Edit Profile</button>
        @else
        <button class=" btneditprofil py-2 px-2 ms-auto" style="opacity: 0">Follow</button>
        @endif
    </div>

    {{-- Nama dan Username --}}
    <div class="d-flex align-items-center py-3 px-4">
        <p><strong>{{$userprofile->namalengkap}}</strong><br>
            <small>{{'@'.$userprofile->username}}</small><br><br>
            <small><i class="fas fa-map-marker-alt"></i> {{$userprofile->alamat}}</small></p>
    </div>

    @yield('isi')

    {{-- modal edit profil --}}
    <div class="modal fade" id="editprofil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <form action="/updateprofile/{{$idacc}}" method="post" enctype="multipart/form-data">
                  @csrf
            <div class="modal-header">
                <button type="button" class="btnicon" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profil</h1>
                <button type="submit" class="btn btn-dark" style="border-radius: 50px">Simpan</button>
            </div>
            <div class="modal-body">
                <div class="upload-backimg">
                    <button class="btnicon backimg">
                        <img id="image-preview2" src="{{asset('latarimg/'.$userprofile->backimg)}}" style="width:485px; height:150px; object-fit:cover;">
                        <input id="image-upload2" type="file" name="backimg" class="form-control" id="">
                    </button>
                    
                </div>
                <div class="upload-fotoprofile">
                    <button class="btneditfotoprofile">
                        <img id="image-preview" src="{{asset('profileimg/'.$userprofile->fotoprofile)}}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 100%; border:white solid;">
                    </button>
                    <input type="file" id="image-upload" name="fotoprofile" class="form-control" id="">
                </div>
                <div class="form-floating mb-4">
                    <input type="text" name="namalengkap" id="floatingnamalengkap" class="form-control" value="{{$userprofile->namalengkap}}" required />
                    <label for="floatingnamalengkap">Nama Lengkap</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" name="username" id="floatingusername" class="form-control" value="{{$userprofile->username}}" required />
                    <label for="floatingusername">Username</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" name="alamat" id="floatingalamat" class="form-control" value="{{$userprofile->alamat}}" required />
                    <label for="floatingusername">Alamat</label>
                </div>
            </div>
                </form>
          </div>
        </div>
    </div>
    {{-- endmodal --}}

    {{-- coba script nopal --}}
    <script>
        document.getElementById('image-upload').addEventListener('change', function () {
    const file = this.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        document.getElementById('image-preview').setAttribute('src', e.target.result);
    };
    reader.readAsDataURL(file);
});


document.getElementById('gambar-container').addEventListener('click', function () {
    document.getElementById('image-upload').click();
});
    </script>

    <script>
        document.getElementById('image-upload2').addEventListener('change', function () {
    const file = this.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        document.getElementById('image-preview2').setAttribute('src', e.target.result);
    };
    reader.readAsDataURL(file);
});


document.getElementById('gambar-container').addEventListener('click', function () {
    document.getElementById('image-upload2').click();
});
    </script>
    {{-- scriptend --}}

</div>

@endsection