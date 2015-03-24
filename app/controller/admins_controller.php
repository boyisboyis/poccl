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
            
            $sql_po_asso = 'INSERT INTO `po_asso` (`JID`, `Contractor_Name`, `PO_No`)' .
                          'VALUES (' . self::nullValue($params['job_no']) . ', ' . 
                                        self::nullValue($params['contractor_name']) . ', ' . 
                                        self::nullValue($params['po_no']) . 
                                    ')';
            DB::query($sql_po_asso)->get();
            
            $sql_job = 'INSERT INTO `job` (`JID`, `Project_Name`, `Project_Location`, `Project_Owner`, `Secrecy_Agreement`, `Work_Start_Date`, `Work_Complete_Date`, `PO_Date`, `PO_Type`, `Contract_Value_THB`, `Contract_Value_Other`, `Contract_Value_Type`, `Contract_Value_Rate`, `Goveming_Law`, `Credit_Term` ,`Late_Pay_Finan_Charge`) ' .
                       'VALUES (' . self::nullValue($params['job_no']) . ', ' .
                                    self::nullValue($params['project_name']) . ', ' . 
                                    self::nullValue($params['project_location']) . ', ' .
                                    self::nullValue($params['project_owner_name']) . ', ' .
                                    self::nullValue($params['secrecy_agreement']) . ', ' .
                                    self::nullValue($params['start_date']) . ', ' .
                                    self::nullValue($params['complete_date']) . ', ' .
                                    self::nullValue($params['po_date']) . ', ' .
                                    self::nullValue($params['po_type']) . ', ' .
                                    self::nullValue($params['po_amount']) . ', ' .
                                    self::nullValue($params['foreign_currency_value']) . ', ' .
                                    self::nullValue($params['foreign_currency_type']) . ', ' .
                                    self::nullValue($params['foreign_currency_rate']) . ', ' .
                                    self::nullValue($params['goveming_law']) . ', ' .
                                    self::nullValue($params['credit_term']) . ', ' .
                                    self::nullValue($params['late_payment']) .
                                ')';
             DB::query($sql_job)->get();
            
            echo json_encode($sql_job);
        }
        public static function nullValue($str) {
            if($str == 'none' || $str == '') {
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