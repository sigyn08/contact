@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="register_content">
    <h2 class="register">Register</h2>

    {{-- 🔽 ここにエラーメッセージ表示ブロックを追加 --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="register_form" action="/register" method="post">
        @csrf
        <div class="register_table">
            <label for="name">お名前</label>
            <input type="text" name="name" value="{{ old('name') }}">

            <label for="email">メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}">

            <label for="password">パスワード</label>
            <input type="password" name="password">
        </div>
        <div class="register_button">
            <button type="submit" class="register_submit">登録</button>
        </div>
    </form>
</div>
@endsection