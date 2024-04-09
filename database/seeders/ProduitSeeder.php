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
        ['id_categorie' => 1,
        'produit' => 'Crayon de mine',
        'description' => 'Paquet de 10 crayons de marque HB',
        'prix' => 5.00],
        ['id_categorie' => 1,
        'produit' => 'Stylo bleu',
        'description' => 'Paquet de 10 stylos de marque BIC',
        'prix' => 2.69],
        ['id_categorie' => 2,
        'produit' => 'Calculatrice',
        'description' => 'Calculatrice de comptabilité',
        'prix' => 12.99],
        ['id_categorie' => 2,
        'produit' => 'Aiguisoir électrique',
        'description' => 'Aiguisoir électrique de marque GE',
        'prix' => 22.98],
        ['id_categorie' => 1,
        'produit' => 'Gomme à effacer',
        'description' => 'Paquet de 5 effaces',
        'prix' => 10.29]
        ]);
    }
}
