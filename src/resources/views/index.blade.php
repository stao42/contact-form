@extends('layouts.contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
  <div class="contact-form__heading">
    <h2>Contact</h2>
  </div>
  <form class="form" action="/confirm" method="post">
    @csrf
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お名前</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--name">
          <input type="text" name="last_name" placeholder="例:山田" value="{{ old('last_name', $oldData['last_name'] ?? '') }}" />
          <input type="text" name="first_name" placeholder="例:太郎" value="{{ old('first_name', $oldData['first_name'] ?? '') }}" />
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
          @php
            $genderValue = old('gender', $oldData['gender'] ?? 'male');
            // 数値の場合は文字列に変換
            if (is_numeric($genderValue)) {
              $genderMap = [1 => 'male', 2 => 'female', 3 => 'other'];
              $genderValue = $genderMap[$genderValue] ?? 'male';
            }
          @endphp
          <label><input type="radio" name="gender" value="male" {{ $genderValue == 'male' ? 'checked' : '' }}> 男性</label>
          <label><input type="radio" name="gender" value="female" {{ $genderValue == 'female' ? 'checked' : '' }}> 女性</label>
          <label><input type="radio" name="gender" value="other" {{ $genderValue == 'other' ? 'checked' : '' }}> その他</label>
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
          @if($errors->hasAny(['tel1', 'tel2', 'tel3']))
            @if($errors->has('tel1'))
              {{ $errors->first('tel1') }}
            @elseif($errors->has('tel2'))
              {{ $errors->first('tel2') }}
            @elseif($errors->has('tel3'))
              {{ $errors->first('tel3') }}
            @endif
          @endif
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
          <select name="category_id">
            <option value="">選択してください</option>
            <option value="1" {{ old('category_id', $oldData['category_id'] ?? '') == '1' ? 'selected' : '' }}>一般的なお問い合わせ</option>
            <option value="2" {{ old('category_id', $oldData['category_id'] ?? '') == '2' ? 'selected' : '' }}>サポート</option>
            <option value="3" {{ old('category_id', $oldData['category_id'] ?? '') == '3' ? 'selected' : '' }}>ビジネス</option>
            <option value="4" {{ old('category_id', $oldData['category_id'] ?? '') == '4' ? 'selected' : '' }}>その他</option>
          </select>
        </div>
        <div class="form__error">
          @error('category_id')
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
          <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $oldData['detail'] ?? '') }}</textarea>
        </div>
        <div class="form__error">
          @error('detail')
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
