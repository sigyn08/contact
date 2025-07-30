@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}?v={{ time()}}">
@endsection

@section('content')
<div class="confirm__content">
  <h2 class="confirm">confirm</h2>
  <form class="form" action="/thanks" method="post">
    @csrf
    <div class="form-table">
      <table class="form-table__inner">
        <tr class="form-table__row">
          <th class="form-table__header">お名前</th>
          <td class="form-table__text">
            <div>
              <input name="last_name" type="text" value="{{ $contact['last_name'] ?? '' }}" readonly>
              <input name="first_name" type="text" value="{{ $contact['first_name'] ?? '' }}" readonly>
            </div>
          </td>
        </tr>
        <tr class="form-table__row">
          <th class="form-table__header">性別</th>
          <td class="form-table__text">
            @php
            $genderLabels = [
            'man' => '男性',
            'woman' => '女性',
            'other' => 'その他',
            ];
            $genderValue = $genderLabels[$contact['gender']] ?? '';
            @endphp
            <input type="hidden" name="gender" value="{{ $genderValue }}" required readonly />
            @if ($contact['gender'] === 'man')
            男性
            @elseif ($contact['gender'] === 'woman')
            女性
            @elseif ($contact['gender'] === 'other')
            その他
            @endif
          </td>
        </tr>
        <tr class="form-table__row">
          <th class="form-table__header">メールアドレス</th>
          <td class="form-table__text">
            <input name="email" type="email" value="{{ $contact['email'] ?? '' }}" required readonly />
          </td>
        </tr>
        <tr class="form-table__row">
          <th class="form-table__header">電話番号</th>
          <td class="form-table__text">
            <input type="tel" name="tel" value="{{ $contact['tel'] ?? '' }}" required readonly />
          </td>
        </tr>
        <tr class="form-table__row">
          <th class="form-table__header">住所</th>
          <td class="form-table__text">
            <input type="text" name="address" value="{{ $contact['address'] ?? '' }}" readonly />
          </td>
        </tr>
        <tr class="form-table__row">
          <th class="form-table__header">建物名</th>
          <td class="form-table__text">
            <input type="text" name="building" value="{{ $contact['building'] ?? '' }}" readonly />
          </td>
        </tr>
        <tr class="form-table__row">
          <th class="form-table__header">お問い合わせの種類</th>
          <td class="form-table__text">
            @php
            $sortLabels = [
            'delivery' => '商品のお届けについて',
            'exchange' => '商品の交換について',
            'trouble' => '商品トラブル',
            'inquiry' => 'ショップへのお問い合わせ',
            'other' => 'その他',
            ];
            $selectedSort = trim($contact['contact_sort'] ?? '');
            @endphp
            <input type="hidden" name="contact_sort" value="{{ $selectedSort }}">
            {{ $sortLabels[$selectedSort] ?? '未選択' }}
          </td>
        </tr>
        <tr class="form-table__row">
          <th class="form-table__header">お問い合わせ内容</th>
          <td class="form-table__text">
            <textarea name="contact_content" readonly>{{ $contact['contact_content'] ?? '' }}</textarea>
          </td>
        </tr>
      </table>
    </div>
    <div class="form__buttons">
      <button type="submit" class="form-buttons__submit">送信</button>
      <button type="button" class="form-buttons__back">修正</button>
    </div>
  </form>
</div>
@endsection