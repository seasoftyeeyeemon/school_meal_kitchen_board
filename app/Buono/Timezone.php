<?php

namespace App\Buono;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    public $timestamps = false;
	protected $connection = 'buono_main';
	protected $table = 'm_timezone';


	public function timezone(){
		return $this->hasMany('App\Service\Timezone');
	}

	public static function getTimeZoneName($id)
	{
		return self::find($id)->timezone_name;
	}

	public static function deleteOrNot($id)
	{

		$status =self::where('id',$id)
				->where(function ($query) {
				$query->where('delete_flg',1);
				$query->orWhere('enable',0);
				})->first();
		
		if($status){
			return false;
		}else{
			return true;
		}
		
		
	}
 
}
