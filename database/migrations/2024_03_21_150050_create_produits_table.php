<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Pour pouvoir utiliser les clés étrangères et les transactions
            $table->bigIncrements('id_produit'); // Clé primaire automatiquement créée avec "bigIncrements()".
            $table->bigInteger('id_categorie')->unsigned();
            $table->decimal('prix', 10, 2);
            $table->foreign('id_categorie')->references('id_categorie')->on('categories'); //Clé étrangère sur "id_categorie" de la table categories

                # $table->string('produit');        // Géré par la table categories_langues
                # $table->string('description');    // Géré par la table categories_langues
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
