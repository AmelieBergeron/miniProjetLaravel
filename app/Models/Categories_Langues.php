<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Categories_Langues extends Pivot
{
    protected $table = 'categories_langue';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
}
