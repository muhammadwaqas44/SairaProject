@extends('layouts.app')
@section('styles')
<style>
    .btn-info {
    background-color: #D4A23B;
    border-color: #D4A23B;
}
.btn-info:active {
    background-color: #D4A23B;
    border-color: #D4A23B;
}.btn-info:hover {
    background-color: #8e6c27;
    border-color: #8e6c27;
}
.login-page, .register-page {
    background: black;
}
.login-logo a, .register-logo a {
    color: #ffffff;
}
.btn-info:not(:disabled):not(.disabled).active, .btn-info:not(:disabled):not(.disabled):active, .show>.btn-info.dropdown-toggle {
    color: #fff;
    background-color: #D4A23B;
    border-color: #D4A23B;
}
</style>
@endsection
@section('content')
<div class="hold-transition login-page">
    <div class="login-box">
        <img src={{ asset('public/admin/dist/img/luxup-logo.png') }} alt="AdminLTE Logo" height="250px;" class="ml-5" width="250px;" style="opacity: .8">
        <div class="login-logo">
            <a href="#"><b>Luxup</b> Admin</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{ __('Reset Password') }}</p>

                <form action="{{ route('password.update') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $email) }}" required placeholder="Email"  autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-6 offset-md-3">
                            <button type="submit" class="btn btn-info btn-block">{{ __('Reset Password') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
@endsection