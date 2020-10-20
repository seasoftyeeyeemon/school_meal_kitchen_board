<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Kinder;
class User extends Authenticatable
{
    protected $connection ="pro";
    protected $table ="users";
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','use_flg'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    const KINDER_USER = 0;
	const EDUCE_USER = 1;
	const SYSTEM_USER = 2;


    public function member($value)
    {
        if ( $this->group == $value )
        {
          return true;
        }
        return false;
    }
    public static function getKinderUsers()
	{
        
        return self::where('group', 0)->where('deleted_flag',0)->get();
    }
    
    public function getShisetsuIdAttribute()
	{
	   $kinder= Kinder::getKinderByUser(auth()->user()->id);
	   
	   if(isset($kinder) && !empty($kinder))
	   {
			return $kinder->shisetsu_id;
	   }
	    return 0;
	}
	
}
