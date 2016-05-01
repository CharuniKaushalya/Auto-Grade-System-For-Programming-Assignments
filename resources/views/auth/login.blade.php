@extends('layouts.single')

@section('content')
    <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default" style="border: 2px solid #014202;   position: relative;top: 100px;">
                        <div class="panel-heading" style="background:#014202;text-align:center;color: #fff;border: 1px solid #014202;font-size: 20px;text-transform: uppercase;font-weight: 300;">Login</div>
                        <div class="panel-body">
                            <br/>
                         
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                {!! csrf_field() !!}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label" style="text-align:right">E-Mail Address</label>

                                    <div class="col-md-8">
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label" style="text-align:right">Password</label>

                                    <div class="col-md-8">
                                        <input type="password" class="form-control" name="password">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-2 col-md-offset-2">
                                        <button type="submit" class="btn btn-theme ">
                                            <i class="fa fa-btn fa-sign-in"></i> Login
                                        </button>

                                        
                                    </div>
                                    <a class="btn btn-link col-md-1 col-md-offset-1" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                </div>
                                <hr>
                                <div class="registration" style="text-align:center">
                                    Don't have an account yet?<br/>
                                    <a class="" href="{{ url('/register') }}">
                                        Create an account
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                            
                        
@endsection