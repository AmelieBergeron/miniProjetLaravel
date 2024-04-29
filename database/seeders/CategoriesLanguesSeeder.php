<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesLanguesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories_langue')->insert([
            # FRANÇAIS #
            [
                'id_langue' => '1',
                'id_categorie' => '1',
                'categorie' => 'Papeterie',
                'description' => 'Article de bureau en lien avec la papeterie'
            ],
            [
                'id_langue' => '1',
                'id_categorie' => '2',
                'categorie' => 'Électronique',
                'description' => 'Article de bureau électronique'
            ],

            # ENGLISH #
            [
                'id_langue' => '2',
                'id_categorie' => '1',
                'categorie' => 'Stationery',
                'description' => 'Office item related to stationery'
            ],
            [
                'id_langue' => '2',
                'id_categorie' => '2',
                'categorie' => 'Électronic',
                'description' => 'Electronic office item'
            ]
        ]);
    }
}
