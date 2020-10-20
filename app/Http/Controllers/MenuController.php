<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kondate1;
use App\Kondate2;
use App\Kondate3;
use App\Cyouri;
use App\Ryouri2;
use App\Syokuzai;
use App\Menu;
use App\Kinder;

class MenuController extends AccessController
{
    protected $menu_img_dir;

    protected $kinder;

    public $cookie_y; 
    public $cookie_m;
    public $cookie_timezone;
    public $cookie_mealtype;

    protected $no_image= '/img/no_image.png';

    protected $no_menu= '/img/no_menu.png';

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
			if(\Auth::check())
	        {
	        	// Only for kinder user
			  	if (!auth()->user()->member(0))
		        {
		            abort(404);
		        }
				
				$kinder = Kinder::find(auth()->user()->kinder_id);
                $this->kinder = $kinder;
                

                $this->cookie_y = 'monthly_menu_'.auth()->user()->id.'_y';
                $this->cookie_m = 'monthly_menu_'.auth()->user()->id.'_m';
                $this->cookie_timezone = 'monthly_menu_'.auth()->user()->id.'_timezone';
                $this->cookie_mealtype = 'monthly_menu_'.auth()->user()->id.'_mealtype';
	        }else{
                return redirect('/');
            }
            return $next($request);
        });
		
		parent::__construct();

        $this->menu_img_dir = 'menu/';

        $this->menu_img_destination='menu/';


    }
    public function calendar_data($kondate_data=[],$menu_data=[],$ym=null,$service=true,$category_id,$timezone_id)
    {
        if (!isset($ym) || empty($ym)) {
            $ym = date('Y-m');
        } 
       
        // Check format
        $timestamp = strtotime($ym . '01');
       
       
        
        if ($timestamp === false) {                                      
            $timestamp = time();
        }
         
        // Today
        $today = date('Y-m-j', time());

      
        $day_count = date('t', $timestamp);

        // 0:Sun 1:Mon 2:Tue ...
        
        $str = date('N', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
       
        // Create Calendar!!
        $weeks = array();
        $week = '';
        $temp="";
        // Add empty cell
        $week .= str_repeat('<li class="col"></li>', $str-1);

        for ($day = 1; $day <= $day_count; $day++, $str++) {

            $date = $ym.'-'.$day;
            $url = "#";
            $no_image=$this->no_image;
            $thumbnail=$this->no_menu;
            $video_url= false;
            $tejyun= false;
            $main_dish = false;
            $title="";

            $ym_no_dash= str_replace("-","", $ym); //Make Year month with no dash
            $day_two_digits= sprintf("%02d", $day); // Make day to two digits
            $date_param_for_url= $ym_no_dash.$day_two_digits; // Param for Route

            if(isset($kondate_data[$day]) && !empty($kondate_data[$day])){
                $week .= '<li class="col">';
               
            }elseif(isset($menu_data[$day]) && !empty($menu_data[$day])){
                $week .= '<li class="col">';
            }else{
                $week .= '<li class="col free_date">';
            }
            
            if(isset($kondate_data[$day]) && !empty($kondate_data[$day]))
            {
                $title = $kondate_data[$day]->comma_dishes_str;
                $thumbnail= $no_image; 
                if(isset($menu_data[$day]->menu_image) && !empty($menu_data[$day]->menu_image))
                {
                    $thumbnail= $menu_data[$day]->menu_image;
                    
                }

                if($service) // If user is service user
                {
                    // $main_dish = $kondate_data[$day]->getMainDishOrStapleMeal();


                    if($main_dish) // If Main Dish or Staple Menu Exist
                    {
                        if(isset($main_dish->img_1) && !empty($main_dish->img_1))
                        {
                            $thumbnail= $main_dish->img_1;
                        }

                        $video_url = isset($main_dish->img_2) && !empty($main_dish->img_2)? $main_dish->img_2 : '';
                        $tejyun = $main_dish->getTejyun();
                   
                    }
                    else{
                        if(isset($menu_data[$day]->menu_image) && !empty($menu_data[$day]->menu_image))
                        {
                            $thumbnail= $menu_data[$day]->menu_image;
                        }
                    
                    }

                 
                
                } // If non service user
                else
                {

                    $thumbnail = $no_image;

                    if(isset($kondate_data[$day]->comma_dishes_str) && !empty($kondate_data[$day]->comma_dishes_str))
                    {
                        $title = $kondate_data[$day]->comma_dishes_str;
                    }

                    if(isset($kondate_data[$day]->menu_image) && !empty($kondate_data[$day]->menu_image))
                    {

                        $thumbnail= $kondate_data[$day]->menu_image;

                    }
 
                }



                $temp.= '<p>'.$title.'</p>';
                //Check if data is instance of Kondate1 
                if($kondate_data[$day] instanceof Kondate1)
                {
                    $id = $kondate_data[$day]->id;
                    $timestamp = strtotime($kondate_data[$day]->haizen_date);
                    $day=date("j", $timestamp);
                    $day_with_zero=date("d", $timestamp);
                    $url=route('menu.daily_menu',[$id,'day'=>$day_with_zero,'yearMonth'=>$ym,'category'=>$category_id,'timezone'=>$timezone_id,'thumbnail'=>$thumbnail]);
                    
                    if(isset($tejyun) && !empty($tejyun))
                    {
                    	$tejyun_data = array();
						foreach($tejyun as $tejyun_step)
						{
							if(isset($tejyun_step) && !empty($tejyun_step))
							{
								$tejyun_data[] = $tejyun_step;
							}
						}
                        $temp.='<a href="#" onclick="event.preventDefault(); openHowToCook(\''.implode('@_@', $tejyun_data).'\')" class="calendar-btn btn-blue">作り方</a>';
                    }
                    


                    // $temp.='</div>'; 
                }
                
             
          
            }

            elseif(isset($menu_data[$day]) && !empty($menu_data[$day]))
            {
                $thumbnail = $no_image;

                $title = $menu_data[$day]->comma_dishes_str;
                
                if(isset($menu_data[$day]->menu_image) && !empty($menu_data[$day]->menu_image))
                {
                    $thumbnail= $menu_data[$day]->menu_image;
                    
                }

                $temp.= '<p>'.$title.'</p>';
            }
           
            $week.='<a href="'.$url.'">';
            $week.='<figure>';
            if(isset($menu_data[$day]) && !empty($menu_data[$day])){
                $week.='<img src="'.$thumbnail.'"/>';
                $week.='<figcaption>'.$day.'</figcaption>';
            }elseif(isset($kondate_data[$day]) && !empty($kondate_data[$day])){
                $week.='<img src="'.$thumbnail.'"/>';
                $week.='<figcaption>'.$day.'</figcaption>';
            }else{
                
                $week.='<span>休</span>';
                $week.='<figcaption class="holiday">'.$day.'</figcaption>';
            }
            
            $week.='</figure>';
            $week.=$temp;
            $week.='</a>';
        
            //Empty the temp
            $temp="";
            
        
  
            $week.= '</li>';
            // End of the week OR End of the month
          
            if ($str % 7 == 0|| $day == $day_count) {
             
                if($day == $day_count) {
               
                    // Add empty cell
                    if($str % 7 == 0){
                     
                    $week .= str_repeat('<li class="col"></li>', 0);
                   }else{
                      
                    $week .= str_repeat('<li class="col"></li>',7- ( $str % 7));
                   }
                }
                 
                $weeks[] = '<ul class="list-unstyled menu_list row mb-5">'.$week.'</ul>';
                 
                // Prepare for new week
                $week = '';
                 
            }
         
        }
        return $weeks;
    }

    public function monthly_menu($yearMonth,\Cache $cache){
         
        if(isset($_GET['y']) && !empty($_GET['y']))
        {
            if($_GET['y'] > 2050 || $_GET['y'] < 2018)
            {
                $_GET['y'] = date('y');
            }
           
        }

        if(isset($_GET['m']) && !empty($_GET['m']))
        {
            if($_GET['m'] > 12 || $_GET['m'] <= 0)
            {
                $_GET['m'] = date('m');
            }
           
        }

        if(isset($_GET['meal_type']) && !empty($_GET['meal_type']))
        {
            $_GET['meal_type'];
            $cache::forever($this->cookie_mealtype,$_GET['meal_type']);  
        }

        if(isset($_GET['timezone']) && !empty($_GET['timezone']))
        {
             $cache::forever($this->cookie_timezone,$_GET['timezone']);
        }   

        list($year, $month) = explode('-', $yearMonth);
        $ym=$year.$month;

        $kondate_data = $menu_data = array();
        $status = null;
        
        $meal_types=Kondate1::getKinderMealTypes();
        $category_id=$cache::get($this->cookie_mealtype)!=null && !empty($cache::get($this->cookie_mealtype)) ? $cache::get($this->cookie_mealtype) : $this->lastest_id($meal_types);
        $cache::forever($this->cookie_mealtype,$category_id);
        $timezones=Kondate1::getKinderTimezones();
        $timezone_id=$cache::get($this->cookie_timezone)!=null && !empty($cache::get($this->cookie_timezone)) ? $cache::get($this->cookie_timezone) : $this->lastest_id($timezones);
        $cache::forever($this->cookie_timezone,$timezone_id);
        $service = false;
        $publishable = false; 
        $this->kinder =Kinder::getKinderByUser(auth()->user()->id);
        $kinder =$this->kinder;
         /** If Non - Service User  **/
        if($this->kinder->isService(Kinder::NON_SERVICE))
        {
            $menus=Menu::getMenus($yearMonth,$category_id, $timezone_id);

            $data=$this->sortDataMenu($menus);

            $weeks=$this->calendar_data($data,[],$ym,false,$category_id,$timezone_id); //It's not service user


 
        }
        /** Else Serivce User**/
        else
        {

            $kondate_data=Kondate1::getKondates($yearMonth,$timezone_id, $category_id);
           
            $status=$this->getStatus($kondate_data);

            $menu_data=Menu::getMenus($yearMonth,$category_id, $timezone_id);
            $kondate_data=$this->sortData($kondate_data);
            
            $menu_data=$this->sortDataMenu($menu_data);
            $weeks=$this->calendar_data($kondate_data,$menu_data,$ym,true,$category_id,$timezone_id);
           

            $kondate_exists= Kondate1::whereMonth('haizen_date', $month)
                    ->whereYear('haizen_date', $year)
                    ->where('shisetsu_id', auth()->user()->shisetsu_id)->exists();

            if($kondate_exists)
            {
                $publishable = true; 
            }

            $service = true;
        }

        return view('menu_calendar.monthly_menu_6', [
            'weeks' => $weeks,
            'timezones' => $timezones,
            'timezone_id' => $timezone_id,
            'meal_types' => $meal_types,
            'category_id' => $category_id,
            'kinder_name'=>$kinder,
            'status' => $status,
            'service' => $service,
            'year' => $year,
            'month' => $month,
            'publishable' => $publishable
        ]);
    }
   

    public function sortData($menus=[])
    {
        $data=array();
        foreach($menus as $menu)
        {
            $timestamp =\strtotime($menu->haizen_date);
            $day =date('j',$timestamp);
            $data[$day]= $menu;
        }   
        
        return $data;
    
    }

    public function sortDataMenu($menus=[])
    {
        $data=array();
        foreach($menus as $menu)
        {
            $timestamp =\strtotime($menu->date);
            $day =date('j',$timestamp);
            $data[$day]= $menu;
        }   
        
        return $data;
    
    }

    public function daily_menu($id,$day,$ym,\Cache $cache){
        $meal_types=Kondate1::getKinderMealTypes();
        $category_id=$cache::get($this->cookie_mealtype)!=null && !empty($cache::get($this->cookie_mealtype)) ? $cache::get($this->cookie_mealtype) : $this->lastest_id($meal_types);
        $cache::forever($this->cookie_mealtype,$category_id);
        $timezones=Kondate1::getKinderTimezones();
        $timezone_id=$cache::get($this->cookie_timezone)!=null && !empty($cache::get($this->cookie_timezone)) ? $cache::get($this->cookie_timezone) : $this->lastest_id($timezones);
        $cache::forever($this->cookie_timezone,$timezone_id);
        
        $kondate_2 =Kondate2::where('kondate_1_id', $id)->where('delete_flg', 0)->orderBy('sort_no', 'asc')->get();
        foreach($kondate_2 as $kondate){
            $ryouri_2 =Ryouri2::getRyouri2($kondate->ryouri_id);
        }
        $no_image =$this->no_image;
        $no_menu =$this->no_menu; 
        return view('menu_calendar.daily_menu',compact('id','no_menu','kondate_2','no_image','menu_image','category_id','timezone_id','ym','day','timezones','meal_types'));
    }

    public function single_item($kondate_2_id){
        $ryouri_image =Kondate2::getRyouriImage($kondate_2_id);
        $ingredients =is_null(Kondate3::getIngredients($kondate_2_id)) ? [] : Kondate3::getIngredients($kondate_2_id);
        $ryouri_id = Kondate2::getRyouri($kondate_2_id);
        $no_image =$this->no_image; 
        $shokuzai_id=Ryouri2::getRyouri2($ryouri_id);
        $syokuzai =new Syokuzai();
        $calories =is_null($syokuzai->getIngredients($shokuzai_id))? [] : $syokuzai->getIngredients($shokuzai_id);
        $instructions =is_null(Cyouri::getCyouri($ryouri_id)) ? [] : Cyouri::getCyouri($ryouri_id);
        return view('menu_calendar.single_menu_item',compact(['instructions','calories','ingredients','ryouri_image','no_image','ryouri_id','kondate_2_id']));
    }

    public function getStatus($kondates=[])
    {
        $status = Kondate1::NOT_PUBLISH_STATUS;
        foreach ($kondates as $kondate) {
            $status = $kondate->published;
            break;
        }

        return $status;
    }

    public function lastest_id($array)
    {

      $keys=array();

      $keys = array_keys($array);

      return end($keys);

    }



    
}
