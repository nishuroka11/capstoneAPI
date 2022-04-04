@extends('layouts.authentication.app')
@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-xs-2">
                    <img src="https://nepalease.gizmoinnovation.com/assets/images/undraw/authentication.png" style="max-height:100px">
                </div>
                <div class="col-xs-10 text-center center-block" style="display: inline-block;vertical-align: middle;float: none;">
                    <div class="justify-content-center" style="min-height: 100%;display: flex;align-items: center;text-align: center;">
                        <h3 class="text-primary">{{config('app.name')}}</h3>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                            @include('auth.partials.session')
                        </div>
                        <form method="POST" action="{{ route('password.update') }}" class="user">
                            @csrf
                            <div class="form-group">
                                <h4>Requested password change for the email {{request('email')}}</h4>
                            </div>
                            <div class="form-group">
                                <input type="password"
                                       class="form-control-user {{getFormControlClass('password', $errors)}}"
                                       id="password" name="password" aria-describedby="passwordHelp"
                                       value="{{old('password')}}"
                                       placeholder="Enter Password...">
                                {!! getFormInputErrorMessage('password', $errors) !!}
                            </div>
                            <div class="form-group">
                                <input type="password"
                                       class="form-control-user {{getFormControlClass('password_confirmation', $errors)}}"
                                       id="password_confirmation" name="password_confirmation"
                                       aria-describedby="password_confirmationHelp"
                                       value="{{old('password_confirmation')}}"
                                       placeholder="Enter Password Confirmation...">
                                {!! getFormInputErrorMessage('password_confirmation', $errors) !!}
                            </div>
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <input type="hidden" name="email" value="{{request('email')}}">
                            <button class="btn btn-primary btn-user btn-block" type="submit">
                                Reset Password
                            </button>
                            <p class="text-muted mt-2"><i>If you did not request a password reset, you can close this page.</i></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
