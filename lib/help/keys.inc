<?php

class Keys {
   public static function encryptPassword($pass) {
    if($pass == "") return null; 
    $options = ['cost' => 11, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM) ];
    return password_hash($pass, PASSWORD_BCRYPT, $options);
  }
  
  public static function encryptId($username){
    $objDateTime = new DateTime('NOW');
    return $username."@".$objDateTime->format('Y-m-d/H:i');;
  }
}


?>