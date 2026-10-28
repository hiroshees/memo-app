<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MemoRequest extends FormRequest
{
    public function authorize(): bool
    {
        // return true;
        $memo = $this->route('memo');

        // 新規作成（memoがない）はOK、更新は持ち主だけ
        return $memo === null || $this->user()->can('update', $memo);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:100'],
            // 'title' => ['max:100'],
            'body' => ['nullable', 'max:2000'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ];

    }

    public function attributes(): array
    {
        return [
            'title' => 'タイトル',
            'body' => '本文',
            'category_id' => 'カテゴリ',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attributeは必須です。',
            'max' => ':attributeは:max文字以内で入力してください。',
            'exists' => '選択された:attributeは存在しません。',
        ];
    }
}
