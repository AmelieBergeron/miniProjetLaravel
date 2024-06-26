<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([   #table "vide", puisqu'il n'y a que l'ID (qui se met automatiquement), les infos se retrouvent dans le tableau categorie_langue
            [], #catégorie 1
            []  #catégorie 2
        ]);
    }
}
