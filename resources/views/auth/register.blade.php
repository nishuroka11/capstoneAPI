@extends('layouts.authentication.app')
@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">

                        <form method="POST" action="{{ route('register') }}" class="user">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text"
                                           class="{{getFormControlClass('first_name', $errors)}} form-control-user"
                                           name="first_name" id="first_name" value="{{ old('first_name') }}"
                                           placeholder="First Name">
                                    {!! getFormInputErrorMessage('first_name', $errors) !!}
                                </div>
                                <div class="col-sm-6">
                                    <input type="text"
                                           class="{{getFormControlClass('last_name', $errors)}} form-control-user"
                                           id="last_name" name="last_name" value="{{ old('last_name') }}"
                                           placeholder="Last Name">
                                    {!! getFormInputErrorMessage('last_name', $errors) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email"
                                       class="{{getFormControlClass('email', $errors)}} form-control-user"
                                       id="email" name="email" value="{{ old('email') }}"
                                       placeholder="Email Address">
                                {!! getFormInputErrorMessage('email', $errors) !!}
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password"
                                           class="{{getFormControlClass('password', $errors)}} form-control-user"
                                           id="password" name="password" placeholder="Password">
                                    {!! getFormInputErrorMessage('password', $errors) !!}
                                </div>
                                <div class="col-sm-6">
                                    <input type="password"
                                           class="{{getFormControlClass('password_confirmation', $errors)}} form-control-user"
                                           id="password-confirm" name="password-confirm"
                                           placeholder="Repeat Password">
                                    {!! getFormInputErrorMessage('password_confirmation', $errors) !!}
                                </div>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" type="submit">
                                Register Account
                            </button>
                            {{--<hr>
                            <a href="{{route('back.index')}}" class="btn btn-google btn-user btn-block">
                              <i class="fab fa-google fa-fw"></i> Register with Google
                            </a>
                            <a href="{{route('back.index')}}" class="btn btn-facebook btn-user btn-block">
                              <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                            </a>--}}
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
