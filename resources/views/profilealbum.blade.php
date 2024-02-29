@extends('layouts.profiledash')
@section('isi')

{{-- navbar --}}
<div class="d-flex align-items-center border-bottom">
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-0 px0 mb-0">
        <ul class="navbar navbar-nav px-3">
            <a href="/profile/{{$idacc}}"><li style="width: 100px;" class="navbar-item mediaprofile"><button class=" border-0 w-100 btnicon">Foto</button></li></a>
            <a href="/profilealbum/{{$idacc}}"><li style="border-bottom: dodgerblue solid 1px; width:100px;" class="navbar-item mediaprofile"><button class=" border-0 w-100 btnicon">Album</button></li></a>
            @if ($idacc == auth()->user()->id)
            <a href="/profileliketerbanyak/{{$idacc}}"><li style="width:100px;" class="navbar-item mediaprofile"><button class=" border-0 w-100 btnicon">Most Liked</button></li></a>
            <a href="/profilekomenterbanyak/{{$idacc}}"><li style="width:150px;" class="navbar-item mediaprofile"><button class=" border-0 w-100 btnicon">Most Comment</button></li></a>
            @endif
        </ul>
    </nav>
</div>

{{-- isi --}}
<div class="d-flex align-items-center border-bottom py-2">
    <table class="table" >
        <tbody>
            @foreach ($album as $list)   
            <tr>
                <td>{{ $loop->iteration }}.
                </td>
                <td>
                    <form action="/editalbumprofile/{{ $list->id }}/{{$idacc}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($idacc == auth()->user()->id)
                     <input type="text" name="namaalbum" id="textbox{{$list->id}}" style="border: none; width: fit-content; font-weight: 500px;" value="{{$list->namaalbum}}">
                     <small>&bullet; {{$list->tanggaldibuat}}</small>
                     <button type="submit" style="background-color: transparent; border:none;"><i style="color: sandybrown" class="fas fa-edit"></i></button>
                     <button type="button" style="background-color: transparent; border:none;" data-bs-toggle="modal" data-bs-target="#hapusalbum{{ $list->id }}"><i style="color: crimson" class="fas fa-trash"></i></button>    
                     <br>
                     <input type="text" name="deskripsi" id="textboxdesc{{$list->id}}" style=" font-size:14px; border: none; width: fit-content; font-weight: 500px;" value="{{$list->deskripsi}}">
                     @else
                     <input type="text" name="namaalbum" readonly id="textbox{{$list->id}}" style="border: none; width: fit-content; font-weight: 500px;" value="{{$list->namaalbum}}">
                     <small>&bullet; {{$list->tanggaldibuat}}</small>
                     <br>
                     <input type="text" name="deskripsi" readonly id="textboxdesc{{$list->id}}" style=" font-size:14px; border: none; width: fit-content; font-weight: 500px;" value="{{$list->deskripsi}}">
                     @endif
                    </form>
                </td>
                <td>
                    <a href="/tambahfoto/{{$list->id}}"><button style="border-radius: 5px;" class="btn btn-dark"><i style="color: white" class="fas fa-eye"></i></button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

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