<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// utiliser extends Pivot pour représenter la table association
class UserTontine extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tontine_id',
        'statut',
        'date',
];
}
