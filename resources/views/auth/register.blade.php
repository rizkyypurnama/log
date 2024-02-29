<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
</head>
<body style="background-color: #E5E7EB; background-image: url({{asset('asset/img/1.png')}});">
    
    <section>
        <div class="container pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <form action="register" method="post">
                        @csrf
                        <div class="card border-0 shadow" style="border-radius: 20px;">
                            <div class="card-body">
                                <div class="text-center mt-3">
                                    <img src="{{asset('asset/img/dh.png')}}" width="50" >
                                </div>
                                <div class="form-outline mb-2 my-2 py-2">
                                    <label for="" class="form-label" >Nama Lengkap</label>
                                    <input type="text" name="namalengkap" class="form-control @error('namalengkap') is-invalid @enderror" auto value="{{@old('namalengkap')}}" >
                                    @error('namalengkap')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-outline mb-2">
                                    <label for="" class="form-label" >Alamat</label>
                                    <input type="text" name="alamat" class="form-control mb-0 @error('alamat') is-invalid @enderror" value="{{@old('alamat')}}">
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-outline mb-2">
                                    <label for="" class="form-label" >Username</label>
                                    <input type="text" name="username" class="form-control mb-0 @error('username') is-invalid @enderror" value="{{@old('username')}}">
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-outline mb-2">
                                    <label for="" class="form-label" >Email</label>
                                    <input type="email" name="email" class="form-control mb-0 @error('email') is-invalid @enderror" value="{{@old('email')}}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-outline mb-3">
                                    <label for="" class="form-label" >Password</label>
                                    <input type="password" name="password" class="form-control mb-0 @error('password') is-invalid @enderror">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="text-center w-100 mb-3">
                                    <button class="btn btn-dark mb-1">Daftar</button><br>
                                    <small>Sudah punya akun? <a href="login" style="text-decoration: none">Masuk disini</a></small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>