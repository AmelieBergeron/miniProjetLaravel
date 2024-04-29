<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Produits_Langues extends Pivot
{
    //
    protected $table = 'produits_langue';   # mauvais nom à cause de la création du modèle, donc je spécifie le nouveau nom ici
}
