<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Database\Seeders\CategoriesTableSeeder;
use App\Database\Seeders\ProductsTableSeeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Array com as possíveis categorias
        $categories = ['Tecnologia', 'Esportes', 'Música', 'Culinária', 'Moda', 'Viagem', 'Arte', 'Filmes', 'Livros', 'Jogos'];

        // Gerando 20 categorias aleatórias
        for ($i = 1; $i <= 20; $i++) {
            $category = [
                'name' => $categories[array_rand($categories)] . " - " . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('categories')->insert($category);
        }

        $categoriesList = DB::table('categories')->pluck('id');

        for ($i = 1; $i <= 20; $i++) {
            DB::table('products')->insert([
                'name' => 'Product ' . $i,
                'detail' => 'Detail for Product ' . $i,
                'price' => rand(10, 100),
                'category_id' => $categoriesList->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
