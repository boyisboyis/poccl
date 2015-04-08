<?php

if(Check::isAjax()){
  $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
  if($user["username"] != "" && $user["password"] != ""){
  	$login = new Login($user["username"], $user["password"]);
  	$status = $login->checkLogin();
  	if($status != false){
  		Session::setSessionUID($login->getUID());
  		Session::setSessionAuth($login->getAuth());
  		echo json_encode(array("status" => true));
  	}
  	else{
  		echo json_encode(array("status" => false, "error" => 1));
  	}
  }
  else{
    echo json_encode(array("status" => false, "error" => 0));
  }
  die();
}
else{
	Redirect::to("/");
	die();
}

?>