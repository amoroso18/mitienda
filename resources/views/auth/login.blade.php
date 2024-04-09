@extends('layouts.app')

@section('content')
<div class="cover-container">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            <div class="card rounded-4 shadow">
                <div class="card-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Ingresar</h1>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="p-2">
                            <div class="form-floating mb-3">
                                <input type="email" id="email"
                                    class="form-control rounded-2 @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="">
                                <label for="email">Correo electrónico</label>
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
                                <label for="password">Contraseña</label>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Ingresar
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
