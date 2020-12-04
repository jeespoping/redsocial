@extends('layouts.app')

@section('content')
    <div class="container h-100 py-5">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="/img/RedSocial.png" alt="Logo" class="brand_logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input
                                    class="form-control @error('name') is-invalid @enderror input_user"
                                    type="text"
                                    name="name"
                                    placeholder="Nombre de usuario"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus
                                    autocomplete="name"
                            >
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input
                                    type="text"
                                    class="form-control @error('first_name') is-invalid @enderror input_user"
                                    name="first_name"
                                    placeholder="Primer nombre"
                                    value="{{ old('first_name') }}"
                                    required
                                    autocomplete="first_name"
                            >
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input
                                    type="text"
                                    class="form-control @error('last_name') is-invalid @enderror input_user"
                                    name="last_name"
                                    placeholder="Primer apellido"
                                    value="{{ old('last_name') }}"
                                    required
                                    autocomplete="last_name"
                            >
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror input_user"
                                    name="email"
                                    placeholder="Email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
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
                                    class="form-control @error('password') is-invalid @enderror input_user"
                                    name="password"
                                    placeholder="Contraseña"
                                    required
                            >
                            @error('password')
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
                                    class="form-control @error('password_confirmation') is-invalid @enderror input_user"
                                    name="password_confirmation"
                                    placeholder="Repita la Contraseña"
                                    required
                            >
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button class="btn login_btn" type="submit">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-6 mx-auto">--}}
{{--                @include('partials.validation-errors')--}}
{{--                <div class="card border-0 bg-light px-4 py-2">--}}
{{--                    <form action="{{ route('register') }}" method="POST">--}}
{{--                        @csrf--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Username:</label>--}}
{{--                                <input class="form-control border-0" type="text" name="name" placeholder="Tu nombre de usuario..." value="{{ old('name') }}">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Nombre:</label>--}}
{{--                                <input class="form-control border-0" type="text" name="first_name" placeholder="Tu nombre..."value="{{ old('first_name') }}">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Apellido:</label>--}}
{{--                                <input class="form-control border-0" type="text" name="last_name" placeholder="Tu apellido..." value="{{ old('last_name') }}">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Email:</label>--}}
{{--                                <input class="form-control border-0" type="email" name="email" placeholder="Tu email..." value="{{ old('email') }}">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Contraseña:</label>--}}
{{--                                <input class="form-control border-0" type="password" name="password" placeholder="Tu contraseña...">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Repite la contraseña:</label>--}}
{{--                                <input class="form-control border-0" type="password" name="password_confirmation" placeholder="Repite tu contraseña...">--}}
{{--                            </div>--}}
{{--                            <button class="btn btn-primary btn-block" dusk="register-btn">Registro</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
