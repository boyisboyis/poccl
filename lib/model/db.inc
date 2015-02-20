<?php

class DB{
  
  public $host, $username, $password, $database;
  private $con;
  
  public function __construct($host, $username, $password, $database){
    $this->host = $host;
    $this->username = $username;
    $this->password = $password;
    $this->database = $database;
  }
  
  public function connect(){
    $this->con = new mysqli($this->host, $this->username, $this->password, $this->database);
    if($this->con->connect_errno){
        echo "test";
    }
  }
  
  public function __destruct(){
    $this->con->close();
    echo "close";
  }
  
}

?>