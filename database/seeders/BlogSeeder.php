<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'posted_by' => 1,
                'slug' => Str::slug(fake()->text(30)),
                'title' => fake()->text(30),
                'created_at' => Date::now()
            ]
            ,[
                'posted_by' => 1,
                'slug' => Str::slug(fake()->text(30)),
                'title' => fake()->text(30),
                'created_at' => Date::now()
            ]
            ,[
                'posted_by' => 1,
                'slug' => Str::slug(fake()->text(30)),
                'title' => fake()->text(30),
                'created_at' => Date::now()
            ]
            ,[
                'posted_by' => 1,
                'slug' => Str::slug(fake()->text(30)),
                'title' => fake()->text(30),
                'created_at' => Date::now()
            ]
            ,[
                'posted_by' => 1,
                'slug' => Str::slug(fake()->text(30)),
                'title' => fake()->text(30),
                'created_at' => Date::now()
            ]
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
