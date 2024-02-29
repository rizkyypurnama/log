@extends('layouts.dash')
@section('title', 'Album')

@section('content')

<!-- tengah -->
<div class="col-md-7 border-end border-start">
    <!-- bar atas -->
    <div class="border-bottom px-2 py-3">
        <a href="dashboard" class="back"><i class="fas fa-chevron-left"></i></a>
        <div class="d-flex justify-content-between align-items-center py-2">
            <strong style="font-size: 16pt;">Buat Album Baru</strong>
            <i class="far fa-star"></i>
        </div>
        <div class="image mt-3" style="margin-right: 20px;">
            <button style="width: 60px; height: 60px; border-radius: 20px;" class="btn btn-dark" onClick="location.href='/tambahalbum'">
                <i class="fas fa-plus"></i>
              </button>
        </div>
    </div>
    
    <!-- bar atas -->
    <div class="mt-3 px-2 py-3">
        <div class="d-flex justify-content-between align-items-center py-2">
            <strong style="font-size: 16pt;">Album Anda</strong>
            <i class="far fa-star"></i>
        </div>
        <table class="table" id="example">
            <thead>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($album as $list)   
                <tr>
                    <td>{{ $loop->iteration }}.
                    </td>
                    <td>
                        <form action="/editalbum/{{ $list->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                         <input type="text" name="namaalbum" id="textbox{{$list->id}}" style="border: none; width: fit-content; font-weight: 500px;" value="{{$list->namaalbum}}">
                         <small>&bullet; {{$list->tanggaldibuat}}</small>
                         <button type="submit" style="background-color: transparent; border:none;"><i style="color: sandybrown" class="fas fa-edit"></i></button>
                         <button type="button" style="background-color: transparent; border:none;" data-bs-toggle="modal" data-bs-target="#hapusalbum{{ $list->id }}"><i style="color: crimson" class="fas fa-trash"></i></button><br>
                         <input type="text" name="deskripsi" id="textboxdesc{{$list->id}}" style=" font-size:14px; border: none; width: fit-content; font-weight: 500px;" value="{{$list->deskripsi}}">
                        </form>
                    </td>
                    <td>
                        <a href="tambahfoto/{{$list->id}}"><button style="border-radius: 5px;" class="btn btn-dark"><i style="color: white" class="fas fa-eye"></i></button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

</div>



{{-- Modal --}}
  
{{-- modalinsert --}}
<div class="modal fade" id="tambahalbum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Album Baru</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body border-0">
            <form action="/insertalbum" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-outline mb-4">
                    <label class="form-label" for="form4Example2">Nama Album</label>
                    <input type="text" name="namaalbum"id="form4Example2" class="form-control" required />
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form4Example2">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="form4Example2" required></textarea>
                </div>
                <input type="text" name="userid" value="{{auth()->user()->id}}" hidden >
        </div>
        <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark"><i class="fas fa-plus"></i></button>
            </form>
        </div>
      </div>
    </div>
  </div>
{{-- modalinsert end --}}

{{-- modalhapus --}}
@foreach ($album as $list)
        <div class="modal fade" id="hapusalbum{{ $list->id }}">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h4 class="modal-title">Hapus</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </button>
                    </div>
                    <div class="modal-body">
                        Seluruh foto yang ada di dalam album <strong>{{$list->namaalbum}}</strong> akan ikut terhapus, Apakah anda ingin menghapus album <strong>{{$list->namaalbum}}</strong>?
                        
                    </div>
                    <div class="modal-footer">
                        <form action="/hapusalbum/{{ $list->id}}" method="get">
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

{{-- Modal End --}}

{{-- coba pake script edit nama album --}}
@foreach ($album as $list)
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const textboxEle = document.getElementById('textbox{{$list->id}}');

    // Get the styles
    const styles = window.getComputedStyle(textboxEle);

    // Create a div element
    const fakeEle = document.createElement('div');
    fakeEle.style.position = 'absolute';
    fakeEle.style.top = '0';
    fakeEle.style.left = '-9999px';
    fakeEle.style.overflow = 'hidden';
    fakeEle.style.visibility = 'hidden';
    fakeEle.style.whiteSpace = 'nowrap';
    fakeEle.style.height = '0';

    // Copy font styles from the textbox
    fakeEle.style.fontFamily = styles.fontFamily;
    fakeEle.style.fontSize = styles.fontSize;
    fakeEle.style.fontStyle = styles.fontStyle;
    fakeEle.style.fontWeight = styles.fontWeight;
    fakeEle.style.letterSpacing = styles.letterSpacing;
    fakeEle.style.textTransform = styles.textTransform;

    fakeEle.style.borderLeftWidth = styles.borderLeftWidth;
    fakeEle.style.borderRightWidth = styles.borderRightWidth;
    fakeEle.style.paddingLeft = styles.paddingLeft;
    fakeEle.style.paddingRight = styles.paddingRight;

    document.body.appendChild(fakeEle);

    const setWidth = function () {
        const string = textboxEle.value || textboxEle.getAttribute('placeholder') || '';
        fakeEle.innerHTML = string.replace(/\s/g, '&nbsp;');

        const fakeEleStyles = window.getComputedStyle(fakeEle);
        textboxEle.style.width = fakeEleStyles.width;
    };

    setWidth();

    textboxEle.addEventListener('input', function (e) {
        setWidth();
    });
});
</script>
@endforeach
{{-- endscript --}}

{{-- scr buat desk --}}
@foreach ($album as $list)
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const textboxEle = document.getElementById('textboxdesc{{$list->id}}');

    // Get the styles
    const styles = window.getComputedStyle(textboxEle);

    // Create a div element
    const fakeEle = document.createElement('div');
    fakeEle.style.position = 'absolute';
    fakeEle.style.top = '0';
    fakeEle.style.left = '-9999px';
    fakeEle.style.overflow = 'hidden';
    fakeEle.style.visibility = 'hidden';
    fakeEle.style.whiteSpace = 'nowrap';
    fakeEle.style.height = '0';

    // Copy font styles from the textbox
    fakeEle.style.fontFamily = styles.fontFamily;
    fakeEle.style.fontSize = styles.fontSize;
    fakeEle.style.fontStyle = styles.fontStyle;
    fakeEle.style.fontWeight = styles.fontWeight;
    fakeEle.style.letterSpacing = styles.letterSpacing;
    fakeEle.style.textTransform = styles.textTransform;

    fakeEle.style.borderLeftWidth = styles.borderLeftWidth;
    fakeEle.style.borderRightWidth = styles.borderRightWidth;
    fakeEle.style.paddingLeft = styles.paddingLeft;
    fakeEle.style.paddingRight = styles.paddingRight;

    document.body.appendChild(fakeEle);

    const setWidth = function () {
        const string = textboxEle.value || textboxEle.getAttribute('placeholder') || '';
        fakeEle.innerHTML = string.replace(/\s/g, '&nbsp;');

        const fakeEleStyles = window.getComputedStyle(fakeEle);
        textboxEle.style.width = fakeEleStyles.width;
    };

    setWidth();

    textboxEle.addEventListener('input', function (e) {
        setWidth();
    });
});
</script>
@endforeach
{{-- endscr --}}
@endsection