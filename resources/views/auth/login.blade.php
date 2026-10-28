@extends('layouts.app')

@section('content')
    <h2>ログイン</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <p><label>メールアドレス<br><input type="email" name="email" value="{{ old('email') }}"></label></p>
        <p><label>パスワード<br><input type="password" name="password"></label></p>
        <button type="submit">ログイン</button>
    </form>
    <p><a href="{{ route('register') }}">ユーザー登録はこちら</a></p>
@endsection

