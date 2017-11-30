<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 9/2/17
 * Time: 6:09 PM
 */

namespace App\Traits;

trait FileTrait
{
    public function createFile($base64, $name, $extension)
    {
        $fileName = md5(time() . $name);
        $ifp = fopen( storage_path() . '/files/' . $fileName . '.' . $extension, "wb" );
        fwrite( $ifp, base64_decode( $base64 ) );
        fclose( $ifp );
        return $fileName . '.' . $extension;
    }
}