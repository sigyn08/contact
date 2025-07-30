@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="admin-container">
  <h2 class="admin-title">Admin</h2>

  {{-- 検索フォーム --}}
  <form method="GET" action="{{ route('admin') }}" class="filter-form">
    <input type="text" name="keyword" placeholder="名前を入力" value="{{ request('keyword') }}">
    <input type="text" name="email" placeholder="メールアドレスを入力" value="{{ request('email') }}">

    <select name="gender">
      <option value="">性別</option>
      <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
      <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
      <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
    </select>

    <select name="category">
      <option value="">お問い合わせの種類</option>
      <option value="交換" {{ request('category') == '交換' ? 'selected' : '' }}>商品の交換について</option>
      <option value="返品" {{ request('category') == '返品' ? 'selected' : '' }}>返品について</option>
    </select>

    <input type="date" name="date" value="{{ request('date') }}">

    <button type="submit" class="btn search">検索</button>
    <a href="{{ route('admin') }}" class="btn reset">リセット</a>
  </form>

  <button class="btn export">エクスポート</button>

  {{-- テーブル --}}
  <table class="admin-table">
    <thead>
      <tr>
        <th>お名前</th>
        <th>性別</th>
        <th>メールアドレス</th>
        <th>お問い合わせの種類</th>
        <th>詳細</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($contacts as $contact)
      <tr>
        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
        <td>{{ $contact->gender }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->contact_sort }}</td>
        <td>
          <details class="details-box">
            <summary class="btn detail">詳細</summary>
            <div class="details-content">
              <p><strong>名前：</strong>{{ $contact->last_name }} {{ $contact->first_name }}</p>
              <p><strong>性別：</strong>{{ $contact->gender }}</p>
              <p><strong>メール：</strong>{{ $contact->email }}</p>
              <p><strong>電話：</strong>{{ $contact->tel ?? '―' }}</p>
              <p><strong>住所：</strong>{{ $contact->address ?? '―' }} {{ $contact->building ?? '' }}</p>
              <p><strong>種類：</strong>{{ $contact->contact_sort }}</p>
              <p><strong>内容：</strong>{{ $contact->contact_content }}</p>
              <p><strong>登録日：</strong>{{ $contact->created_at->format('Y-m-d') }}</p>

              <form method="POST" action="{{ route('admin.destroy', $contact->id) }}" onsubmit="return confirm('本当に削除しますか？')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn delete">削除</button>
              </form>
            </div>
          </details>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{-- ページネーション --}}
  <div class="pagination">
    {{ $contacts->links() }}
  </div>

  {{-- ログアウト --}}
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn logout">ログアウト</button>
  </form>
</div>
@endsection