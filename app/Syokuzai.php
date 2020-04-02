<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Syokuzai extends Model
{
    public $timestamps = false;
	protected $connection = 'buono_main';
    protected $table = 'm_syokuzai';
    public $data=[];
    public $all=[];
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

    public function getIngredients($shokuzai_id){
        foreach($shokuzai_id as $one){
            $data[]= self::where('id',$one)->where('delete_flg',0)->get()->toArray();
           

        }
        return $data;
        
    }

    // public static function getAllergieInfo($one_shokuzai_id){
    //     return self::where('id',$one_shokuzai_id)->where('delete_flg',0)->get();
    // }

    public function getAllergies($one_shokuzai_id)
	{
		$allergies_data = array();
		for($i = 1; $i <= 27; $i++)
		{
			$allergies_data['allergie_'.$i]['status'] = 0;
			$allergies_data['allergie_'.$i]['title'] = $this->allergy_names[$i] .' ' . $this->allergy_statuses[0];
		}
		$allergie_records = self::where('id', $one_shokuzai_id)->where('delete_flg', 0)->get();
		foreach($allergie_records as $allergie_record)
		{

			for($i = 1; $i <= 27; $i++)
			{
				$allergie_field = 'allergie_'.$i;
				if($allergie_record->$allergie_field == 1)
				{
					$allergies_data[$allergie_field]['status'] = 1;
					$allergies_data[$allergie_field]['title'] = $this->allergy_names[$i]; 
					
				}
			}
		}
		return $allergies_data;
	}
}
