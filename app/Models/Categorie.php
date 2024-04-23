<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id_categorie';
    public $timestamps = false;

    protected $fillable = [
        'id_categorie',
        'categorie',
        'description'
    ];

    public function produits(): HasMany
    {
      // Il faut préciser la classe (le modèle) avec laquelle la relation s’établit.
      return $this->HasMany(Produit::class, 'id_produit');
    }
}
