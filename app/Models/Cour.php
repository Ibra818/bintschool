<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User,};

class Cour extends Model
{
    //

    public function courUser(){
        return $this -> belongsTo(User::class);
    }
}
