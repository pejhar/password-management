<?php

namespace App\Extensions;

use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class NoSqlUserProvider implements UserProvider
{
  /**
   * The NoSql User Model
   */
  private $model;

  /**
   * Create a new NoSql user provider.
   *
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   * @return void
   */
  public function __construct(\App\Models\Auth\User $userModel)
  {
    $this->model = $userModel;
  }

  /**
   * Retrieve a user by the given credentials.
   *
   * @param  array  $credentials
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   */
  public function retrieveByCredentials(array $credentials)
  {
    if (empty($credentials)) {
      return;
    }

    $user = $this->model->fetchUserByCredentials(['username' => $credentials['username']]);

    return $user;
  }

  /**
   * Validate a user against the given credentials.
   *
   * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
   * @param  array  $credentials  Request credentials
   * @return bool
   */
  public function validateCredentials(Authenticatable $user, array $credentials)
  {
    return ($credentials['username'] == $user->getAuthIdentifier() &&
      md5($credentials['password']) == $user->getAuthPassword());
  }

  public function retrieveById($identifier)
  { }

  public function retrieveByToken($identifier, $token)
  { }

  public function updateRememberToken(Authenticatable $user, $token)
  { }
}

