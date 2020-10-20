<?php

namespace App\Buono;

use Illuminate\Database\Eloquent\Model;
use Storage;
class MenuPDF extends Model
{
    protected $connection ='buono_main';

    protected $table ='menu_pdf';

    protected $guarded =[];

    public static function getPdf($date){
        $filename= self::where('facility_id',auth()->user()->id)
                    ->where('date',$date)
                    ->pluck('file_name')
                    ->first();
        return Storage::disk('s3')->response($filename);
    }

}
