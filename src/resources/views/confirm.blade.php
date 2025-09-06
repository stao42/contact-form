@extends('layouts.contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-form__content">
  <div class="confirm-form__heading">
    <h2>Confirm</h2>
  </div>
  <form class="form" action="/contacts" method="post">
    @csrf
    <div class="form__group">
      <div class="form__group-title">お名前</div>
      <div class="form__group-content">
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" />
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" />
        {{ $contact['first_name'] }} {{ $contact['last_name'] }}
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">性別</div>
      <div class="form__group-content">
        @php
          $genderMap = [1 => 'male', 2 => 'female', 3 => 'other'];
          $genderValue = $genderMap[$contact['gender']] ?? 'male';
        @endphp
        <input type="hidden" name="gender" value="{{ $genderValue }}" />
        @if($contact['gender'] == 1)
          男性
        @elseif($contact['gender'] == 2)
          女性
        @else
          その他
        @endif
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">メールアドレス</div>
      <div class="form__group-content">
        <input type="hidden" name="email" value="{{ $contact['email'] }}" />
        {{ $contact['email'] }}
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">電話番号</div>
      <div class="form__group-content">
        <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}" />
        <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}" />
        <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}" />
        {{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">住所</div>
      <div class="form__group-content">
        <input type="hidden" name="address" value="{{ $contact['address'] }}" />
        {{ $contact['address'] }}
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">建物名</div>
      <div class="form__group-content">
        <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}" />
        {{ $contact['building'] ?? '' }}
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">お問い合わせの種類</div>
      <div class="form__group-content">
        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
        @if($contact['category_id'] == 1)
          一般的なお問い合わせ
        @elseif($contact['category_id'] == 2)
          サポート
        @elseif($contact['category_id'] == 3)
          ビジネス
        @else
          その他
        @endif
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">お問い合わせ内容</div>
      <div class="form__group-content">
        <input type="hidden" name="detail" value="{{ $contact['detail'] }}" />
        {{ $contact['detail'] }}
      </div>
    </div>

    <div class="form__button">
      <button class="form__button-submit" type="submit">送信</button>
      <a href="{{ route('contact.index') }}" class="form__button-back">修正</a>
    </div>
  </form>
</div>
@endsection
