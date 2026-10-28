@extends('layouts.app')

@section('content')
    <h2>メモ作成</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('memos.store') }}">
        @csrf
        @include('memos._form')
        <button type="submit">保存</button>
    </form>
@endsection
