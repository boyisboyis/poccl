<?php
    if(Check::isAjax()){
    	if(isset($_POST["action"]) && !empty($_POST["params"])) {
    		$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    		$params = $_POST['params'];
    		switch($action){
    			case "new" : adminController::create($params);break;
    			case "search" : adminController::search($params);break;
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
        
        public static function search($params) {
            $type = $params['type'];
            $search = $params['search'];
            $where = array("job" => "JID", "contract" => "Contractor_Name", "poid" => "PO_No");
    		if($search != ""){
    			$result = DB::query("SELECT * FROM po_asso WHERE po_asso.".$where[$type]." LIKE '%".$search."%' AND po_asso.".$where[$type]." IS NOT null ORDER BY po_asso.".$where[$type])->get();
    		}
    		else{
    			$result = DB::query("SELECT * FROM po_asso WHERE po_asso.".$where[$type]." IS NOT null ORDER BY po_asso.".$where[$type])->get();
    		}
            echo json_encode(array("status" => true, "obj" => $result));
        }
    }
?>