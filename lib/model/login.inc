<?php

class Login {
  
  private $_username, $_password, $_uid = null, $_auth;
  
  public function __construct($username, $password) {
      $this->_username = $username;
      $this->_password = $password;
  }
  
  public function checkLogin(){
    $user = DB::query("SELECT UID, Username, Password, Authen FROM user WHERE username = '" . $this->_username ."' LIMIT 1")->get();
    if(count($user) <= 0) return false;
    $status = $this->verifyPassword($this->_password, $user[0]->Password);
    if($status){
      $this->_uid = $user[0]->UID;
      $this->_auth = $user[0]->Authen;
    }
    return $status;
  }
  
  public function getUID(){
    return $this->_uid;
  }
  
  public function getAuth () {
    return $this->_auth;
  }
  
  private function verifyPassword($password, $hash){
    if($password == "" || $hash == "") return false;
    return password_verify($password, $hash);
  }
  
}


?>