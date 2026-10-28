@extends('layouts.app')

@section('content')
    <h2>メモ編集</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('memos.update', $memo) }}">
        @csrf
        @method('PUT')
        @include('memos._form')
        <button type="submit">更新</button>
    </form>

    <form method="POST" action="{{ route('memos.destroy', $memo) }}"
          onsubmit="return confirm('削除しますか？')">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>
@endsection

