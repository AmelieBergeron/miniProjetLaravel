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
        Schema::create('produits_langue', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_produit')->unsigned();
            $table->bigInteger('id_langue')->unsigned();
            $table->string('produit');
            $table->string('description');
        });

        Schema::table('produits_langue', function (Blueprint $table) {
            $table->foreign('id_produit')->references('id_produit')->on('produits');
            $table->foreign('id_langue')->references('id_langue')->on('langues');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits__langue');
    }
};
