<?php

namespace App\Database\Vault;

use App\Services\Contracts\NosqlServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PasswordDatabase implements NosqlServiceInterface
{


  private $dbPath;
  private $dbFile;

  public function __construct($dbPath, $dbFile)
  {
    $this->dbPath = $dbPath;
    $this->dbFile = $dbFile;
  }


  public function get(array $conditions)
  {
    $userPasswordList = [];
    $passwordList = $this->readDataBase();

    if ((bool)$passwordList !== false) {
      foreach ($passwordList as $data) {

        $currentMatch = false;
        foreach ($conditions  as $cKey => $cVal) {
          if ($data[$cKey] === $cVal) {
            $currentMatch = true;
          } else {
            $currentMatch = false;
            break;
          }
        }
        if ($currentMatch) {
          $userPasswordList[] = $data;
        }
      }
    }

    return $userPasswordList;
  }


  public function create(array $collection)
  {
    $uniqId = Str::random(9);
    $collection['id'] = $uniqId;

    $passwordList = $this->readDataBase();

    if ((bool)$passwordList !== false) {
      array_push($passwordList, $collection);
    } else {
      $passwordList[] = $collection;
    }

    $this->writeDataBase($passwordList);
    return $uniqId;
  }


  public function update($id, array $collection)
  {
    $updatedPasswordList = [];
    $passwordList = $this->readDataBase();
    foreach ($passwordList as $key => $val) {
      if ($val['id'] === $id) {
        $updatedPasswordList[] = $collection;
      } else {
        $updatedPasswordList[] = $val;
      }
    }

    return $this->writeDataBase($updatedPasswordList);
  }


  public function delete($id)
  {
    $passwordsWithoutDeletedItem = [];
    $passwordList = $this->readDataBase();
    foreach ($passwordList as $key => $val) {
      if ($val['id'] === $id) {
        continue;
      }
      $passwordsWithoutDeletedItem[] = $val;
    }

    return $this->writeDataBase($passwordsWithoutDeletedItem);
  }


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
    return Storage::disk($this->dbPath)->put($this->dbFile, serialize([]));
  }
}
