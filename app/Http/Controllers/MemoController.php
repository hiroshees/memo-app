<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemoRequest;
use App\Models\Category;
use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $memos = Memo::latest()->get();
        // $memos = Memo::with('category')->latest()->get();
        // $memos = Memo::query()
        //     ->leftJoin('categories', 'memos.category_id', '=', 'categories.id')
        //     ->select('memos.*', 'categories.name as category_name')
        //     ->orderByDesc('memos.created_at')
        //     ->get();
        // $r = Memo::query()
        //     ->leftJoin('categories', 'memos.category_id', '=', 'categories.id')
        //     ->select('memos.*', 'categories.name as category_name')
        //     ->orderByDesc('memos.created_at')
        //     ->toRawSql();
        // var_dump($r);

        $memos = $request->user()->memos()->with('category')->latest()->get();

        return view('memos.index', compact('memos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('memos.create');
        $categories = Category::orderBy('id')->get();

        return view('memos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    public function store(MemoRequest $request)
    {
        // $validated = $request->validate([
        //     'title' => ['required', 'max:100'],
        //     'body' => ['nullable', 'max:2000'],
        // ]);
        // Memo::create($validated);
        // Memo::create($request->validated());

        $request->user()->memos()->create($request->validated());

        return redirect()->route('memos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Memo $memo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Memo $memo)
    {
        // return view('memos.edit', compact('memo'));
        Gate::authorize('update', $memo);
        $categories = Category::orderBy('id')->get();

        return view('memos.edit', compact('memo', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Memo $memo)
    public function update(MemoRequest $request, Memo $memo)
    {
        // $validated = $request->validate([
        //     'title' => ['required', 'max:100'],
        //     'body' => ['nullable', 'max:2000'],
        // ]);

        // $memo->update($validated);

        $memo->update($request->validated());

        return redirect()->route('memos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Memo $memo)
    {
        Gate::authorize('delete', $memo);
        $memo->delete();

        return redirect()->route('memos.index');
    }
}
