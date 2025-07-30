@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="login_content">
  <h2 class="login">Login</h2>
  <form class="login_form" action="/login" method="post">
    @csrf
    <div class="login_table">
      <label for="email">メールアドレス</label>
      <input type="email" name="email">
      <label for="password">パスワード</label>
      <input type="password" name="password">
    </div>
    <div class="login_button">
      <button type="submit" class="login_submit">ログイン</button>
    </div>
  </form>
</div>
@endsection