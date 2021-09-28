<?php

namespace App\Models\Vault;

use App\Services\Contracts\NosqlServiceInterface;

class PasswordType{


    private $conn;
  

    public function __construct(NosqlServiceInterface $conn)
    {
      $this->conn = $conn;
    }


    public function listBy(array $conditions)
    {
        return $this->conn->get($conditions);
    }


    public function find($id)
    {
        return $this->conn->get(['id' => $id]);
    }


    public function create(array $collection)
    {
        return $this->conn->create($collection);
    }


    public function update($id, array $collection)
    { 
        //
    }


    public function delete($id)
    {
        return $this->conn->delete($id);
    }


}