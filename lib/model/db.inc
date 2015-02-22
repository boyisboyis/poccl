<?php

class DB{
  
  public $host, $username, $password, $database;
  private static $con;
  
  public function __construct($host, $username, $password, $database){
    $this->host = $host;
    $this->username = $username;
    $this->password = $password;
    $this->database = $database;
  }
  
  public function connect(){
    self::$con = new mysqli($this->host, $this->username, $this->password, $this->database);
   // print_r($this->con->connect_errno);
    if(self::$con->connect_errno){
       echo "test db";
    }
  }
  
  public static function q($sql){
   $q = self::$con->query($sql);
   print_r($q);
  }
  
  public function __destruct(){
    self::$con->close();
    echo "close";
  }
  
}

?>