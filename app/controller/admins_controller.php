<?php
    if(Check::isAjax()){
    	if(isset($_POST["action"]) && !empty($_POST["params"])) {
    		$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    		$params = $_POST['params'];
    		switch($action){
    			case "new" : adminController::create($params);break;
    			case "search" : adminController::search($params);break;
				case "delete" : adminController::delete($params);break;
				case "update" : adminController::update($params);break;
				case "add_user" : adminController::addUser($params);break;
				case "update_payment" : adminController::updatePayment($params);break;
				case "update_guarantee" : adminController::updateGuarantee($params);break;
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
            DB::puts($sql_po_asso);
            
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
            DB::puts($sql_job);
            
            if($params['payment_terms'] != '') {
                foreach($params['payment_terms'] as &$payment) {
                    $sql_payment = 'INSERT INTO `payment` (`JID`, `Terms`, `Payment_Type`, `Amount_Actual_Price`, `Amount_Actual_Percentage`, `Invoice_Date`) ' .
                                   'VALUES (' . self::nullValue($params['job_no']) . ', ' .
                                                self::nullValue($payment['payment_term']) . ', ' .
                                                self::nullValue($payment['payment_terms_select']) . ', ' .
                                                self::amountValue($payment['payment_terms_amount_thb'], $payment['payment_terms_amount_percentage'], $params['po_amount']) . ', ' .
                                                self::nullValue($payment['payment_terms_date_plan']) .
                                            ')';
                    DB::puts($sql_payment);
                }
            }
            
            if($params['bank_guarantee'] != '') {
                foreach($params['bank_guarantee'] as &$guarantee) {
                    $sql_guarantee = 'INSERT INTO `guarantee` (`JID`, `Terms`, `Guarantee_Type`, `Amount_Actual_Price`, `Amount_Actual_Percentage`, `Start_Plan`, `Until_Plan`) ' .
                                   'VALUES (' . self::nullValue($params['job_no']) . ', ' .
                                                self::nullValue($guarantee['bank_guarantee_term']) . ', ' .
                                                self::nullValue($guarantee['bank_guarantee_select']) . ', ' .
                                                self::amountValue($guarantee['bank_guarantee_amount_thb'], $guarantee['bank_guarantee_amount_percentage'], $params['po_amount']) . ', ' .
                                                self::nullValue($guarantee['bank_guarantee_start_date']) . ', ' .
                                                self::nullValue($guarantee['bank_guarantee_until_date']) .
                                            ')';
                    DB::puts($sql_guarantee);
                }
            }
           
            echo json_encode(array("status" => true));
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
			
		public static function delete($params) {
			$sql_po_asso = "DELETE FROM po_asso WHERE po_asso.JID = '$params'";
			DB::puts($sql_po_asso);
			
			$sql_job = "DELETE FROM job WHERE job.JID = '$params'";
			DB::puts($sql_job);
			
			$sql_payment = "DELETE FROM payment WHERE payment.JID = '$params'";
			DB::puts($sql_payment);
			
			$sql_guarantee = "DELETE FROM guarantee WHERE guarantee.JID = '$params'";
			DB::puts($sql_guarantee);
			
			echo json_encode(array("status" => true));
		}
		
		public static function update($params) {
		    $sql_update = "UPDATE " . $params['table'] . " SET " . $params['table'] . "." . $params['type'] . " = '" . $params['value'] . "' WHERE " . $params['table'] . ".jid" . " = '" . $params['jid'] . "'";
		    DB::puts($sql_update);
		    
		    $sql_select_check = "SELECT " .  $params['table'] . "." . $params['type'] . " FROM " . $params['table'] .  " WHERE " . $params['table'] . ".jid" . " = '" . $params['jid'] . "'";
		    $result = DB::query($sql_select_check)->get();
		    
		    if($result[0]->$params['type'] == $params['value']) {
		        echo json_encode(array("status" => true));
		    }
		    else {
		        echo json_encode(array("status" => false));
		    }
		}
		
		public static function addUser($params) {
		    $not_same_user = true;
		    $sql_username = "SELECT user.Username FROM user";
		    $result = DB::query($sql_username)->get();
		    for($i = 0; $i < count($result); $i++) {
		        if($params['username'] == $result[$i]->Username) {
		            $not_same_user = false;
		        }
		    }
		    if($not_same_user) {
		        $encode_username = Keys::encryptId($params['username']);
		        $encode_password = Keys::encryptPassword($params['password']);
		        $sql_add_user = 'INSERT INTO `user` (`UID`, `Username`, `Password`, `Authen`) ' .
                                'VALUES (' . self::nullValue($encode_username) . ', ' . 
                                            self::nullValue($params['username']) . ', ' . 
                                            self::nullValue($encode_password) . ', ' . 
                                            self::nullValue($params['auth']) . 
                                        ')';
                DB::puts($sql_add_user);
                
                $sql_username = "SELECT * FROM user WHERE user.Username = '" . $params['username'] . "'";
		        $result = DB::query($sql_username)->get();
		        if(count($result) > 0) {
		            echo json_encode(array("status" => true));
		        }
		        else {
		            echo json_encode(array("status" => false));
		        }
		        
		    }
		    else {
		        echo json_encode(array("status" => false));
		    }
		}
		
		public static function updatePayment($params) {
		    $params['full_price'] = str_replace(',', '', $params['full_price']);
		    if($params['amount'] == "") {
		        $params['amount'] = null;
		    }
		    if($params['amount_percentage'] == "") {
		        $params['amount_percentage'] = null;
		    }
		    $sql_payment = 'INSERT INTO `payment` (`JID`, `Terms`, `Payment_Type`, `Amount_Actual_Price`, `Amount_Actual_Percentage`, `Invoice_Date`) ' .
                          'VALUES (' . self::nullValue($params['jid']) . ', ' .
                                        self::nullValue($params['terms']) . ', ' .
                                        self::nullValue($params['desc']) . ', ' .
                                        self::amountValue($params['amount'], $params['amount_percentage'], $params['full_price']) . ', ' .
                                        self::nullValue($params['payment_date']) .
                                    ')';
            DB::puts($sql_payment);
            
            $sql_select = "SELECT * FROM payment WHERE payment.JID = '" . $params['jid'] . "' AND payment.Payment_Type = '" . $params['desc'] . "' AND payment.Terms = '" . $params['terms'] . "'";
            $result = DB::query($sql_select)->get();
            if(count($result) > 0) {
                echo json_encode(array("status" => true, "obj" => $result));
            }
            else {
                echo json_encode(array("status" => false));
            }
		}
		
		public static function updateGuarantee($params) {
		    $params['full_price'] = str_replace(',', '', $params['full_price']);
		    if($params['amount'] == "") {
		        $params['amount'] = null;
		    }
		    if($params['amount_percentage'] == "") {
		        $params['amount_percentage'] = null;
		    }
		    $sql_guarantee = 'INSERT INTO `guarantee` (`JID`, `Terms`, `Guarantee_Type`, `Amount_Actual_Price`, `Amount_Actual_Percentage`, `Start_Plan`, `Until_Plan`) ' .
                           'VALUES (' . self::nullValue($params['jid']) . ', ' .
                                        self::nullValue($params['terms']) . ', ' .
                                        self::nullValue($params['desc']) . ', ' .
                                        self::amountValue($params['amount'], $params['amount_percentage'], $params['full_price']) . ', ' .
                                        self::nullValue($params['start_date']) . ', ' .
                                        self::nullValue($params['until_date']) .
                                    ')';
            DB::puts($sql_guarantee);
            
            $sql_select = "SELECT * FROM guarantee WHERE guarantee.JID = '" . $params['jid'] . "' AND guarantee.Guarantee_Type = '" . $params['desc'] . "' AND guarantee.Terms = '" . $params['terms'] . "'";
            $result = DB::query($sql_select)->get();
            if(count($result) > 0) {
                echo json_encode(array("status" => true, "obj" => $result));
            }
            else {
                echo json_encode(array("status" => false));
            }
		}
        
        public static function nullValue($str) {
            if($str == 'none' || $str == '') {
                return 'null';
            }
            else {
                return '\'' . $str . '\'';
            }
        }
        
        public static function amountValue($amount_thb, $amount_percentage, $full_price) {
            if(is_null($amount_thb) && !is_null($amount_percentage)) {
                $baht = intval($full_price) * (intval($amount_percentage) / 100);
                return '\'' . $baht . '\', \'' . $amount_percentage . '\'';
            }
            else if(!is_null($amount_thb) && is_null($amount_percentage)) {
                $percent = (intval($amount_thb) * 100) / intval($full_price);
                return '\'' . $amount_thb . '\', \'' . $percent . '\'';
            }
            else {
                return 'null, null';
            }
        }
    }
?>