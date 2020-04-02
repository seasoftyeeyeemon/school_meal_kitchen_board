<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cyouri extends Model
{
    protected $connection ="buono_main";

    protected $table ="t_cyouri";

    protected $guarded =[];
    public static function getCyouri($cryouri_id)
	{
		return self::where('ryouri_id',$cryouri_id)->where('delete_flg', 0)->first();
	}
}
