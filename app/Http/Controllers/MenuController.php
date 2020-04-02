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

class MenuController extends Controller
{
    protected $menu_img_dir;

    protected $kinder;

    protected $no_image= '/img/no_image.png';

    protected $no_menu= '/img/no_menu.png';

    public function calendar_data($kondate_data=[],$ym=null,$service=true,$category_id,$timezone_id)
    {
        if (!isset($ym) || empty($ym)) {
            $ym = date('Y-m');
        } 
        // Check format
        $timestamp = strtotime($ym . '-01');
        if ($timestamp === false) {                                      
            $timestamp = time();
        }
         
        // Today
        $today = date('Y-m-j', time());

        // Number of days in the month
        $day_count = date('t', $timestamp);

        // 0:Sun 1:Mon 2:Tue ...
        
        $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

         
        // Create Calendar!!
        $weeks = array();
        $week = '';
        $temp="";

         
        // Add empty cell
        $week .= str_repeat('<li class="col"></li>', $str);

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

            if($str %7 ==6){
                $week .= '<li class="col free_date">';
            }else{
                $week .= '<li class="col">';
            }
            
            if(isset($kondate_data[$day]) && !empty($kondate_data[$day]))
            {
                // $url=route('menu.daily_menu',$date_param_for_url)."?c=$category_id&t=$timezone_id";

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
                    $url=route('menu.daily_menu',[$id,$category_id,$timezone_id,$day,$ym]);
                    // $temp.='<div class="button_area">';   
                       
                    // $temp.='<span href="#" class="calendar-btn btn-green">献立</span>';
                    
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
                    
                    if(isset($video_url) && !empty($video_url))
                    {
                        $temp.='<a href="#" onclick="event.preventDefault(); openVideo(\''.$video_url.'\')" class="calendar-btn btn-red">ビデオ</a>';
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

                $temp.= '<p>'.$title.'</p>';;
            }
  
           
            $week.='<a href="'.$url.'">';
            $week.='<figure>';
            if($str % 7 == 6){
                $week.='<span>休</span>';
                $week.='<figcaption class="holiday">'.$day.'</figcaption>';
            }else{
                $week.='<img src="'.$thumbnail.'"/>';
                $week.='<figcaption>'.$day.'</figcaption>';
            }
            
            $week.='</figure>';
            $week.=$temp;
            $week.='</a>';
        
            //Empty the temp
            $temp="";
            
        
  
            $week.= '</li>';
            // End of the week OR End of the month
            if ($str % 7 == 6 || $day == $day_count) {
                if($day == $day_count) {
                    // Add empty cell
                    $week .= str_repeat('<li class="col"></li>', 6 - ($str % 7));
                }
                 
                $weeks[] = '<ul class="list-unstyled menu_list row mb-5">'.$week.'</ul>';
                 
                // Prepare for new week
                $week = '';
                 
            }
         
        }
        return $weeks;
    }


    public function monthly_menu($yearMonth, Request $request)
    {
        list($year, $month) = explode('-', $yearMonth);
        $ym=$year.$month;
        $category_id =$request->category;
        $timezone_id=$request->timezone;
        $kondate_data=Kondate1::getKondates($yearMonth,$timezone_id );
        $status=$this->getStatus($kondate_data);
        // $menu_data=Menu::getMenus($yearMonth,$category_id, $timezone_id);
        $kondate_data=$this->sortData($kondate_data);
        // $menu_data=$this->sortData($menu_data);
        $weeks=$this->calendar_data($kondate_data,$yearMonth,true,$category_id,$timezone_id);
        // $kondate_exists= Kondate1::whereMonth('haizen_date', $month)
        //             ->whereYear('haizen_date', $year)
        //             ->where('shisetsu_id', auth()->user()->shisetsu_id)->exists();

        // if($kondate_exists)
        // {
        //     $publishable = true; 
        // }

        $service = true;
        return view('menu_calendar.monthly_menu_6', [
            'year' => (int)$year,
            'month' => (int)$month,
            'weeks' => $weeks
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

    public function daily_menu($id,$category_id,$timezone_id,$day,$ym){
        $kondate_2 =Kondate2::where('kondate_1_id', $id)->where('delete_flg', 0)->orderBy('sort_no', 'asc')->get();
        foreach($kondate_2 as $kondate){
            $ryouri_2 =Ryouri2::getRyouri2($kondate->ryouri_id);
        }
        // $allergie_infos =Syokuzai::getIngredients($ryouri_2);
        $kondate1 =new Kondate1;
        $menu_image =$kondate1->getMenuImage($id);
        $no_image =$this->no_image; 
        return view('menu_calendar.daily_menu',compact('kondate_2','no_image','menu_image','category_id','timezone_id','ym','day'));
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
        return view('menu_calendar.single_menu_item',compact(['instructions','calories','ingredients','ryouri_image','no_image']));
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


    
}
