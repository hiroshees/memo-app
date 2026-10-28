@extends('layouts.app')

@section('content')
    <h2>メモ一覧</h2>
    <p><a href="{{ route('memos.create') }}">新規作成</a></p>
    <ul>
        @forelse ($memos as $memo)
            <li>
                <a href="{{ route('memos.edit', $memo) }}">{{ $memo->title }}</a>
                （{{ $memo->created_at->format('Y/m/d H:i') }}）
                [{{ $memo->category?->name ?? '未分類' }}]
                [{{ $memo->category?->id ?? '未分類' }}]
                [{{ $memo->user->name}}さん]
            </li>
        @empty
            <li>メモはまだありません。</li>
        @endforelse
    </ul>
@endsection
