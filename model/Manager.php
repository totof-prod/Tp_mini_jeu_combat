<?php


class Manager
{
  public function dbConnect(){

        return new PDO('mysql:host=localhost:8889;dbname=TP_fight;charset=utf8', 'root', 'root');

    }
}