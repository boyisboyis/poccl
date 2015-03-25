<?php

class DB{
  
  public $host, $username, $password, $database;
  private $_result = null;
  private static $con;
  public static $result = null;
  private static $_instant = null;
  
  public function __construct($host, $username, $password, $database){
    self::$_instant = $this;
    $this->host = $host;
    $this->username = $username;
    $this->password = $password;
    $this->database = $database;
    
  }
  
  public function connect(){
    self::$con = new mysqli($this->host, $this->username, $this->password, $this->database);
    self::$con->set_charset('utf8');
    //$mysqli->set_charset("utf8")
  }
  
  public static function query($sql){
    self::$result = self::$con->query($sql);
    self::$_instant->fetchArray();
    return self::$_instant;
  }
  
  public static function puts($sql){
    self::$result = self::$con->query($sql);
    return self::$result;
  }
  
  public function fetchArray(){
    $this->_result = array();
    if(self::$result != null){
      while($ar = self::$result->fetch_object()){
        $this->_result[] = $ar;
      }  
    }
    return self::$_instant;
  }
  
  public function get(){
    return $this->_result;
  }
  
  public function getOne(){
    $this->_result = empty($this->_result)?null:array_shift($this->_result[0]);
    return $this;
  }
  
  public function __destruct(){
    self::$con->close();
  }
}

?>