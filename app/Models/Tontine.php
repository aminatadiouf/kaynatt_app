<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tontine extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
    'libelle',
    'description',
    'montant',
    'nombre_participant',
    'regles',
    'date_de_debut',
    'periode',
    'etat',
    
];

public function user()
{
  return $this->belongsToMany(User::class,'tontine_users','user_id','tontine_id');
}

}
