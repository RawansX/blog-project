<?php

use App\Models\Post;
use App\Models\User;

it('displays a list of posts', function () {
    $user = \App\Models\User::factory()->create();
    Post::factory()->count(3)->create();

    $response = $this->actingAs($user)->get(route('posts.index'));

    $response->assertOk();
});

it('allows an authenticated user to create a post', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('posts.store'), [
        'title' => 'مقال تجريبي',
        'content' => 'محتوى تجريبي للاختبار',
    ]);

    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseHas('posts', ['title' => 'مقال تجريبي']);
});

it('allows only the owner to update their post', function () {
    $post = Post::factory()->create();

    $response = $this->actingAs($post->user)->put(route('posts.update', $post), [
        'title' => 'عنوان محدّث',
        'content' => 'محتوى محدّث',
    ]);

    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseHas('posts', ['title' => 'عنوان محدّث']);
});

it('prevents a non-owner from updating a post', function () {
    $post = Post::factory()->create();
    $otherUser = User::factory()->create();

    $response = $this->actingAs($otherUser)->put(route('posts.update', $post), [
        'title' => 'محاولة تعديل غير مصرح',
        'content' => 'محتوى',
    ]);

    $response->assertForbidden();
});

it('allows only the owner to delete their post', function () {
    $post = Post::factory()->create();

    $response = $this->actingAs($post->user)->delete(route('posts.destroy', $post));

    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseMissing('posts', ['id' => $post->id]);
});

it('prevents a non-owner from deleting a post', function () {
    $post = Post::factory()->create();
    $otherUser = User::factory()->create();

    $response = $this->actingAs($otherUser)->delete(route('posts.destroy', $post));

    $response->assertForbidden();
});