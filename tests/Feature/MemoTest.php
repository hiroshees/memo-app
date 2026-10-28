<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('未ログインはログイン画面へリダイレクトされる', function () {
    $this->get('/memos')->assertRedirect('/login');
});

test('自分のメモだけ一覧に表示される', function () {
    $me = User::factory()->create();
    $other = User::factory()->create();
    $me->memos()->create(['title' => '自分のメモ']);
    $other->memos()->create(['title' => '他人のメモ']);

    $this->actingAs($me)->get('/memos')
        ->assertOk()
        ->assertSee('自分のメモ')
        ->assertDontSee('他人のメモ');
});

test('メモを作成できる', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => '仕事']);

    $this->actingAs($user)->post('/memos', [
        'title' => '新しいメモ',
        'category_id' => $category->id,
    ])->assertRedirect('/memos');

    $this->assertDatabaseHas('memos', [
        'title' => '新しいメモ',
        'user_id' => $user->id,
    ]);
});

test('タイトルは必須', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post('/memos', ['title' => ''])
        ->assertSessionHasErrors('title');
});

test('自分のメモを削除できる', function () {
    $user = User::factory()->create();
    $memo = $user->memos()->create(['title' => '消すメモ']);

    $this->actingAs($user)->delete("/memos/{$memo->id}")
        ->assertRedirect('/memos');

    $this->assertDatabaseMissing('memos', ['id' => $memo->id]);
});

test('他人のメモは編集も削除もできない', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $memo = $owner->memos()->create(['title' => '他人のメモ']);

    $this->actingAs($other)->get("/memos/{$memo->id}/edit")->assertForbidden();
    $this->actingAs($other)->put("/memos/{$memo->id}", ['title' => '改ざん'])->assertForbidden();
    $this->actingAs($other)->delete("/memos/{$memo->id}")->assertForbidden();

    $this->assertDatabaseHas('memos', ['id' => $memo->id, 'title' => '他人のメモ']);
});
