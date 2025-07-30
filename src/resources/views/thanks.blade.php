@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="thanks__content">
  <h2 class="thanks">お問い合わせありがとうございました</h2>
  <a href="/" class="home-button">HOME</a>
</div>
@endsection