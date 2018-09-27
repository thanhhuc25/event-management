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
            return date('Y年m月d日', strtotime($this->open_date));
        }
        return "";
    }

    private function _splitTime3Word($str){

        $arr = explode(",", $str);
        $filterArray = [];
        foreach ($arr as $a){
            $_a = trim($a);
            if(strlen($_a) > 0){
                $filterArray[]=$_a;
            }
        }
        $arr = $filterArray;
        $res = "";
        for($i=0 ;$i < count($arr); $i+=3){
            $res.="<div>";
            for($j=$i; $j<$i+3 && $j < count($arr); $j++){
                $res.=$arr[$j] . " ";
            }
            $res.="</div>";
        }
        return $res;
    }

    private function _dayOfWeek($str){
        $days = array("日","月","火","水","木","金","土");
        try{
            $res = date('w', strtotime($str));
            return "(".$days[$res].")";
        }catch (\Exception $err){
            return "";
        }
    }

    public function displayOpenDates(){
        $str = "";
        try{
            if($this->open_date){
                $s = "<div>" . date('Y年m月d日 ', strtotime($this->open_date)). $this->_dayOfWeek($this->open_date). "</div>";
                $str = $str . $s . $this->_splitTime3Word($this->open_date_time);
            }
            if($this->open_date2){
                $s = "<div>" . date('Y年m月d日 ', strtotime($this->open_date2)) . $this->_dayOfWeek($this->open_date2). "</div>";
                $str = $str . $s . $this->_splitTime3Word($this->open_date_time2);
            }
            if($this->open_date3){
                $s = "<div>" . date('Y年m月d日 ', strtotime($this->open_date3)) .$this->_dayOfWeek($this->open_date3).  "</div>";
                $str = $str . $s . $this->_splitTime3Word($this->open_date_time3);
            }
            if($this->open_date4){
                $s = "<div>" . date('Y年m月d日 ', strtotime($this->open_date4)) . $this->_dayOfWeek($this->open_date4). "</div>";
                $str = $str . $s . $this->_splitTime3Word($this->open_date_time4);
            }
            if($this->open_date5){
                $s = "<div>" . date('Y年m月d日 ', strtotime($this->open_date5)) . $this->_dayOfWeek($this->open_date5). "</div>";
                $str = $str . $s . $this->_splitTime3Word($this->open_date_time5);
            }
            return $str;

        }catch (\Exception $e){
            return $str;
        }
    }



}
