<?php
// PHP program to convert timestamp to time ago

date_default_timezone_set("Asia/Karachi");

function timeago($time,$tense='ago')
{
    static $periods=array('year','month','day','hour','minute','second');
    $now=new DateTime('now');
    $time=new DateTime($time);
    $diff=$now->diff($time)->format('%y %m %d %h %i %s');
    $diff=explode(' ',$diff);
    $diff=array_combine($periods,$diff);
    $diff=array_filter($diff);
    $period=key($diff);
    $value=current($diff);
    if(!$value){
        $period='';
        $tense='';
        $value='Just now';
    }
    else{
        if($period=='day' && $value>=7){
            $period='week';
            $value=floor($value/7);
        }
        if($value>1){
            $period.='s';
           
        }
    }
    echo "$value $period $tense";

}

?>