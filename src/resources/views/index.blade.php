@extends('layouts.contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
  <div class="contact-form__heading">
    <h2>Contact</h2>
  </div>
  <form class="form" action="contacts/confirm" method="post">
    @csrf
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お名前</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--name">
          <input type="text" name="first_name" placeholder="例:山田" value="{{ old('first_name', $oldData['first_name'] ?? '') }}" />
          <input type="text" name="last_name" placeholder="例:太郎" value="{{ old('last_name', $oldData['last_name'] ?? '') }}" />
        </div>
        <div class="form__error">
          @error('first_name')
          {{ $message }}
          @enderror
          @error('last_name')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">性別</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--radio">
          <label><input type="radio" name="gender" value="male" {{ old('gender', $oldData['gender'] ?? 'male') == 'male' ? 'checked' : '' }}> 男性</label>
          <label><input type="radio" name="gender" value="female" {{ old('gender', $oldData['gender'] ?? '') == 'female' ? 'checked' : '' }}> 女性</label>
          <label><input type="radio" name="gender" value="other" {{ old('gender', $oldData['gender'] ?? '') == 'other' ? 'checked' : '' }}> その他</label>
        </div>
        <div class="form__error">
          @error('gender')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">メールアドレス</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email', $oldData['email'] ?? '') }}" />
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">電話番号</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--tel">
          <input type="tel" name="tel1" placeholder="080" maxlength="3" value="{{ old('tel1', $oldData['tel1'] ?? '') }}" />
          <span class="tel-separator">-</span>
          <input type="tel" name="tel2" placeholder="1234" maxlength="4" value="{{ old('tel2', $oldData['tel2'] ?? '') }}" />
          <span class="tel-separator">-</span>
          <input type="tel" name="tel3" placeholder="5608" maxlength="4" value="{{ old('tel3', $oldData['tel3'] ?? '') }}" />
        </div>
        <div class="form__error">
          @error('tel1')
          {{ $message }}
          @enderror
          @error('tel2')
          {{ $message }}
          @enderror
          @error('tel3')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">住所</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', $oldData['address'] ?? '') }}" />
        </div>
        <div class="form__error">
          @error('address')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">建物名</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building', $oldData['building'] ?? '') }}" />
        </div>
        <div class="form__error">
          @error('building')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お問い合わせの種類</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--select">
          <select name="inquiry_type">
            <option value="">選択してください</option>
            <option value="general" {{ old('inquiry_type', $oldData['inquiry_type'] ?? '') == 'general' ? 'selected' : '' }}>一般的なお問い合わせ</option>
            <option value="support" {{ old('inquiry_type', $oldData['inquiry_type'] ?? '') == 'support' ? 'selected' : '' }}>サポート</option>
            <option value="business" {{ old('inquiry_type', $oldData['business'] ?? '') == 'business' ? 'selected' : '' }}>ビジネス</option>
            <option value="other" {{ old('inquiry_type', $oldData['other'] ?? '') == 'other' ? 'selected' : '' }}>その他</option>
          </select>
        </div>
        <div class="form__error">
          @error('inquiry_type')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お問い合わせ内容</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--textarea">
          <textarea name="content" placeholder="お問い合わせ内容をご記載ください">{{ old('content', $oldData['content'] ?? '') }}</textarea>
        </div>
        <div class="form__error">
          @error('content')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__button">
      <button class="form__button-submit" type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection
