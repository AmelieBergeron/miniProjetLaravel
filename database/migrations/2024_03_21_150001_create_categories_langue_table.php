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
        Schema::create('categories_langue', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_categorie')->unsigned();
            $table->bigInteger('id_langue')->unsigned();
            $table->string('categorie');
            $table->string('description');
        });

        Schema::table('categories_langue', function (Blueprint $table) {
            $table->foreign('id_categorie')->references('id_categorie')->on('categories');
            $table->foreign('id_langue')->references('id_langue')->on('langues');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories__langue');
    }
};
