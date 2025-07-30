@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="contact__content">
    <h2 class="contact">Contact</h2>
    <form action="/confirm" method="post">
        @csrf
        <div class="form__group">
            <label for="name">お名前※</label>
            <div style="display: flex; gap: 10px;">
                <input type="text" name="last_name" placeholder="姓" required style="flex:1;">
                <input type="text" name="first_name" placeholder="名" required style="flex:1;">
            </div>
        </div>
        <div class="form__group">
            <label>性別※</label>
            <input type="radio" name="gender" value="man" checked> 男性
            <input type="radio" name="gender" value="woman"> 女性
            <input type="radio" name="gender" value="other"> その他
        </div>

        <div class="form__group">
            <label for="email">メールアドレス※</label>
            <input type="email" name="email" required placeholder="test@example.com">
        </div>

        <div class="form__group">
            <label for="tel">電話番号※</label>
            <input type="tel" name="tel" required placeholder="08012345678">
        </div>

        <div class="form__group">
            <label for="address">住所※</label>
            <input type="text" name="address" required placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
        </div>

        <div class="form__group">
            <label for="building">建物名</label>
            <input type="text" name="building" placeholder="千駄ヶ谷マンション101">
        </div>

        <div class="form__group">
            <label for="contact_sort">お問い合わせの種類※</label>
            <select name="contact_sort" id="contact_sort" required>
                <option value="" {{ old('contact_sort') == '' ? 'selected' : '' }}>選択してください</option>
                <option value="delivery" {{ old('contact_sort') == 'delivery' ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="exchange" {{ old('contact_sort') == 'exchange' ? 'selected' : '' }}>商品の交換について</option>
                <option value="trouble" {{ old('contact_sort') == 'trouble' ? 'selected' : '' }}>商品トラブル</option>
                <option value="inquiry" {{ old('contact_sort') == 'inquiry' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="other" {{ old('contact_sort') == 'other' ? 'selected' : '' }}>その他</option>
            </select>

        </div>

        <div class="form__group">
            <label for="contact_content">お問い合わせ内容※</label>
            <textarea name="contact_content" id="contact_content" cols="30" rows="4" required placeholder="お問い合わせ内容をご記載ください"></textarea>
        </div>

        <div class="form__group">
            <button type="submit" class="contact__submit">確認画面</button>
        </div>

    </form>
</div>
@endsection