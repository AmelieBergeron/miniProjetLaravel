<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produit extends Model
{
    use HasFactory;
    protected $table = 'produits';
    protected $primaryKey = 'id_produit';
    public $timestamps = false;

    protected $fillable = [
        'id_categorie',
        'produit',
        'description',
        'prix'
    ];

    public function categorie(): BelongsTo
    {
        // Il faut préciser la classe (le modèle) avec laquelle la relation s’établit.
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function getProduitsLangue()
    {
        return $this->hasMany(Produits_Langues::class, 'id_produit');
    }

    public function traduction()
    {
        $langue = Langue::where('code', app()->getLocale())->first();
        // $this->getProduitsLangue essaie de cherche une table produits__langue (deux _), mais existe pas
        return $this->getProduitsLangue->where('id_langue', $langue->id_langue)->first();
    }
}
