@extends('layouts.app')

@section('content')
    <div class="cover-container">
        <div class="row justify-content-center ">
            <div class="col-md-8">
                <div class="card rounded-4 shadow">
                    <div class="card-header p-5 pb-4 border-bottom-0">
                        <h1 class="fw-bold mb-0 fs-2">Registro</h1>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf



                            <div class="p-2">
                                <div class="form-floating mb-3">
                                    <input type="text" id="name"
                                        class="form-control rounded-2 @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="">
                                    <label for="name">Nombre Completo</label>
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="p-2">
                                <div class="form-floating mb-3">
                                    <input type="email" id="email"
                                        class="form-control rounded-2 @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="">
                                    <label for="email">Email</label>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="p-2">
                                <div class="form-floating mb-3">
                                    <input type="password" id="password"
                                        class="form-control rounded-2 @error('password') is-invalid @enderror" name="password"
                                        value="{{ old('password') }}" required autocomplete="password" autofocus placeholder="">
                                    <label for="password">Password</label>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="p-2">
                                <div class="form-floating mb-3">
                                    <input type="password" id="password-confirm"
                                        class="form-control rounded-2 @error('password-confirm') is-invalid @enderror" name="password_confirmation"
                                        value="{{ old('password-confirm') }}" required autocomplete="new-password" autofocus placeholder="">
                                    <label for="password-confirm">Confirmar Password</label>
                                </div>
                            </div>

                            <div class="p-2">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                       Registrar
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
