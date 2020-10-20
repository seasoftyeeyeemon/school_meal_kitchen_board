<?php

namespace App;
use App\Traits\AWSTrait;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use AWSTrait;
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
        $category_id=intval($category_id);
        $timezone_id=intval($timezone_id);
        $query= self::whereMonth('date', $m)
            ->whereYear('date', $y)
            ->where('category', $category_id)
            ->where('timezone', $timezone_id)
            ->where('kinder_user_id', auth()->user()->id);
        return $query->get();
    }

    public function getMenuImageAttribute()
    {
        $image= null;
    
     
        $imgArr=json_decode($this->images,true);

        if(isset($imgArr) && !empty($imgArr))
        {
            $full_path=$this->menu_img_dir.$this->kinder_id."/".$imgArr['main'];
            $image=$this->getS3path($full_path) ;
        }
           
        return $image;
    }

    public static function getMenu($ym,$timezone_id,$category_id)
    {   
        $query= self::where('date', $ym)
            ->where('category', $category_id)
            ->where('timezone', $timezone_id)
            ->where('kinder_user_id', auth()->user()->id);

        return $query->first();
    }
}
