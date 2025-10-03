<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Simple test data first
        $pages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'meta_title' => 'Home Page',
                'meta_description' => 'Home page description',
                'content' => json_encode(['test' => 'content']),
                'is_active' => true,
            ],
            [
                'title' => 'About Us',
                'slug' => 'about',
                'meta_title' => 'About Us',
                'meta_description' => 'About us description',
                'content' => json_encode(['test' => 'content']),
                'is_active' => true,
            ]
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }

        $this->command->info('Pages seeded successfully!');
    }
}