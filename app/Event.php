<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function medias(){
        return $this->hasMany("App\Media");
    }

    public function province()
    {
        return $this->belongsTo('App\Province');
    }

    public function displayOpenDate(){
        if($this->open_date){
            return date('Y年m月d日 H:i', strtotime($this->open_date));
        }
        return "";
    }

    public function endTime(){
        if($this->end_date){
            return date('H:i', strtotime($this->end_date));
        }
        return "";
    }

}
