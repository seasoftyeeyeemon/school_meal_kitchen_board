<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $menu_img_dir = 'menu/';

    protected $fillable=[
        'kinder_id',
        'kinder_user_id',
        'date',
        'timezone',
        'dishnames',
        'category',
        'images',
        'comment',
        'deleted_flag',
        'push_sent',
    ];

    public static function getMenus($ym,$category_id, $timezone_id)
    {   
        $year_month=explode("-",$ym);
        $y = !empty($year_month[0]) ? $year_month[0] : date('Y');
        $m = !empty($year_month[1]) ? ltrim($year_month[1],0) : date('m');
        
        $query= self::whereMonth('date', $m)
            ->whereYear('date', $y)
            ->where('category', $category_id)
            ->where('timezone', $timezone_id)
            ->where('kinder_id', auth()->user()->kinder_id);

        return $query->get();
    }
}
