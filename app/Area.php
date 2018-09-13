<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';

    public function provinces(){
        return $this->hasMany("App\Province");
    }

}
