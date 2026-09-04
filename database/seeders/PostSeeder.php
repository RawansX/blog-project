<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $users = User::factory()->count(3)->create();
            $users->each(fn ($user) => $user->assignRole('author'));
        }

        Post::factory()
            ->count(10)
            ->recycle($users)
            ->create();
    }
}