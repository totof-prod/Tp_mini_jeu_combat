<?php


class Manager

{
  public function dbConnect(){
    $dbConfig =  require_once __DIR__.'../../config/database.php';

      static $db;
      if(is_null($db)){
          $db = new PDO($dbConfig['dsn'].';dbname='.$dbConfig['dbname'].';charset=utf8', $dbConfig['user'], $dbConfig['password']);

      }
      return $db;
    }
}