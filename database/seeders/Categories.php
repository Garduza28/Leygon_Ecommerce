<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Laptops',
            'slug' => 'laptops',
            'description' => 'Category for laptops',
            'image_path' => 'laptops.png'
        ]);

        Category::create([
            'name' => 'Phones',
            'slug' => 'phones',
            'description' => 'Category for phones',
            'image_path' => 'phones.png'
        ]);

        Category::create([
            'name' => 'Audio',
            'slug' => 'audio',
            'description' => 'Category for audio devices',
            'image_path' => 'audio.png'
        ]);

        Category::create([
            'name' => 'TV',
            'slug' => 'tv',
            'description' => 'Category for TVs',
            'image_path' => 'tv.png'
        ]);

        Category::create([
            'name' => 'Camera',
            'slug' => 'camera',
            'description' => 'Category for cameras',
            'image_path' => 'camera.png'
        ]);
    }
}