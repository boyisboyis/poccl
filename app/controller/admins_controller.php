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
            $sql = 'INSERT INTO `po_asso` (`JID`, `Contractor_Name`, `PO_No`) VALUES (' . self::nullValue($params['job_no']) . ', ' . self::nullValue($params['contractor_name']) . ', ' . self::nullValue($params['po_no']) . ')';
            $result = DB::query($sql)->get();
            // echo json_encode(array("status" => "adminController"));
            echo json_encode($sql);
        }
        public static function nullValue($str) {
            if($str == 'none') {
                return 'null';
            }
            else {
                return '\'' . $str . '\'';
            }
        }
    }
?>