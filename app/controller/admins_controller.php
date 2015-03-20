<?php
    if(Check::isAjax()){
    	if(isset($_POST["action"]) && !empty($_POST["params"])) {
    		$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    		$params = $_POST['params'];
    		switch($action){
    			case "new" : adminController::create($params);
    			break;
    		}		
    	}
    }
    else{
    	Redirect::to("/");
    	die();
    }
    
    class adminController {
        public static function create($params) {
            echo json_encode(array("status" => "adminController"));
        }
    }
?>