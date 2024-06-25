<?php
namespace App\Http\Traits;
use App\Models\File;

define('FILE_ENCRYPTION_BLOCKS', 10000);
ini_set('memory_limit', '-1');


trait FileTrait {

    public static function storeMultipleFiles($files, $pathFolder, $modelType, $modelId)
    {
        foreach ($files as $file)
        {
            $originalName = $file->getClientOriginalName();
            $size         = $file->getSize();
            $path         = $file->store($pathFolder, 'public');
            File::create([
                'name'        => $originalName,
                'size'        => $size,
                'path'        => $path,
                'model_type'  => $modelType,
                'model_id'    => $modelId,
            ]);
        }
        return 1;
    }

    public static function RemoveMultiFiles($model_type, $model_id)
    {
        $files  = File::where('model_id', $model_id)->where('model_type', $model_type)->get();
        foreach ($files as $file)
        {
            File::where('id', $file->id)->delete();
            self::RemoveSingleFile($file->path);
        }
    }

    public static function storeFile($file, $pathFolder, $modelType, $modelId)
    {
        $originalName = $file->getClientOriginalName();
        $size         = $file->getSize();
        $path         = $file->store($pathFolder, 'public');
        File::create([
            'name'        => $originalName,
            'size'        => $size,
            'path'        => $path,
            'model_type'  => $modelType,
            'model_id'    => $modelId,
        ]);
        return 1;
    }

    public static function RemoveFile($id)
    {
        $file  = File::find($id);
        self::RemoveSingleFile($file->path);
        $file->delete();
    }

    public static function storeSingleFile($file, $pathFolder)
    {
        if(!$file)
            return null;
        $path   = $file->store($pathFolder, 'public');
        return $path;
    }

    public static function RemoveSingleFile($file = null)
    {
        if(file_exists(public_path().DS().'storage'.DS().$file))
            unlink(public_path().DS().'storage'.DS().$file);
        else
            return 0;
    }


    public static function my_encrypt($data, $key) {
        $encryption_key = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    public static function my_decrypt($data, $key) {
        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }

    public static function encryptFile($source, $key, $dest)
    {
        $key = substr(sha1($key, true), 0, 16);
        $iv = openssl_random_pseudo_bytes(16);

//        $searchfor = 1;
//        $fh = fopen($source, 'r');
//        $olddata = fread($fh, filesize($source));
//        if(strpos($olddata, $searchfor)) {
//            //fount it
//        }
//        else {
//            //can't find it
//        }
        $error = false;
        if ($fpOut = fopen($dest, 'w')) {
            // Put the initialzation vector to the beginning of the file
            fwrite($fpOut, $iv);
            if ($fpIn = fopen($source, 'rb')) {
                while (!feof($fpIn)) {
                    $plaintext = fread($fpIn, 16 * FILE_ENCRYPTION_BLOCKS);
                    $ciphertext = openssl_encrypt($plaintext, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
                    // Use the first 16 bytes of the ciphertext as the next initialization vector
                    $iv = substr($ciphertext, 0, 16);
                    fwrite($fpOut, $ciphertext);
//                    fwrite($fpOut, $searchfor);
                }
                fclose($fpIn);
            } else {
                $error = true;
            }
            fclose($fpOut);
        } else {
            $error = true;
        }

        return $error ? false : true;
    }

    public static function decryptFile($source, $key, $dest)
    {
        $key = substr(sha1($key, true), 0, 16);

        $error = false;
        if ($fpOut = fopen($dest, 'w')) {
            if ($fpIn = fopen($source, 'rb')) {
                // Get the initialzation vector from the beginning of the file
                $iv = fread($fpIn, 16);
                while (!feof($fpIn)) {
                    // we have to read one block more for decrypting than for encrypting
                    $ciphertext = fread($fpIn, 16 * (FILE_ENCRYPTION_BLOCKS + 1));
                    $plaintext = openssl_decrypt($ciphertext, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
                    // Use the first 16 bytes of the ciphertext as the next initialization vector
                    $iv = substr($ciphertext, 0, 16);
                    //dd($iv);

                    fwrite($fpOut, $plaintext);
                }
                fclose($fpIn);
            } else {
                $error = true;
            }
            fclose($fpOut);
        } else {
            $error = true;
        }

        return $error ? false : true;
    }
}
