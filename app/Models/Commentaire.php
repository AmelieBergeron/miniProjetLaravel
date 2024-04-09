<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $table = 'commentaires';
    protected $primaryKey = 'id_commentaire';

    // À placer dans la classe "Commentaire" du fichier Commentaire.php du dossier "app/Models".
    protected $fillable = [
        'id_utilisateur',
        'id_produit',
        'telephone',
        'sujet',
        'question',
        'message'
    ];
}
