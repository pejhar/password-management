<?php

namespace App\Http\Controllers\Vault;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vault\PasswordType;
use Illuminate\Support\Facades\Storage;

class PasswordTypeController extends Controller
{


  private $passwordTypeModel;
  
  public function __construct(PasswordType $passwordTypeModel)
  {
    $this->passwordTypeModel = $passwordTypeModel;
  }


  public function list(Request $request)
  {
    $userID = $request->user()->getUserId();
    $userPasswordTypeList = $this->passwordTypeModel->listBy(['user_id' => $userID]);
    if(count($userPasswordTypeList)<=0){
      toastr()->warning('You do not have any password type!');
    }
    return view('layouts.password_type')->with('password_types', $userPasswordTypeList);
  }


  public function create(Request $request)
  {
    $userID = $request->user()->getUserId();
    $passwordType = $this->passwordTypeModel->listBy(['user_id' => $userID, 'title' => $request->title]);
    
    if(count($passwordType)>0){
      toastr()->error('The password type is duplicate!');
    }else{
      $this->passwordTypeModel->create(['user_id' => $userID, 'title' => $request->title]);
    }

    return redirect()->route('list_type_password');
  }


  public function delete($type_id, Request $request)
  {
    $this->passwordTypeModel->delete($type_id);
    return redirect()->route('list_type_password');
  }


}
