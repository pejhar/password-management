<?php

namespace App\Services\Contracts;
 
Interface NosqlServiceInterface
{
  /**
   * Create a Collection
   *
   * @param array  $collection   Collection
   * @return boolean
   */
  public function create(Array $collection);
  
  /**
   * Update a Collection
   *
   * @param string    $id         Primary Id
   * @param array  $collection   Collection
   * @return boolean
   */
  public function update($id, Array $collection);
 
  /**
   * Delete a Collection
   *
   * @param string    $id         Primary Id
   * @return boolean
   */
  public function delete($id);
  
  /**
   * Search Collection(s)
   *
   * @param array  $criteria   Key-value criteria
   * @return array
   */
  public function get(Array $criteria);
  
}