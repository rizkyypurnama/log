<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
</head>
<body style="background-color: #E5E7EB; background-image: url({{asset('asset/img/1.png')}});">
    
    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card border-0 shadow" style="border-radius: 20px;">
                        <form action="login" method="post">
                            @csrf
                            <div class="card-body">
                                @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{session('success')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                                  @endif
                                <div class="text-center mt-3">
                                    <img src="{{asset('asset/img/dh.png')}}" width="50" >
                                </div>
                                @if (session()->has('gagal'))
                                    <small style="color: crimson">{{session('gagal')}}</small>
                                @endif
                                <div class="form-outline mb-2 my-2 py-2">
                                    <label for="" class="form-label" >Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" autofocus required value="{{@old('email')}}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-outline mb-5">
                                    <label for="" class="form-label" >Password</label>
                                    <input type="password" name="password" class="form-control mb-0" required>
                                </div>
                                <div class="text-center w-100 mb-3">
                                    <button class="btn btn-dark mb-1">Masuk</button><br>
                                    <small>Belum punya akun? <a href="register" style="text-decoration: none">Daftar disini</a></small>
                                </div>
                            </div>
                        </form>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('asset/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>