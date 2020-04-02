<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kondate3;
use App\Kondate2;

class Kondate2 extends Model
{
    protected $connection ="buono_main";

    protected $table ="t_kondate_2";

    protected $guarded =[];

    public static function getIngredients($kondate_2_id){
     return Kondate3::where('kondate_2_id',$kondate_2_id)->where('delete_flg', 0)->get();
    }

    public static function getRyouriImage($kondate_2_id){
        return self::where('id',$kondate_2_id)->first('img_1');
    }
    public static function getRyouri($kondate_2_id){
        
        return self::where('id',$kondate_2_id)->where('delete_flg', 0)->pluck('ryouri_id')->toArray();
    }
}
