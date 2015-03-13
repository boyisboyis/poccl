<?php

if(Check::isAjax()){
  $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
  if($user["username"] != "" && $user["password"] != ""){
    echo json_encode($user);
  }
  else{
    echo json_encode(array("status" => false, "error" => 0));
  }
  die();
	/*if(isset($_POST["user"]) && !empty($_POST["user"])) {
		$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
		switch($type){
			case "paymentsAlert" : News::paymentsAlert();
			case "guaranteesAlert" : News::guaranteesAlert();
			break;
		}		
	}*/
}
else{
	Redirect::to("/");
	die();
}

?>