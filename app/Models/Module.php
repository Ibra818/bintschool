<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Formation,};

class Module extends Model
{
    //

    protected $fillable = [
        'module',
        'module_video',
        'video_intro',
        'duree',
        'formation_id',
    ];

    public function moduleForm(){
        return $this -> belongsTo(Formation::class);
    }
}
