<?php
namespace src\Iterator; 
interface IteratorInterface
{
  /**
   * Seek position 
   */
   public function seek($index); 

 /**
   * Return current composite element entry 
   */
   public function current();
  
 /**
   * go to next composite element
   */
   public function next();
 
}
?>