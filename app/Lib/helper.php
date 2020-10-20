<?php
use App\Menu;
use App\Kondate2;
use App\Ryouri2;
use App\Syokuzai;
use App\Kondate1;
use App\Buono\Timezone;
use App\Buono\Category;

function GetNecessary($ym,$day,$id,$query=[])
{
    $year = date('Y', strtotime($ym));    
    $month = date('m', strtotime($ym.$day));
    $current_year_month_day =date('Y-m-d', strtotime($ym.$day));
    $current_year_month_day_with_no_dash =date('Ymd', strtotime($ym.$day));
    $prev_year_month_day =date('Ymd', strtotime('-1 day', strtotime($ym.$day)));
    $prev_day =date('d', strtotime('-1 day', strtotime($ym.$day)));
    $next_year_month_day =date('Ymd', strtotime('+1 day', strtotime($ym.$day)));
    $next_day =date('d', strtotime('+1 day', strtotime($ym.$day)));
    $day_count = date('t', strtotime($ym));
    
    $defaultOpts = array_merge([
        'kondate_id'=>$id,
        'day'=>$day,
        'year_month'=>$ym
        ], $query);

    $timezone =intval($query['timezone']);
    $category=intval($query['category']);
    
    $prev_kondate =Kondate1::getKondate($prev_year_month_day,$timezone,$category);
    $next_kondate =Kondate1::getKondate($next_year_month_day,$timezone,$category);

    $prev_date =date('Y-m-d', strtotime('-1 day', strtotime($ym.$day)));
    $next_date =date('Y-m-d', strtotime('+1 day', strtotime($ym.$day)));
                    
    $status=1;
    $prevdefaultOpts = array_merge([
        'kondate_id'=>!is_null($prev_kondate) ?$prev_kondate->id :  $status=0,
        'day'=>$prev_day,
        'year_month'=>$ym
        ], $query);

    $nextdefaultOpts = array_merge([
        'kondate_id'=>!is_null($next_kondate) ? $next_kondate->id :$status=0,
        'day'=>$next_day,
        'year_month'=>$ym
        ], $query);

    $currentDate = "$year-$month-" . str_pad($day, 2, 0, STR_PAD_LEFT);
    $filterUrl = function($options) use($currentDate, $defaultOpts) {
        $opts = array_merge(['yearMonth' => $currentDate], $options);
        return route('menu.daily_menu', array_merge($defaultOpts, $opts));
    };

    $data = [
        'year' => $year,
        'month' => $month,
        'day' =>$day,
        'day_count' => $day_count,
        'current_year_month_day' => $current_year_month_day,
        'current_year_month_day_with_no_dash' => $current_year_month_day_with_no_dash,
        'prev_year_month_day' => $prev_year_month_day,
        'prev_day' => $prev_day,
        'next_year_month_day' => $next_year_month_day,
        'next_day' =>$next_day,
        'day_count' => $day_count,
        'prevdefaultOpts'=> $prevdefaultOpts,
        'nextdefaultOpts' => $nextdefaultOpts,
        'filterUrl' => $filterUrl

    ];

    return $data;
}


?>