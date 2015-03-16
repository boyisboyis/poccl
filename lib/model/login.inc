<?php

class Login {
  
  private $_username, $_password, $_uid = null;
  
  public function __construct($username, $password) {
      $this->_username = $username;
      $this->_password = $password;
  }
  
  public function checkLogin(){
    $user = DB::query("SELECT UID, Username, Password FROM user WHERE username = '" . $this->_username ."' LIMIT 1")->get();
    if(count($user) <= 0) return false;
    $status = $this->verifyPassword($this->_password, $user[0]->Password);
    if($status){
      $this->_uid = $user[0]->UID;
    }
    return $status;
  }
  
  public function getUID(){
    return $this->_uid;
  }
  
  private function verifyPassword($password, $hash){
    if($password == "" || $hash == "") return false;
    return password_verify($password, $hash);
  }
  
}


?>