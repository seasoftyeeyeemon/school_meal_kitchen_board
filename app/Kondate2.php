<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kondate3;
use App\Kondate2;

class Kondate2 extends Model
{
    protected $connection ="buono_main";

    protected $table ="t_kondate_2";
	protected $guarded =[];
	 public $allergy_names = [
        1 => "えびShrimp",
        2 =>  "かにCrab",
        3 =>  "小麦Wheat",
        4 =>  "そばSoba",
        5 =>  "卵Egg",	
        6 =>  "乳Milk",	
        7 =>  "落花生Peanuts",
        8 => "あわびAbalone",
        9 =>  "いかSquid",
        10 =>  "いくらSalmon Roe",
        11 => "オレンジOrange",
        12 =>  "カシューナッツCashewnut",
        13 =>  "キウイフルーツKiwi ",
        14 => "牛肉Beef",
        15 => "くるみWalnut",
        16 =>  "ごまSesame",
        17 =>  "さけSalmon",
        18 =>  "さばMackerel",
        19 =>  "大豆Soy Bean",
        20 => "鶏肉Chicken Meat",
        21 =>  "バナナBanana",
        22 => "豚肉Pork",
        23 => "まつたけMatsutake Mushroom",
        24 =>  "ももPeach",
        25 =>  "やまいもYam",
        26 => "りんごApple",
        27 => "ゼラチンGelatine",
];

    public static function getIngredients($kondate_2_id){
     return Kondate3::where('kondate_2_id',$kondate_2_id)->where('delete_flg', 0)->get();
    }

    public static function getRyouriImage($kondate_2_id){
        return self::where('id',$kondate_2_id)->first('img_1');
    }
    public static function getRyouri($kondate_2_id){
        
        return self::where('id',$kondate_2_id)->where('delete_flg', 0)->pluck('ryouri_id')->toArray();
    }

    public function getAllergies()
	{
		$allergies_data = array();
		for($i = 1; $i <= 27; $i++)
		{
			$allergies_data['allergie_'.$i]['status'] = 0;
			$allergies_data['allergie_'.$i]['title'] = $this->allergy_names[$i] .' ' . $this->allergy_statuses[0];
		}
		$kondate_3_records = Kondate3::where('kondate_2_id', $this->id)->where('delete_flg', 0)->get();
		foreach($kondate_3_records as $kondate_3_record)
		{

			for($i = 1; $i <= 27; $i++)
			{
				$allergie_field = 'allergie_'.$i;
				if($kondate_3_record->$allergie_field == 1)
				{
					$allergies_data[$allergie_field]['status'] = 1;
					$allergies_data[$allergie_field]['title'] = $this->allergy_names[$i]; 
					
				}
			}
		}
		
		return $allergies_data;
	}
}
