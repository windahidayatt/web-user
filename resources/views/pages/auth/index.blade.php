@extends('layouts.login')

@section('container-login')
<div class="row">
    <div class="col-lg-5 col-img-login">
        <img class="img-fluid" src="{{ url('assets/images/banner-login.png') }}" alt="login-img" width="100">
    </div>
    <div class="col-lg-7 col-form-login">
        <img src="{{ url('assets/images/logo-users.png') }}" alt="logo-users" width="100">
        <div class="form-login">
            <h1>Selamat Datang</h1>
            <p>Silahkan masuk dengan username & password aktif anda.</p>

            <form action="/login" method="post">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Tulis Username Anda">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group mb-3" id="show_hide_password_login">
                        <input type="password" name="password" class="form-control input-with-eye" placeholder="Tulis Password Anda" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text eye-addon" id="basic-addon2">
                                <a href="" onclick="showHidePassword('show_hide_password_login')"><i class="fa fa-eye eye-addon-icon" aria-hidden="true"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
                  
                <button type="submit" class="btn btn-primary btn-block mt-5">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection