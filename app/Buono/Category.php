<?php

namespace App\Buono;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
	protected $connection = 'buono_main';
	protected $table = 'm_category';
	
	public static function getCategoryName($id)
	{
		return self::find($id)->category_name;
	}
	
    public static function getCategories($shisetsu_id)
    {
        return self::where('shisetsu_id', $shisetsu_id)->where('delete_flg', 0)->get();
	}
	
	public static function deleteOrNot($id){
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
		
		// $status =self::where('id',$id)->where('delete_flg',1)
		// ->orWhere('enable',0)
		// ->first();
		// if($status==null){
		// 	return false;
		// }else{
		// 	return true;
		// }
	}
	public function mealtypes(){
		return $this->hasMany('App\Service\Mealtype');
	}



}
