<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RolesUsers extends Pivot
{
    use HasFactory;

    protected $table = 'roles_users';
    protected $primaryKey = 'id_roles_users';
    public $incrementing = true;
    public $timestamps = false;
}
