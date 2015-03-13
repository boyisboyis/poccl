<?php

class Login {
  
  public function __construct($username, $password) {
    
  }
  
  public function verifyPassword($password, $hash){
    return password_verify($password, $hash);
  }
  
}


?>