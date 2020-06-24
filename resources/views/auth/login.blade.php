@extends('layouts.app_admin_ui')
@section('content')

<style type="text/css">
  .login-page {
    background-image: url("images/login.jpg");
    swidth: 200px;
    background-color: #cccccc;
  }
</style>

<div class="tab-content col-md-6 offset-md-3">
  <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
    <div class="main-card mb-3 card">
      <div class="card-body">
        <h5 class="card-title">Inicia Sesión</h5>
        <form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="form-group has-feedback">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
              name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
              name="password" required>
            @if ($errors->has('password'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                  Mantener la sesión iniciada
                </label>
              </div>
            </div>
            <div class="col-md-4">

              <button type="submit" class="btn btn-primary btn-block btn-flat">
                Entrar
              </button>
            </div>
          </div>
        </form>
        <a href="{{ route('password.request') }}">
          ¿Recupera la contraseña?
        </a><br>
        <a href="register" class="text-center">Regístrate</a>
      </div>
    </div>
  </div>
  <div class="login-box">
    <div class="login-box-body">
      <p class="login-box-msg"></p>
    </div>
  </div>
  @endsection