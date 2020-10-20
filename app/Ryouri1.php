<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ryouri1 extends Model
{
    protected $connection = 'buono_main';
    protected $table = 'm_ryouri_1';
    
    public static function getDishImage($id){
        return self::where('id',$id)->first('img_1');

    }
}
