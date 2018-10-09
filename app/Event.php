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

    private function _splitTime3Word($event, $index){
        $res = "";
        for($i=1; $i<=5; $i++){
            $suffix = "_".$index."_".$i;
            if($event[("opentime_day_hour_start".$suffix)] !="" && $event[("opentime_day_minute_start".$suffix)] !="" &&
                $event[("opentime_day_hour_end".$suffix)] !="" && $event[("opentime_day_minute_end".$suffix)] !="")
            {
                $res.=$this->_prefixZero($event[("opentime_day_hour_start".$suffix)]).
                    ":".$this->_prefixZero($event[("opentime_day_minute_start".$suffix)]);
                $res.="〜".$this->_prefixZero($event[("opentime_day_hour_end".$suffix)])
                    .":".$this->_prefixZero($event[("opentime_day_minute_end".$suffix)]) . "　";
            }
        }

        return "<div>". $res . "</div>";
    }

    private function _prefixZero($str){
        return strlen($str) < 2 ? "0".$str:$str;
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
            for($i=1; $i<=5; $i++){
                $s = "";
                $event = $this;
                if($i==1){
                    if($this->open_date){
                        $s = "<div>" . date('Y年m月d日 ', strtotime($this->open_date)). $this->_dayOfWeek($this->open_date). "</div>";
                        $s.=$this->_splitTime3Word($event, 1);
                        if($event[("comment_day_".$i)]){
                            $s.="<div>".nl2br($event[("comment_day_".$i)])."</div>";
                        }
                    }
                }
                else{
                    if($event[("open_date".$i)]){
                        $s = "<div>" . date('Y年m月d日 ', strtotime($event[("open_date".$i)])). $this->_dayOfWeek($event[("open_date".$i)]). "</div>";
                        $s.=$this->_splitTime3Word($event, $i);
                        if($event[("comment_day_".$i)]){
                            $s.="<div>".nl2br($event[("comment_day_".$i)])."</div>";
                        }
                    }
                }
                $str = $str . $s;
            }
            return $str;

        }catch (\Exception $e){
            return $str;
        }
    }



}
