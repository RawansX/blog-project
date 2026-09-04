<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'برمجة',
            'أمن سيبراني',
            'ذكاء اصطناعي',
            'تحليل بيانات',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }

        $categoryIds = Category::pluck('id');

        Post::whereNull('category_id')->get()->each(function ($post) use ($categoryIds) {
            $post->update(['category_id' => $categoryIds->random()]);
        });
    }
}