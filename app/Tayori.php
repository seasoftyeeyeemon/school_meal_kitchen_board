<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kinder;
use App\Kid;
use App\Device;
use App\Buono\Category;
use App\Jobs\KinderPushDelivery;

class Tayori extends Model
{   const DRAFT=0;
    const PUBLISHED=1;
    const CANCELLED=2;
    
    protected $dateFormat = 'U';

    protected $fillable=[
    	'method',
        'title',
        'kinder_id',
        'kinder_user_id',
        'year',
        'month',
        'kbn',
        'header',
        'header_img',
        'body',
        'body_img',
        'footer',
        'footer_img',
        'status',
		'pdf',
		'deleted_flag'
    ];
	
    public function getMealTypeText()
    {
        $meal_types_data = array();
        $meal_types_val = $this->meal_type;
        $meal_types_val = explode(',', $meal_types_val);
        if(isset($meal_types_val) && !empty($meal_types_val))
        {
            foreach($meal_types_val as $meal_type_id)
            {
                $category = Category::find($meal_type_id);
                if(isset($category) && !empty($category))
                {
                    $meal_types_data[] = $category->category_name;
                }
            }
        }
        return implode('、', $meal_types_data);
    }
    
	public function removePDF()
	{
		$kbn = $this->kbn;
		if($kbn == 0)
		{
        	$pdfDir=public_path().'/meal_newsletter/pdf';
		}
		elseif($kbn = 1)
		{
			$pdfDir=public_path().'/school_newsletter/pdf';
		}else{
			$pdfDir=public_path().'/own_newsletter/pdf';
		}
		$month = sprintf('%02d', $this->month);
		if(!empty($this->pdf))
		{		
			$path = $pdfDir.'/'.$this->year.'/'.$month.'/'.$this->pdf;
			if (file_exists($path)) unlink($path);
		}
		
	}
	
	public function removeImages()
	{
		$kbn = $this->kbn;
		if($kbn == 0)
		{
        	$pdfDir=public_path().'/meal_newsletter/pdf';
		}
		elseif($kbn = 1)
		{
			$pdfDir=public_path().'/school_newsletter/pdf';
		}else{
			$pdfDir=public_path().'/own_newsletter/pdf';
		}
		$month = sprintf('%02d', $this->month);
		if(!empty($this->header_img))
		{
			$path = $pdfDir.'/'.$this->year.'/'.$month.'/'.$this->header_img;
			if (file_exists($path)) unlink($path);
		}

		if(!empty($this->body_img))
		{
			$path = $pdfDir.'/'.$this->year.'/'.$month.'/'.$this->body_img;
			if (file_exists($path)) unlink($path);
		}

		if(!empty($this->footer_img))
		{
			$path = $pdfDir.'/'.$this->year.'/'.$month.'/'.$this->footer_img;
			if (file_exists($path)) unlink($path);
		}	
	}

	public function removeImage($image)
	{
		$kbn = $this->kbn;
		if($kbn == 0)
		{
        	$pdfDir=public_path().'/meal_newsletter/pdf';
		}
		elseif($kbn = 1)
		{
			$pdfDir=public_path().'/school_newsletter/pdf';
		}else{
			$pdfDir=public_path().'/own_newsletter/pdf';
		}
		
		$month = sprintf('%02d', $this->month);
		if(!empty($this->$image))
		{

			$path = $pdfDir.'/'.$this->year.'/'.$month.'/'.$this->$image;
			if (file_exists($path)) unlink($path);
		}

	}
	
	public function getPDFLink()
	{
		if(isset($this->pdf) && !empty($this->pdf))
		{
			return \URL::to('/').$this->pdf;
		}
		return "";
	}
	
	public function sendPush()
	{
		//Get kinder
		$kinder = Kinder::findOrFail($this->kinder_id);

		if($this->kbn == 0){
			//SEND PUSH system_publish_meal_newsletter
			if(auth()->user()->kinder_id != 0)
			{
				$type = 'kinder_publish_meal_newsletter';
			}
			else{
				$type = 'system_publish_meal_newsletter';
			}
		
		}
		elseif($this->kbn == 1){
			//SEND PUSH kinder_publish_school_newsletter
			$type = 'kinder_publish_school_newsletter';
		}elseif($this->kbn ==2){
			//SEND PUSH kinder_publish_school_newsletter
			$type = 'kinder_publish_own_school_newsletter';
		}

		

		$custom_data = array(
			'year' => $this->year,
			'month' => $this->month,
			'kinder_id' => $this->kinder_id,
			'meal_type' => $this->meal_type,
		);

		if(auth()->user()->kinder_id != 0)
		{
			$kinder->sendPushMessage($type, $custom_data);
		}
		else{
			$kinder->sendPush($type, $custom_data);
		}

	
	}
	
	
    public static function getListbyKinder($kinder_id,$kbn,$limit,$params=array())
    {
        $kinder=Kinder::findOrFail($kinder_id);
 
        if(!isset($kinder) || empty($kinder))
        {
            abort(404);
        }

		return self::where(function($query)use ($params){
			if(isset($params['kinder_name']) && !empty($params['kinder_name']))
			{
				$kinder_name=strip_tags(trim($params['kinder_name']));
				$kinder=Kinder::where('name','LIKE',"%{$kinder_name}%")->where('deleted_flag',0)->first();
                $kinder_id=-1;
                if(isset($kinder) && !empty($kinder))
                {
                    $kinder_id=$kinder->id;
                } 
                $query->where('kinder_id',$kinder_id);
			}

			if(isset($params['title']) && !empty($params['title']))
			{
				$title=strip_tags(trim($params['title']));
				$query->where('title','LIKE',"%{$title}");
			}

			if(isset($params['status']) && !empty($params['status']))
			{
				$status=strip_tags(trim($params['status']));
				$query->where('status',$status);
			}
			if(isset($params['date']) && !empty($params['date']))
			{
				$date=strip_tags(trim($params['date']));
				$dateArr=explode("/",$date);
		
				$year=isset($dateArr[0]) && !empty($dateArr[0]) ? $dateArr[0] : null ;
				$month=isset($dateArr[1]) && !empty($dateArr[1]) ? $dateArr[1] : null ;
				if(!empty($year) && !empty($month))
				{
					$month=number_format($month,0);
					$query->where('year',$year);
					$query->where('month',$month);
				}
		
			}

			})->where('kbn',$kbn)
			->orderBy('year','desc')
			->orderBy('month','desc')
            ->where('kinder_id',$kinder_id)
            ->where('deleted_flag',0)
            ->paginate($limit);
    }


    public function getKinderName()
    {
        $kinder=Kinder::findOrFail($this->kinder_id);
        
        if(!isset($kinder) || empty($kinder))
        {
            return null;
        }

        if(!isset($kinder->name) || empty($kinder->name))
        {
            return null;
        }
        return $kinder->name;
    } 

    public static function getMenuPdf($year,$month){
        return self::where('year',$year)
        ->where('month',$month)
		->where('kinder_user_id',auth()->user()->id)
		
        ->pluck('pdf')->first();
    }

}
