<?php

namespace App\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class JsonGuard implements Guard
{

  
  protected $request;
  protected $provider;
  protected $user;


  /**
   * Create a new authentication guard.
   *
   * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
   * @param  \Illuminate\Http\Request  $request
   * @return void
   */
  public function __construct(UserProvider $provider, Request $request)
  {
    $this->request = $request;
    $this->provider = $provider;
    $this->user = null;
  }


  /**
   * Determine if the current user is authenticated.
   *
   * @return bool
   */
  public function check()
  {
    return !is_null($this->user());
  }


  /**
   * Determine if the current user is a guest.
   *
   * @return bool
   */
  public function guest()
  {
    return !$this->check();
  }


  /**
   * Get the currently authenticated user.
   *
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   */
  public function user()
  {
    if (!is_null($this->user)) {
      return $this->user;
    }
  }


  /**
   * Get the JSON params from the current request
   *
   * @return string
   */
  public function getJsonParams()
  {
    $jsondata = $this->request->all();
    return (!empty($jsondata) ? $jsondata : null);
  }


  /**
   * Get the ID for the currently authenticated user.
   *
   * @return string|null
  */
  public function id()
  {
    if ($user = $this->user()) {
      return $this->user()->getAuthIdentifier();
    }
  }


  /**
   * Validate a user's credentials.
   *
   * @return bool
   */
  public function validate(array $credentials = [])
  {
    if (empty($credentials['username']) || empty($credentials['password'])) {
      if (!$credentials = $this->getJsonParams()) {
        return false;
      }
      $credentials['password'] = MD5($this->getJsonParams()['password']);
    }

    $user = $this->provider->retrieveByCredentials($credentials);

    if (!is_null($user) && $this->provider->validateCredentials($user, $credentials)) {
      $this->setUser($user);
      return true;
    } else {
      return false;
    }
  }


  /**
   * Set the current user.
   *
   * @param  Array $user User info
   * @return void
   */
  public function setUser(Authenticatable $user)
  {
    $this->user = $user;
    session()->put('user.id', $this->user()->getUserId());
    session()->put('user.username', $this->user()->getAuthIdentifier());
    session()->put('user.password', $this->user()->getAuthPassword());
    return $this;
  }


  /**
   * Logout user
   *
   * @return void
   */
  public function logout()
  {
    session()->forget('user');
    $this->user = null;
    return $this;
  }


}
