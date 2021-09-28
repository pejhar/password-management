<?php

namespace App\Database\Vault;

use App\Services\Contracts\NosqlServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PasswordTypeDatabase implements NosqlServiceInterface
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
    $userPasswordTypeList = [];
    $passwordTypeList = $this->readDataBase();

    if ((bool)$passwordTypeList !== false) {
      foreach ($passwordTypeList as $data) {

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
          $userPasswordTypeList[] = $data;
        }
      }
    }

    return $userPasswordTypeList;
  }


  public function create(array $collection)
  {
    $uniqId = Str::random(9);
    $collection['id'] = $uniqId;
    $passwordTypeList = $this->readDataBase();

    if ((bool)$passwordTypeList !== false) {
      array_push($passwordTypeList, $collection);
    } else {
      $passwordTypeList[] = $collection;
    }

    $this->writeDataBase($passwordTypeList);
    return $uniqId;
  }


  public function update($id, array $collection)
  { }


  public function delete($id)
  {
    $typesWithoutDeletedItem = [];
    $passwordTypeList = $this->readDataBase();

    foreach ($passwordTypeList as $key => $val) {
      if ($val['id'] === $id) {
        continue;
      }
      $typesWithoutDeletedItem[] = $val;
    }

    return $this->writeDataBase($typesWithoutDeletedItem);
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
