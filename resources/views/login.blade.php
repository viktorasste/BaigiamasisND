@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/login.css" />
<div class="container">
<div class="logo">
        <img class="logi-sign" src="/images/301220021_519483296798508_1235047204078362737_n.jpg" alt="">
    </div>
    <div>Login</div>
    
    <div>
      <form action="{{ route('login') }}" method="POST">
        @csrf

        <div>
          <label for="email">{{ __('Email Address') }}</label>
          <div>
              <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>>

          @error('email')
              <span role="alert">
                <strong>{{ $message }}</strong>
              </span>
          @enderror
          </div>
        </div>


        <div>
          <label for="email">{{ __('Password') }}</label>
          <div>
              <input type="password" id="password" name="password"  required autocomplete="current-password">

          @error('password')
              <span role="alert">
                <strong>{{ $message }}</strong>
              </span>
          @enderror
          </div>
        </div>

     
       
      </form>
    </div>
  <body>
    
    
    <p class="para-2">
      Not have an account? <a href="signup.html">Sign Up Here</a>
    </p>
  </body>
</html>

