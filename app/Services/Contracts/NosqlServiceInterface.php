<?php

namespace App\Services\Contracts;
 
Interface NosqlServiceInterface
{
  /**
   * Create a Document
   *
   * @param string $file File Name
   * @param array  $document   Document
   * @return boolean
   */
  public function create($file, Array $document);
  
  /**
   * Update a Document
   *
   * @param string $file File Name
   * @param mix    $id         Primary Id
   * @param array  $document   Document
   * @return boolean
   */
  public function update($file, $id, Array $document);
 
  /**
   * Delete a Document
   *
   * @param string $file File Name
   * @param mix    $id         Primary Id
   * @return boolean
   */
  public function delete($file, $id);
  
  /**
   * Search Document(s)
   *
   * @param string $file File Name
   * @param array  $criteria   Key-value criteria
   * @return array
   */
  public function find($file, Array $criteria);
}