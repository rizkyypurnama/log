@extends('layouts.dash')
@section('title', 'Album')

@section('content')

<!-- tengah -->
<div class="col-md-7 border-end border-start">
    <!-- bar atas -->
    
    <!-- posting -->
    @foreach ($feed as $list)
    @if ($list->userid == auth()->user()->id)
    
    <div class="posting py-3 px-3 border-bottom">
        <h5>Tambah Foto di album {{$list->namaalbum}} </h5>
        <div class="d-flex w-100">
            <div class="image" style="margin-right: 20px;">
                <img style="width: 40px; height: 40px; object-fit: cover; border-radius: 100%;" src="{{asset('profileimg/'.auth()->user()->fotoprofile)}}" alt="">
            </div>
            
            <div class="w-100 pl-2">
                <form action="/inserttambahfoto" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="judulfoto" placeholder="Beri judul Fotomu . . ." class="form-control border-0 border-bottom" required>
                    <input type="text" name="deskripsifoto" placeholder="Deskripsi . . ." class="form-control border-0" required>
                    <input type="file" name="lokasifile" class="form-control mt-1" required>
                    <input type="text" hidden name="albumid" value="{{$list->id}}">
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
    @endif
    @endforeach
    
    <!-- judul -->
    <div class="mt-3 px-2 py-3 border-bottom">
        <div class="d-flex justify-content-between align-items-center py-2">
            @foreach ($feed as $item)               
            <strong style="font-size: 16pt;">Foto di album {{$item->namaalbum}}</strong>
            @endforeach
            <i class="far fa-star"></i>
        </div>
    </div>
        
        {{-- isi --}}
        <div class="d-flex align-items-center border-bottom py-2">
            <div class="container">
                <div class="row">
                    @foreach ($feed as $list)
                        @foreach ($list->foto as $item)
                        <div class="col-md-4 mb-1">
                            <a href="/detailpost/{{$item->id}}"><img src="{{asset('postfoto/'.$item->lokasifile)}}" style="width: 200px; height:200px; object-fit:cover;"></a>
                        </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
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
@foreach ($feed as $list)
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
@foreach ($feed as $list)
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
@foreach ($feed as $list)
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