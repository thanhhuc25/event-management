<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

}
