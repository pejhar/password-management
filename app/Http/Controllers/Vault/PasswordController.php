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
        if (empty($userPasswordTypeList)) {
            toastr()->warning('You do not have any password type!');
        }
        return view('layouts.password')->with('passwords', $userPasswordList)
            ->with('password_types', $userPasswordTypeList);
    }


    public function showPassword($password_id)
    {
        $encryptedPassword = $this->passwordModel->find($password_id);
        if (empty($encryptedPassword)) {
            toastr()->error('Password does not exist.');
        } else {
            $decryptedPassword = Crypt::decryptString($encryptedPassword[0]['password']);
            toastr()->info('Your Password is: ' . $decryptedPassword);
        }
        return redirect()->route('list_password');
    }


    public function create(Request $request)
    {
        $userID = $request->user()->getUserId();
        $passwordType = $this->passwordTypeModel->find($request->password_type);
        if (empty($passwordType)) {
            toastr()->error('There is no password type!');
            return redirect()->route('list_password');
        }

        $this->passwordModel->create([
            'user_id'          => $userID,
            'password_type_id' => $passwordType[0]['id'],
            'password_type'    => $passwordType[0]['title'],
            'title'            => $request->title,
            'password'         => Crypt::encryptString($request->password),
        ]);

        return redirect()->route('list_password');
    }


    public function update($password_id, Request $request)
    {
        
        $userPasswordList = $this->passwordModel->find($password_id);
        if (empty($userPasswordList)) {
            toastr()->error('Password does not exist.');
            return redirect()->route('list_password');
        };

        $passwordType = $this->passwordTypeModel->find($request->password_type);
        if (empty($passwordType)) {
            toastr()->error('There is no password type!');
            return redirect()->route('list_password');
        }

        if($request->password !== null){
            $encryptPassword = Crypt::encryptString($request->password);
        }else{
            $encryptPassword = $userPasswordList[0]['password'];
        }

        $this->passwordModel->update($password_id, [
            'id'               => $userPasswordList[0]['id'],
            'user_id'          => $request->user()->getUserId(),
            'password_type_id' => $passwordType[0]['id'],
            'password_type'    => $passwordType[0]['title'],
            'title'            => $request->title,
            'password'         => $encryptPassword,
        ]);

        return redirect()->route('list_password');
    }


    public function delete($password_id)
    {
        $userPasswordList = $this->passwordModel->find($password_id);

        if (empty($userPasswordList)) {
            toastr()->error('Password does not exist.');
        } else {
            $this->passwordModel->delete($password_id);
        }

        return redirect()->route('list_password');
    }
}
