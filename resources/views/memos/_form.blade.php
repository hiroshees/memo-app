<p>
    <label>タイトル<br>
    <input type="text" name="title" value="{{ old('title', $memo->title ?? '') }}"></label>
</p>
<p>
    <label>カテゴリ<br>
    <select name="category_id">
        <option value="">未分類</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                @selected(old('category_id', $memo->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select></label>
</p>
<p>
    <label>本文<br>
    <textarea name="body" rows="5" cols="40">{{ old('body', $memo->body ?? '') }}</textarea></label>
</p>
