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
            $res =  date('Y年m月d日', strtotime($this->open_date));
            $e = $this;
            for($i=1; $i<=5;$i++){
                if(strlen($e[("opentime_day_hour_start_1_".$i)]) > 0 &&  strlen($e[("opentime_day_minute_start_1_".$i)])>0){
                    $h = $e[("opentime_day_hour_start_1_".$i)];
                    if(strlen($h)<2){
                        $h="0$h";
                    }
                    $m = $e[("opentime_day_minute_start_1_".$i)];
                    if(strlen($m)<2){
                        $m="0".$m;
                    }
                    $res.= " ".$h.":".$m;
                    if(strlen($e[("opentime_day_hour_end_1_".$i)]) > 0 &&  strlen($e[("opentime_day_minute_end_1_".$i)])>0){
                        $h2 = $e[("opentime_day_hour_end_1_".$i)];
                        if(strlen($h2)<2){
                            $h2="0".$h2;
                        }
                        $m2 = $e[("opentime_day_minute_end_1_".$i)];
                        if(strlen($m2)<2){
                            $m2="0".$m2;
                        }
                        $res.= " ~ ".$h2.":".$m2;
                    }
                    break;
                }
            }
            return $res;
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
    private function _splitTime3WordAdmin($event, $index){
        $res = "";
        $count = 0;
        for($i=1; $i<=5; $i++){
            $suffix = "_".$index."_".$i;
            if($event[("opentime_day_hour_start".$suffix)] !="" && $event[("opentime_day_minute_start".$suffix)] !=""
                )
            {
                $count++;
                $res.=$this->_prefixZero($event[("opentime_day_hour_start".$suffix)]).
                    ":".$this->_prefixZero($event[("opentime_day_minute_start".$suffix)]);
                if($event[("opentime_day_hour_end".$suffix)] !="" && $event[("opentime_day_minute_end".$suffix)] !=""){
                    $res.="〜".$this->_prefixZero($event[("opentime_day_hour_end".$suffix)])
                        .":".$this->_prefixZero($event[("opentime_day_minute_end".$suffix)]) . "　";
                }
                if($count >= 2){
                    $res.="<br/>";
                    $count = 0;
                }
            }
        }

        return "<div style='white-space: nowrap'>". $res . "</div>";
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
    public function displayOpenDatesAdmin(){
        $str = "";
        try{
            for($i=1; $i<=5; $i++){
                $s = "";
                $event = $this;
                if($i==1){
                    if($this->open_date){
                        $s = "<div>" . date('Y年m月d日 ', strtotime($this->open_date)). $this->_dayOfWeek($this->open_date). "</div>";
                        $s.=$this->_splitTime3WordAdmin($event, 1);
                    }
                }
                else{
                    if($event[("open_date".$i)]){
                        $s = "<div>" . date('Y年m月d日 ', strtotime($event[("open_date".$i)])). $this->_dayOfWeek($event[("open_date".$i)]). "</div>";
                        $s.=$this->_splitTime3WordAdmin($event, $i);
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
