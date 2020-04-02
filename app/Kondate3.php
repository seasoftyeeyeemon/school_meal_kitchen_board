<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kondate3 extends Model
{
    protected $connection ="buono_main";

    protected $table ="t_kondate_3";

    public static function getShokuzai(){

    }
    public static function getIngredients($kondate_2_id)
    {
        return self::where('kondate_2_id',$kondate_2_id)->where('delete_flg',0)->first();
    }
}
