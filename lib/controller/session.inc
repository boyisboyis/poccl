<?php

class Session {
  
  
  public static function setSessionUID($uid){
    $_SESSION['sessionUID'] = $uid;
  }
  
  public static function setSessionAuth($auth){
    $_SESSION['sessionAuth'] = $auth;
  }
  
  public static function getSessionAuth(){
    return isset($_SESSION['sessionAuth'])?$_SESSION['sessionAuth']:null;
  }
  
  public static function getSessionUID(){
    return isset($_SESSION['sessionUID'])?$_SESSION['sessionUID']:null;
  }
  
  public static function logOut(){
    unset($_SESSION["sessionUID"], $_SESSION['sessionAuth']);
  }
  
}

?>