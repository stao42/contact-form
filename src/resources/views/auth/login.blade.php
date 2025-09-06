@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-form__content">
  <div class="auth-form__heading">
    <h2>Login</h2>
  </div>
  
  <form class="form" action="{{ route('login') }}" method="post">
    @csrf
    
    <div class="form__group">
      <div class="form__group-title">
        メールアドレス
      </div>
      <div class="form__input--text">
        <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" />
      </div>
      <div class="form__error">
        @error('email')
          {{ $message }}
        @enderror
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        パスワード
      </div>
      <div class="form__input--text">
        <input type="password" name="password" placeholder="coachtechnob" />
      </div>
      <div class="form__error">
        @error('password')
          {{ $message }}
        @enderror
      </div>
    </div>

    <div class="form__button">
      <button type="submit" class="form__button-submit form__button-primary">ログイン</button>
    </div>
  </form>
</div>
@endsection
