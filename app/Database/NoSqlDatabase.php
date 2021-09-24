<?php

namespace App\Database;
 
use App\Services\Contracts\NosqlServiceInterface;
 
class NoSqlDatabase implements NosqlServiceInterface
{
  private $connection;
  private $database;
     
  public function __construct($host, $port, $database)
  {
    // $this->connection
    // $this->database
  }
  
  /**
   * @see \App\Services\Contracts\NosqlServiceInterface::find()
   */
  public function find($file, Array $criteria)
  {
    return ['username'=>'ahmad','password'=>'25d55ad283aa400af464c76d713c07ad'];
  }
 
  public function create($file, Array $document) {}
  public function update($file, $id, Array $document) {}
  public function delete($file, $id) {}
}