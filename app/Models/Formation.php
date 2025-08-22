<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class Formation extends Model
{
    //

    protected $fillable = [
        'nom',
        'duree',
        'date_debut',
        'categorie',
        'niveau_difficulte',
        'nom_formateur',
        'user_id',
    ];


    public function formaModule(): HasMany{
        return $this -> hasMany(Module::class);
    }
}
