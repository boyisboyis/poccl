<?php

class Route {
  
  private static $_uri = null;
  private static $_path = null;
  
  private function __construct() {}
  
  public static function getPath(){
    self::$_path = require __DIR__.'/../../app/paths.php';
    return self::$_path;
  }
  public static function getURI(){
    $r = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    self::$_uri = urldecode($r);
    return self::$_uri;
  }
  
}

?>