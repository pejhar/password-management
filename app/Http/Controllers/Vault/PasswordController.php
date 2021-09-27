<?php

namespace App\Http\Controllers\Vault;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vault\Password;
use App\Models\Vault\PasswordType;
use Illuminate\Support\Facades\Crypt;

class PasswordController extends Controller
{


    private $passwordModel;
    private $passwordTypeModel;


    public function __construct(Password $passwordModel, PasswordType $passwordTypeModel)
    {
      $this->passwordModel = $passwordModel;
      $this->passwordTypeModel = $passwordTypeModel;
    }
  
  
    public function list(Request $request)
    {
        $userID = $request->user()->getUserId();
        $userPasswordList = $this->passwordModel->listBy(['user_id' => $userID]);
        $userPasswordTypeList = $this->passwordTypeModel->listBy(['user_id' => $userID]);
        if(count($userPasswordTypeList)<=0){
            toastr()->warning('You do not have any password type!');
        }        
        return view('layouts.password')->with('passwords', $userPasswordList)
                                       ->with('password_types', $userPasswordTypeList);
    }


    public function show($password_id, Request $request)
    {
        $encryptedPassword = $this->passwordModel->find($password_id)[0]['password'];
        $decryptedPassword = Crypt::decryptString($encryptedPassword);
        toastr()->info('Your Password is: '.$decryptedPassword);
        return redirect()->route('list_password');
    }


    public function create(Request $request)
    {
        $userID = $request->user()->getUserId();
        $passwordType = $this->passwordTypeModel->find($request->password_type);
        $typeTitle = $passwordType[0]['title'] ?? '';
        $typeID = $passwordType[0]['id'] ?? '';

        $this->passwordModel->create(['user_id' => $userID,
                                        'password_type_id' => $typeID,
                                        'password_type' => $typeTitle,
                                        'title'=> $request->title, 
                                        'password'=> Crypt::encryptString($request->password),
                                    ]);

        return redirect()->route('list_password');
    }


    public function update($password_id)
    {
        
    }
  
  
    public function delete($password_id, Request $request)
    {
      $this->passwordModel->delete($password_id);
      return redirect()->route('list_password');
    }


}
