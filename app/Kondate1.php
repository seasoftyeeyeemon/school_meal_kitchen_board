<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kondate2;
use App\Buono\Category;
use App\Buono\Timezone;
class Kondate1 extends Model
{
    protected $connection = "buono_main";
    protected $guarded=[];
    
    const NOT_PUBLISH_STATUS=0;
    const PUBLISH_STATUS=1;
    
    protected $table ="t_kondate_1";
    public static function getKondates($ym=null, $timezone_id,$category_id)
    {
    	$kondates=array();
        $year_month=explode("-",$ym);
        $y = !empty($year_month[0]) ? $year_month[0] : date('Y');
        $m = !empty($year_month[1]) ? ltrim($year_month[1],0) : date('m');
        $m=$year_month[1];
        $category_id=intval($category_id);
        $timezone_id=intval($timezone_id);
       
        $query= self::whereMonth('haizen_date', $m)
            ->whereYear('haizen_date', $y)
            ->where('category_id', $category_id)
            ->where('timezone_id', $timezone_id);
        return $query->get();
    }

    public static function getKondate($ym=null, $timezone_id,$category_id)
    {
        $category_id=intval($category_id);
        $timezone_id=intval($timezone_id);
        $query= self::where('haizen_date', $ym)
            ->where('category_id', $category_id)
            ->where('timezone_id', $timezone_id);
       
        return $query->first();
    }

    public function getCommaDishesStrAttribute()
    {
        $str=null;
        
        $dishes=array();


        if(!empty($this->getDishes()))
        {
            foreach ($this->getDishes() as $dish) {
                $dishes[] = $dish->name_1;
            }

            if(!empty($dishes))
            {
                $str=implode("、", $dishes);
            }

        }
        
        return $str;
    }

    public function getDishes()
	{
		return Kondate2::where('kondate_1_id', $this->id)->where('delete_flg', 0)->orderBy('sort_no', 'asc')->get();
    }
    
    public function getMenuImage($id){
        return self::where('id',$id)->first('img_1');

    }

    public static function getKinderTimezones()
    
    {
        return Timezone::where(['delete_flg'=>0,'shisetsu_id'=> auth()->user()->shisetsu_id])->pluck('timezone_name','id')->toArray();
    }

    public static function getKinderMealTypes()
    {   
        return Category::where(['delete_flg'=>0,'shisetsu_id'=> auth()->user()->shisetsu_id])->pluck('category_name','id')->toArray() ;
    }

    public static function getTimezones()
    {
    	return Timezone::where(['delete_flg'=>0,'shisetsu_id'=>0])->pluck('timezone_name','id')->toArray();
    }

    public static function getMealTypes()
    {
    	return Category::where(['delete_flg'=>0,'shisetsu_id'=>0])->pluck('category_name','id')->toArray();
    }

}
