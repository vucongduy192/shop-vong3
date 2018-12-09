{{-- @extends('auth.layout') --}}
@extends('front-end.app_default')
@section('content')
    <link rel="stylesheet" href="/auth/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="/auth/css/style.css">
    
    <section class="signup">
        <div class="container" style="width: 900px;"> 
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">{{ __('Register') }}</h2>
                    <form class="register-form" id="register-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name"
                                   class="{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   value="{{ old('name') }}"
                                    autofocus/>
                            {!! $errors->first('name', '<span class="error">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email"
                                   class="{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder=" Your Email"
                                   value="{{ old('email') }}" />
                            {!! $errors->first('email', '<span class="error">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Password"
                                   class="{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   />
                            {!! $errors->first('password', '<span class="error">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="password_confirmation" id="re_pass"
                                   placeholder="Repeat your password"
                                   />
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit"
                                   value="{{ __('Register') }}"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="/auth/images/signup-image.jpg" alt="sing up image"></figure>
                    <a href="#" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>
@endsection