@extends('layouts.authentication.app')
@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            @include('auth.partials.session')
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="user">
                            @csrf


                            <div class="form-group">
                                <input type="email"
                                       class="form-control-user {{getFormControlClass('email', $errors)}}"
                                       id="email" name="email" aria-describedby="emailHelp" value="{{old('email')}}"
                                       placeholder="Enter Email Address...">
                                {!! getFormInputErrorMessage('email', $errors) !!}
                            </div>

                            <div class="form-group">
                                <input type="password"
                                       class="{{getFormControlClass('password', $errors)}} form-control-user"
                                       name="password"
                                       id="password" placeholder="Password">
                                {!! getFormInputErrorMessage('password', $errors) !!}

                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck"
                                           name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" type="submit">
                                Login
                            </button>
                            {{--<hr>
                            <a href="{{route('back.index')}}" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Login with Google
                            </a>
                            <a href="{{route('back.index')}}" class="btn btn-facebook btn-user btn-block">
                                <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                            </a>--}}
                        </form>
                        <hr>
                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
