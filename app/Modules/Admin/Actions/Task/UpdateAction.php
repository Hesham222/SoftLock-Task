<?php
namespace Admin\Actions\Task;
use App\Http\Traits\FileTrait;
use Admin\Models\{
    Task
};
class UpdateAction
{
    public function execute($record)
    {
        //toogle encryption an decryption sol 1 code
//
//        if ($record->status == 1){
//            $file           = public_path($record->name);
//            $key            = 'elVrE8gs73kjoR1G6yj38Q3iSsZ7lnBDEd0aBU2Al0ii/4dNpGFSxxBO+3T4OT1I';
//            $encrypted_code = file_get_contents($file); //Get the encrypted code.
//            $decrypted_code = FileTrait::my_decrypt($encrypted_code, $key);//Decrypt the encrypted code.
//            file_put_contents($file, $decrypted_code); //Save the decrypted code somewhere.
//            $record->status = 0;
//        }else{
//            $file           = public_path($record->name);
//            $key            = 'elVrE8gs73kjoR1G6yj38Q3iSsZ7lnBDEd0aBU2Al0ii/4dNpGFSxxBO+3T4OT1I';
//            $code           = file_get_contents($file); //Get the code to be encrypted.
//            $encrypted_code = FileTrait::my_encrypt($code, $key); //Encrypt the code.
//            file_put_contents($file, $encrypted_code); //Save the encrypted code somewhere.
//            $record->status = 1;
//        }


        //toogle encryption an decryption sol 2 code

        if ($record->status == 1){
            $file = public_path($record->name);
            //dd($file);
            $key = 'elVrE8gs73kjoR1G6yj38Q3iSsZ7lnBDEd0aBU2Al0ii/4dNpGFSxxBO+3T4OT1I';
            $path_parts = pathinfo($record->name);
            $name = "decrypt".'-'.$path_parts['basename'];
            $decrypted_code = FileTrait::decryptFile($file, $key,$name); //Decrypt the code.
            $record->status = 0;
        }

        $record->save();
    }
}
