<?php
namespace Admin\Actions\Task;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Admin\Models\{
    Task
};
class StoreAction
{
    public function execute(Request $request)
    {

        $file_save = FileTrait::storeSingleFile($request->file('file'),'task');
//         encryption code sol 1
//        $path_parts     = pathinfo($request->file->getClientOriginalName());
//        $name           = $path_parts['basename'];
//        $file           = public_path('storage/'.$file_save);
//        $key            = 'elVrE8gs73kjoR1G6yj38Q3iSsZ7lnBDEd0aBU2Al0ii/4dNpGFSxxBO+3T4OT1I';
//        $code           = file_get_contents($file); //Get the code to be encrypted.
//        $encrypted_code = FileTrait::my_encrypt($code, $key); //Encrypt the code.
//        file_put_contents($file, $encrypted_code); //Save the encrypted code somewhere.
//
//        $record =  Task::create([
//            'name'       => $name,
//            'file'       => $file_save,
//        ]);



        //encryption code sol 2
        $file             = public_path('storage/'.$file_save);
        $path_parts       = pathinfo($request->file->getClientOriginalName());
        $name             = "encrypt".'-'.$path_parts['basename'];
        $key              = 'elVrE8gs73kjoR1G6yj38Q3iSsZ7lnBDEd0aBU2Al0ii/4dNpGFSxxBO+3T4OT1I';
        $encrypted_code   = FileTrait::encryptFile($file, $key,$name); //Encrypt the code.
        $record =  Task::create([
            'name'       => $name,
            'file'       => $file_save,
        ]);

        return $record;
    }

}
