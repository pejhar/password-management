<?php

namespace App\Http\Controllers\Vault;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vault\PasswordType;
use App\Models\Vault\Password;

class PasswordTypeController extends Controller
{


  private $passwordTypeModel;
  private $passwordModel;

  
  public function __construct(PasswordType $passwordTypeModel, Password $passwordModel)
  {
    $this->passwordTypeModel = $passwordTypeModel;
    $this->passwordModel = $passwordModel;
  }


  public function list(Request $request)
  {
    $userID = $request->user()->getUserId();

    $userPasswordTypeList = $this->passwordTypeModel->listBy(['user_id' => $userID]);
    if (empty($userPasswordTypeList)) {
      toastr()->warning('You do not have any password type!');
    }

    return view('layouts.password_type')->with('password_types', $userPasswordTypeList);
  }


  public function create(Request $request)
  {
    $userID = $request->user()->getUserId();
    $passwordType = $this->passwordTypeModel->listBy(['user_id' => $userID, 'title' => $request->title]);

    if (count($passwordType) > 0) {
      toastr()->error('The password type is duplicate!');
    }else{
      $this->passwordTypeModel->create(['user_id' => $userID, 'title' => $request->title]);
    }

    return redirect()->route('list_type_password');
  }


  public function delete($type_id)
  {
    $userPasswordList = $this->passwordModel->listBy(['password_type_id' => $type_id]);
    $userPasswordType = $this->passwordTypeModel->find($type_id);
    
    if (count($userPasswordList) > 0) {
      toastr()->error('You cannot delete this type! There are passwords for this type.');
    }else if (empty($userPasswordType)) {
      toastr()->error('Password type does not exist.');
    }else{
      $this->passwordTypeModel->delete($type_id);
    }

    return redirect()->route('list_type_password');
  }


}
