@extends('layouts.app')

@section('content')
    <div class="container h-100 py-5">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="/img/RedSocial.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                            </div>
                            <input
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror input_user"
                                    name="email"
                                    placeholder="Email"
                                    value="{{ old('email') }}"
                            >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input
                                    type="password"
                                    name="password"
                                    class="form-control input_pass @error('password') is-invalid @enderror"
                                    placeholder="contraseña">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button id="login" type="submit" dusk="login-btn" class="btn login_btn">Entrar</button>
                        </div>
                    </form>
                </div>

                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        No tienes una cuenta? <a href="{{ route('register') }}" class="ml-2">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-6 mx-auto">--}}
{{--                @include('partials.validation-errors')--}}
{{--                <div class="card border-0 bg-light px-4 py-2">--}}
{{--                    <form action="{{ route('login') }}" method="POST">--}}
{{--                        @csrf--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Email:</label>--}}
{{--                                <input class="form-control border-0"--}}
{{--                                       type="email"--}}
{{--                                       name="email"--}}
{{--                                       placeholder="Tu email..."--}}
{{--                                       value="{{ old('email') }}">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Contraseña:</label>--}}
{{--                                <input class="form-control border-0" type="password" name="password" placeholder="Tu contraseña...">--}}
{{--                            </div>--}}
{{--                            <button class="btn btn-primary btn-block" dusk="login-btn">Login</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
