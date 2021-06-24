<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Vegetariano',
            'Vegano',
            'Senza glutine',
            'Piatto veloce',
            'Ricetta della tradizione'
        ];

        foreach($tags as $tag) {
            $newTag = new Tag();
            $newTag->name = $tag;

            $slug = Str::of($newTag->name)->slug('-');
            $newTag->slug = $slug;
            
            $newTag->save();
        }
    }
}
