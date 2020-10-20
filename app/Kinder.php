<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kinder extends Model
{
    const NON_SERVICE = 0;
	const BUONO_SERVICE = 1;
    const EIBUN_SERVICE = 2;
    
    protected $connection ="pro";
    protected $guarded=['id'];

    public static function getKinderByUser($user_id)
	{
		return Kinder::where('kinder_user_id', $user_id)->where('deleted_flag', 0)->first();
    }

    public static function getKinderData()
	{
		$kinders = self::where('deleted_flag', 0)->get();
		$data = array();
		foreach($kinders as $kinder)
		{
			$data[$kinder->id] = $kinder->name;
		}
		return $data;
    }
    
    public function getUser()
	{
		return User::find($this->kinder_user_id);
	}
    
    public function isService($service)
	{
		return ($this->service == $service)? true : false;
	}
}
