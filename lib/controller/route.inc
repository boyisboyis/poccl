<?php

class Route {
  
  private static $_uri = null;
  private static $_path = null;
  private static $_instance = null;
  
  private function __construct() {}
  
  public static function getPath(){
    self::$_path = require __DIR__.'/../../app/paths.php';
    return self::$_path;
  }
  public static function getURI(){
    $r = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    self::$_uri = urldecode($r);
    if(self::$_instance === null) self::$_instance = new self;
    return self::$_instance;
  }
  
  public function conPath(){
    $path = $this->conArray();
    if(count($path) > 0){
      return implode("_", $path);
    }
    return "";
  }
  public function conArray(){
    $uri = explode("/",self::$_uri);
    $path = array();
    foreach($uri as $val){
      if(trim($val) != "") $path[] = $val;
    }
    return $path;
  }
  
  public static function getPage($p){
   $route = Route::getPath();
   if(isset($route[$p])){
     if($route[$p]["type"] == "require"){
       require __DIR__."/../../".$route[$p]["file"];
     }
     else if($route[$p]["type"] == "file_get_contents"){
       echo file_get_contents( __DIR__."/../../".$route[$p]["file"]);
     }
   }
  }
  
}

?>