<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メモアプリ</title>
</head>
<body>
    <h1><a href="{{ route('memos.index') }}">メモアプリ</a></h1>
    @auth
        <p>
            {{ auth()->user()->name }}さん
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        </p>
        @endauth
    @yield('content')
</body>
</html>
