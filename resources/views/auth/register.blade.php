@extends('layouts.app')

@section('content')
    <h2>ユーザー登録</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <p><label>名前<br><input type="text" name="name" value="{{ old('name') }}"></label></p>
        <p><label>メールアドレス<br><input type="email" name="email" value="{{ old('email') }}"></label></p>
        <p><label>パスワード<br><input type="password" name="password"></label></p>
        <p><label>パスワード（確認）<br><input type="password" name="password_confirmation"></label></p>
        <button type="submit">登録</button>
    </form>
    <p><a href="{{ route('login') }}">ログインはこちら</a></p>
@endsection
