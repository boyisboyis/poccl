<?php

class Redirect {
  
  public static function to($to = ""){
    $to = strtolower($to);
    $paths = Route::getPath();
    if($to === "/"){
      self::go("/");
    }
    if(isset($paths[$to])){
      self::go($to);
    }
  }
  
  private function go($url){
   header('Location: ' . $url, true);
   die();
  }
  
}


?>