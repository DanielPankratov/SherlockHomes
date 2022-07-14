{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.app')
@section('content')
{{-- <!doctype html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Phoenix</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicons/favicon.ico">
    <link rel="manifest" href="/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
    <link href="/css/phoenix.min.css" rel="stylesheet" id="style-default">
    <link href="/css/user.min.css" rel="stylesheet" id="user-style-default">
    <style>
      body {
        opacity: 0;
      }
    </style>
  </head>

  <body>
    <main class="main" id="top"> --}}
      <div class="container-fluid px-0">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3">
              <div class="d-flex flex-center text-decoration-none mb-4">
                <div class="d-flex align-items-center alignimagecenter">
                  <img src="\images\iconSH.png" alt="phoenix" width="58">
                </div>
              </div>
              <div class="text-center mb-7">
                <h3>Iniciar Sessão</h3>
                <p class="text-700">Tenha acesso à sua conta</p>
              </div>
          <form method="POST" action="{{ route('login') }}">
           @csrf

              <div class="mb-3 text-start"><label class="form-label" for="email">Endereço de Email</label>
                <div class="form-icon-container">
                <input id="email" type="email" class="form-control form-icon-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nome@exemplo.com">
                 @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                 @enderror

                <span class="fas fa-user text-900 fs--1 form-icon"></span>
                </div>
              </div>
              <div class="mb-3 text-start">
              <label class="form-label" for="password">{{ __('Password') }}</label>
                <div class="form-icon-container">
                <input id="password" type="password" class="form-control form-icon-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                <span class="fas fa-user text-900 fs--1 form-icon">
                </span></div>
              </div>
              <div class="row flex-between-center mb-7">
                {{-- <div class="col-auto">
                  <div class="form-check mb-0"><input class="form-check-input" id="basic-checkbox" type="checkbox" checked="checked"><label class="form-check-label mb-0" for="basic-checkbox">Remember me</label></div>
                </div> --}}
              </div><button   type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>
              <div class="text-center"><a class="fs--1 fw-bold" href="/register">Não tem uma conta? Crie aqui!</a></div>
                <div class="text-center"><a class="fs--1 fw-semi-bold" href="/forget-password">Recuperar Password</a></div>
            </form>
            
            </div>
          </div>
        </div>
      </div>
@endsection
    {{-- </main>
    <script src="/js/phoenix.js"></script>
  </body>

</html> --}}
