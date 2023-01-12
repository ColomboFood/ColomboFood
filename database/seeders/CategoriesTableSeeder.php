<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gastronomia = Category::create([
            'name' => 'Gastronomia',
            'featured' => true
        ]);
        Category::create([
            'name' => 'Primi piatti',
            'parent_id' => $gastronomia->id,
            'featured' => false
        ]);
        Category::create([
            'name' => 'Secondi piatti',
            'parent_id' => $gastronomia->id,
            'featured' => false
        ]);
        $pasta = Category::create([
            'name' => 'Pasta fresca',
            'featured' => true
        ]);
        $pasticceria = Category::create([
            'name' => 'Pasticceria',
            'featured' => true
        ]);
        Category::create([
            'name' => 'Torte',
            'parent_id' => $pasticceria->id,
            'featured' => false
        ]);
        
    }
}
