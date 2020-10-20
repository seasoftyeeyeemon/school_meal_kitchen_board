<?php
namespace App\Traits;

use Aws\S3\S3Client;
use Storage;

trait AWSTrait{

    public function saveFiletoS3($keyname,$sourcefile)
    {
            $s3 = new S3Client([
            'version' => 'latest',
            'region'  => config('custom.s3.region'),
            'credentials' => array(
                'key' => config('custom.s3.key'),
                'secret'  => config('custom.s3.secret')
                )
            ]);

            try {
                // Upload data.
                $result = $s3->putObject([
                    'Bucket' =>config('custom.s3.bucket'),
                    'Key'    => $keyname,
                    'SourceFile' => $sourcefile,
                    'ACL'    => 'public-read'
                ]);

                // Print the URL to the object.
                return $result['ObjectURL'];
            } catch (S3Exception $e) {
                echo $e->getMessage() . PHP_EOL;
        }
    }

    public function getS3path($path)
    {
        $url = null;

        $url = Storage::disk('s3')->url($path);

        return $url;
    }
    
    public function saveFiletoS3Flysystem($path,$sourcefile)
    {
          $s3 = Storage::disk('s3');

          return $s3->put($path,$sourcefile,'public');
     
    }

    public function deleteFiletoS3Flysystem($path)
    {
         //Waiting
        $s3 = Storage::disk('s3');
        if($s3->delete($path))
        {
            return true;
        }
        return false;
    }

}




