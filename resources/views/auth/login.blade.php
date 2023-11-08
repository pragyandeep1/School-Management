@extends('layouts/login')
@section('title', 'Login')
@section('content')
<section class="vh-100">
<div class="container-fluid">
<div class="row">
<div class="col-sm-6 px-0 d-none d-sm-block">

        <img src="{{'assets/login_form.jpg'}}"
          alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>

      <div class="col-sm-6 text-black">
        @if ($errors->has('email'))
            <div class="alert alert-danger mt-4 text-center error-message" role="alert">
                {{ $errors->first('email')}}
            </div>
        @endif
        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">


          <form style="width: 32rem;" method="POST" action="{{ route('login') }}">
          @csrf

          
            <div class="fw-normal mb-3 pb-3 logo-div">
          <i class="fas fa-crow fa-2x pt-5 mt-xl-4" style="color: #709085;"></i>
          <span class="h1 fw-bold mb-0">Logo</span>
        </div>

            <!-- <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3> -->

            <div class="form-outline mb-4">
              <label class="form-label" for="email">Email address</label>
              <input type="email" id="email" class="form-control {{$errors->has('email') ? ' is-invalid' : ''}} form-control-lg" name="email" value="{{ old('email') }}" required autofocus/>
              
            </div>

            <label class="form-label" for="password">Password</label>
            <div class="input-group mb-4">  
            <input name="password" type="password" value="" class="input form-control {{$errors->has('password') ? ' is-invalid' : ''}}" id="password" placeholder="password" required="true" aria-label="password" aria-describedby="basic-addon1" />
              <div class="input-group-append">
                <span class="input-group-text px-3 pwd_input" onclick="password_show_hide();">
                  <i class="fas fa-eye" id="show_eye"></i>
                  <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                </span>
              </div>

            </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-primary btn-block" type="submit">Login</button>
            </div>

            {{--<p class="small mb-5 pb-lg-2"><a class="text-muted" href="{{ route('password.request') }}">Forgot password?</a></p>
            <p>Don't have an account? <a href="{{ route('register') }}" class="link-info">Register here</a></p>--}}

          </form>

        </div>

      </div>
     
    </div>
  </div>
 
</section>
@endsection
