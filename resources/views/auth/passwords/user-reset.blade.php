
<link href="{{asset('public/css/custom.css')}}" rel="stylesheet">

<link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">

<link href="{{asset('public/css/custom-style.css')}}" rel="stylesheet">

<div class="modal-dialog" role="document">
    <div class="modal-content border">
        <div class="modal-header" data-blast="bgColor">
            <h5 class="modal-title" id="registerModalLabel">Reset Password</h5>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('resetPasswordUser') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $email) }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block text-dark">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">New Password</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block text-dark">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="col-md-8 control-label">Confirm New Password</label>
                    <div class="col-md-12">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block text-dark">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 right-w3l">
                        <input type="submit" class="form-control" value="Reset Password">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
