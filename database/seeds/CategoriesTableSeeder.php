<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Antipasti',
            'Primi',
            'Secondi',
            'Contorni',
            'Dolci'
        ];

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category;

            $slug = Str::of($newCategory->name)->slug('-');
            $newCategory->slug = $slug;
            
            $newCategory->save();
        }
    }
}
