<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produits')->insert([
            [
                'id_categorie' => 1,
                'prix' => 5.00
            ],
            [
                'id_categorie' => 1,
                'prix' => 2.69
            ],
            [
                'id_categorie' => 2,
                'prix' => 12.99
            ],
            [
                'id_categorie' => 2,
                'prix' => 22.98
            ],
            [
                'id_categorie' => 1,
                'prix' => 10.29
            ]
        ]);
    }
}
