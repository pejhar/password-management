<?php

namespace App\Database\Auth;

use App\Services\Contracts\NosqlServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class UserDatabase implements NosqlServiceInterface
{


  private $dbPath;
  private $dbFile;


  public function __construct($dbPath, $dbFile)
  {
    $this->dbPath = $dbPath;
    $this->dbFile = $dbFile;
  }


  public function get(array $criteria)
  {
    $users = $this->readDataBase();

    foreach ($users as $key => $val) {
      if ($val['username'] === $criteria['username']) {
        return $users[$key];
      }
    }
    return null;
  }


  public function create(array $collection)
  {
    $users = $this->readDataBase();

    $uniqId = Str::random(9);
    $newUser = array(
      "id" => $uniqId,
      "username" => $collection["username"],
      "password" => MD5($collection["password"]),
    );

    array_push($users, $newUser);

    return $this->writeDataBase($users);
  }


  public function update($id, array $collection)
  { }


  public function delete($id)
  { }


  private function readDataBase()
  {
    $exists = Storage::disk($this->dbPath)->has($this->dbFile);
    if (!$exists) {
      $this->initDataBase();
    }
    return unserialize(Storage::disk($this->dbPath)->get($this->dbFile)) ?? [];
  }


  private function writeDataBase($data)
  {
    return Storage::disk($this->dbPath)->put($this->dbFile, serialize($data));
  }


  private function initDataBase()
  {
    return Storage::disk($this->dbPath)->put($this->dbFile, serialize(config('nosql.defaults.default_user')));
  }
}