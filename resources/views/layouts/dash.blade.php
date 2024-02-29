<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/style/main.css')}}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script defer src="{{asset('asset/skrp/a.js')}}"></script>
    <script defer src="{{asset('asset/skrp/b.js')}}"></script>
    <script defer src="{{asset('asset/skrp/c.js')}}"></script>
    <script defer src="{{asset('asset/skrp/script.js')}}"></script>
</head>
<body>
    

    <main>
        <div class="container">
            <div class="row pt-3">
                <!-- kiri -->
                <div class="col-md-2">
                    <div class="position-sticky" style="top:15px;">
                        <a href="/dashboard" class="logo-mk"><img src="{{asset('asset/img/dh.png')}}" style="width:35px;" alt=""></a>                  
                        <div class="menu">
                            <ul class="list-group menukiri">
                             <li class="list-group-item mt-3"><a href="/dashboard"><i class="fas fa-home"></i>Beranda</a></li>
                             <li class="list-group-item mt-3"><a href="/album"><i class="far fa-list-alt"></i>Album</a></li>
                              <li class="list-group-item mt-3"><a href="/notif/{{auth()->user()->id}}"><i class="fas fa-bell"></i></i>Notifikasi</a></li>
                              <li class="list-group-item mt-3"><a href="/profile/{{auth()->user()->id}}"><i class="fas fa-user"></i>Profil</a></li>
                              {{-- <li class="list-group-item mt-3"><a href="/livestream"><i class="fas fa-video"></i>Livestream</a></li> --}}
                              <li class="list-group-item mt-3"><a onclick="document.getElementById('logout-form').submit()"><i class="fas fa-sign-out-alt"></i>Log Out</a></li>
                              <form action="/logout" method="POST" id="logout-form" style="display: none;">
                                 @csrf
                               </form>

                            </ul>
                        </div>
                    </div>
                </div>

                @yield('content')

                <!-- kanan -->
                <div class="col-md-3 px-3">
                    
                    
                    {{-- <div class="trends mt-3 py-2 px-3" style="background-color: #f3f3f3; border-radius: 5px;">
                        <div class="header d-flex justify-content-between align-items-center">
                            <strong>Trending🔥🔥🔥</strong>
                        </div>
                        <div class="trend py-3">
                            <ul class="list-group">
                                    <strong>Most Liked</strong>
                                    @foreach ($liketrend as $list)
                                    @foreach ($feeds->where('id', '=', $list->fotoid) as $item)
                                    <li class="list-group-item"><a href="/detailpost/{{$item->id}}">
                                        <img src="{{asset('postfoto/'.$item->lokasifile)}}" style="width:50px; height:50px; object-fit:cover; border-radius:2px;" alt="">
                                        <span>{{$list->mycount}} Likes</span><br>
                                        <strong>{{'@'.$item->user->username}}</strong>
                                    </a></li>
                                        @endforeach
                                    @endforeach
                                    <strong>Most Comment</strong>
                                <li class="list-group-item"><a href="/profile/">
                                    <img src="{{asset('postfoto/fio.jpeg')}}" style="width:50px; height:50px; object-fit:cover; border-radius:2px;" alt="">
                                    <span>21 comments</span><br>
                                    <strong>Fiony</strong><small> @akunpalingramah </small>
                                    <small></small>
                                </a></li>
                            </ul>
                        </div>
                    </div> --}}
                    
                    
                    <div class="position-sticky" style="top:15px;">
                        <div class="trends mt-3 py-2 px-3"  style="background-color: #f3f3f3; border-radius: 5px;">
                            <div class="trend py-3" id="listteman">
                                <ul class="list-group">
                                    <strong>Mungkin Anda Kenal</strong>
                                    @foreach ($user as $list)
                                    <li class="list-group-item"><a href="/profile/{{$list->id}}">
                                        <img style="width: 40px; height: 40px; object-fit: cover; border-radius: 100%;" src="{{asset('profileimg/'.$list->fotoprofile)}}" alt="">
                                        <strong>{{$list->username}}</strong><br>
                                        <small>{{number_format($list->foto->count())}} Foto</small>
                                    </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{asset('asset/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>