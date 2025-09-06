@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-form__content">
  <div class="auth-form__heading">
    <h2>Register</h2>
  </div>
  
  <form class="form" action="{{ route('register.post') }}" method="post">
    @csrf
    
    <div class="form__group">
      <div class="form__group-title">
        お名前
      </div>
      <div class="form__input--text">
        <input type="text" name="name" placeholder="例:山田 太郎" value="{{ old('name') }}" />
      </div>
      <div class="form__error">
        @error('name')
          {{ $message }}
        @enderror
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        メールアドレス
      </div>
      <div class="form__input--text">
        <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}" />
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
        <input type="password" name="password" placeholder="例:coachtech1306" />
      </div>
      <div class="form__error">
        @error('password')
          {{ $message }}
        @enderror
      </div>
    </div>

    <div class="form__button">
      <button type="submit" class="form__button-submit form__button-primary">登録</button>
    </div>
  </form>
</div>
@endsection
