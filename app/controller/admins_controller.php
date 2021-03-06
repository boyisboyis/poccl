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
				case "delete_payment" : adminController::deletePayment($params);break;
				case "delete_guarantee" : adminController::deleteGuarantee($params);break;
				case "get_type" : adminController::getType($params);break;
				case "add_type" : adminController::addType($params);break;
				case "get_checklist" : adminController::getChecklist($params);break;
				case "set_checklist" : adminController::setChecklist($params);break;
    		}
    	}
    }
    else{
    	Redirect::to("/");
    	die();
    }
    
    class adminController {
        public static function create($params) {
            
            $sql_jid = "SELECT po_asso.JID FROM po_asso WHERE po_asso.JID = '" . $params['job_no'] . "'";
            $same_jid = DB::query($sql_jid)->get();
            
            if(count($same_jid) == 0) {
            
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
                        $sql_payment = 'INSERT INTO `payment` (`PID`, `JID`, `Terms`, `Payment_Type`, `Amount_Actual_Price`, `Amount_Actual_Percentage`, `Invoice_Date`) ' .
                                       'VALUES (' . self::nullValue(round(microtime(true) * 1000) . $params['job_no']) . ', ' .
                                       				self::nullValue($params['job_no']) . ', ' .
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
                        $sql_guarantee = 'INSERT INTO `guarantee` (`GID`, `JID`, `Terms`, `Guarantee_Type`, `Amount_Actual_Price`, `Amount_Actual_Percentage`, `Start_Plan`, `Until_Plan`) ' .
                                       'VALUES (' . self::nullValue(round(microtime(true) * 1000) . $params['job_no']) . ', ' .
                                       				self::nullValue($params['job_no']) . ', ' .
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
            else {
                echo json_encode(array("status" => false));
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
		    if($params['type'] == "Contract_Value_THB" || $params['type'] == "Contract_Value_Other") {
		        if($params['value'] == '' || intval($params['value']) <= 0) {
		            $params['value'] = 1;
		        }
		    }
		    
		    $sql_update = "UPDATE " . $params['table'] . " SET " . $params['table'] . "." . $params['type'] . " = " . self::nullValue($params['value']) . " WHERE " . $params['table'] . ".JID" . " = '" . $params['jid'] . "'";
		    if(trim($params['other']) != ''){
		        if($params["table"] == "payment"){
		            $sql_update .= " AND " . $params['table'] . ".PID = '" . $params['other'] . "'";
		        }
		        else if($params["table"] == "guarantee"){
		            $sql_update .= " AND " . $params['table'] . ".GID = '" . $params['other'] . "'";
		        }
		    }
		    DB::puts($sql_update);
		    
		    /*if($params['type'] == "Contract_Value_THB") {
		        $result_old_payment_value = DB::query("SELECT payment.PID, payment.Amount_Actual_Price FROM payment WHERE payment.JID" . " = '" . $params['jid'] . "'")->get();
		        $result_old_guarantee_value = DB::query("SELECT guarantee.GID, .Amount_Actual_Price FROM guarantee WHERE guarantee.JID" . " = '" . $params['jid'] . "'")->get();
		        $result_old_value_other = DB::query("SELECT job.Contract_Value_Rate FROM job WHERE job.JID = '" . $params['jid'] . "'")->get();
		        $new_value_other = $params['value'] / $result_old_value_other[0]->Contract_Value_Rate;
		        DB::puts("UPDATE job SET job.Contract_Value_Other = '" . $new_value_other . "' WHERE job.JID = '" . $params['jid'] . "'");
		        
		        for($i = 0; $i < count($result_old_payment_value); $i++) {
		            $result_old_payment_value[$i]->New_Percentage = ($result_old_payment_value[$i]->Amount_Actual_Price * 100)/$params['value'];
		            DB::puts("UPDATE payment SET payment.Amount_Actual_Percentage = '" . $result_old_payment_value[$i]->New_Percentage . "' WHERE payment.PID = '" . $result_old_payment_value[$i]->PID . "'");
		        }
		        for($i = 0; $i < count($result_old_guarantee_value); $i++) {
		            $result_old_guarantee_value[$i]->New_Percentage = ($result_old_guarantee_value[$i]->Amount_Actual_Price * 100)/$params['value'];
		            DB::puts("UPDATE guarantee SET guarantee.Amount_Actual_Percentage = '" . $result_old_guarantee_value[$i]->New_Percentage . "' WHERE guarantee.GID = '" . $result_old_guarantee_value[$i]->GID . "'");
		        }
		    }
		    else if($params['type'] == "Contract_Value_Other") {
		        $result_old_value_other = DB::query("SELECT job.Contract_Value_THB FROM job WHERE job.JID = '" . $params['jid'] . "'")->get();
		        $new_value_other = $result_old_value_other[0]->Contract_Value_THB / $params['value'];
		        DB::puts("UPDATE job SET job.Contract_Value_Rate = '" . $new_value_other . "' WHERE job.JID = '" . $params['jid'] . "'");
		    }
		    else if($params['type'] == "Contract_Value_Rate") {
		        $result_old_value_other = DB::query("SELECT job.Contract_Value_THB FROM job WHERE job.JID = '" . $params['jid'] . "'")->get();
		        $new_value_other = $result_old_value_other[0]->Contract_Value_THB / $params['value'];
		        DB::puts("UPDATE job SET job.Contract_Value_Other = '" . $new_value_other . "' WHERE job.JID = '" . $params['jid'] . "'");
		    }*/
		    
		    if(trim($params['other']) != '' && $params['type'] != "Date_Actual" && $params['type'] != "Until_Actual" && $params["type"] != "Start_Actual" && $params['type'] != "Work_Complete_Date"){
		        
		        $amount_data = DB::query("SELECT job.Contract_Value_THB FROM job WHERE job.JID='".$params['jid']."'")->get();

		        $amount = $amount_data[0]->Contract_Value_THB;
		        
		        if($params['type'] == "Amount_Actual_Price"){
		           $columns = "Amount_Actual_Percentage";
		        }
		        else if($params['type'] == "Amount_Actual_Percentage"){
		           $columns = "Amount_Actual_Price";
		        }
		        
		        if($params["table"] == "payment"){
		            $sql_select_update = "SELECT ". $params['table'] . ".PID, " . $params['table'] . ".".$params['type']." FROM " . $params['table']. " WHERE " . $params['table'] . ".JID" . " = '" . $params['jid'] . "'";
		        }
		        else if($params["table"] == "guarantee"){
		            $sql_select_update = "SELECT ". $params['table'] . ".GID, " . $params['table'] . ".".$params['type']." FROM " . $params['table']. " WHERE " . $params['table'] . ".JID" . " = '" . $params['jid'] . "'";
		        }
		    
		        if($params["table"] == "payment"){
	                $sql_select_update .= " AND ". $params['table'] . ".PID = '" . $params['other'] . "'";
	            }
	            else if($params["table"] == "guarantee"){
	                $sql_select_update .= " AND ". $params['table'] . ".GID = '" . $params['other'] . "'";
	            }

		        $reup = DB::query($sql_select_update)->get();
		        //$reup_count = count($reup);

		        //for($i=0; $i < $reup_count; $i++){
	            $data = $reup[0];
	            if($params['type'] == "Amount_Actual_Percentage") {
	                $value = ($amount * $data->Amount_Actual_Percentage) / 100;
	            }
	            else{
	                $value = ($data->Amount_Actual_Price * 100)/$amount;
	            }
	            
                //echo $value;
	            $sql_update = "UPDATE " . $params['table'] . " SET " . $params['table'] . ".".$columns." = '" . $value . "' WHERE " . $params['table'] . ".JID" . " = '" . $params['jid'] . "'";
	            if($params["table"] == "payment"){
	                $sql_update .= " AND ". $params['table'] . ".PID = '" . $data->PID . "'";
	            }
	            else if($params["table"] == "guarantee"){
	                $sql_update .= " AND ". $params['table'] . ".GID = '" . $data->GID . "'";
	            }
	            DB::puts($sql_update);
		        //}
		       
		        
		    }
		    
		    $sql_select_check = "SELECT ";
		    if($params["table"] == "payment"){
		        $sql_select_check .=  $params['table'] . ".PID, " . $params['type'] . ", " .  $params['table'] . ".Amount_Actual_Price, " .  $params['table'] . ".Amount_Actual_Percentage FROM " . $params['table'];
		    }
		    else if($params["table"] == "guarantee"){
		        $sql_select_check .=  $params['table'] . ".GID, " . $params['type'] . ", " .  $params['table'] . ".Amount_Actual_Price, " .  $params['table'] . ".Amount_Actual_Percentage FROM " . $params['table'];
		    }
		    else{
		       $sql_select_check .=  $params['table'] . "." . $params['type'] . " FROM " . $params['table'];
		    }
		    
		    $sql_select_check .= " WHERE " . $params['table'] . ".JID" . " = '" . $params['jid'] . "'";
		    if($params["table"] == "payment"){
                $sql_select_check .= " AND ". $params['table'] . ".PID = '" . $params['other'] . "'";
            }
            else if($params["table"] == "guarantee"){
                $sql_select_check .= " AND ". $params['table'] . ".GID = '" . $params['other'] . "'";
            }
		 
		    $result = DB::query($sql_select_check)->get();
		    
	        $result_new_payment_value;
	        $result_new_guarantee_value;
	        $result_new_value_other;
	        $result_new_value_rate;
	        
	        /*if($params['type'] == "Contract_Value_THB") {
	            $result_new_payment_value = DB::query("SELECT payment.PID, payment.Amount_Actual_Price, payment.Amount_Actual_Percentage FROM payment WHERE payment.JID" . " = '" . $params['jid'] . "'")->get();
	            $result_new_guarantee_value = DB::query("SELECT guarantee.GID, .Amount_Actual_Price, guarantee.Amount_Actual_Percentage FROM guarantee WHERE guarantee.JID" . " = '" . $params['jid'] . "'")->get();
	            $result_new_value_other = DB::query("SELECT job.Contract_Value_Other FROM job WHERE job.JID = '" . $params['jid'] . "'")->get();
	        }
	        else if($params['type'] == "Contract_Value_Other") {
	            $result_new_value_rate = DB::query("SELECT job.Contract_Value_Rate FROM job WHERE job.JID = '" . $params['jid'] . "'")->get();
	        }
	        else if($params['type'] == "Contract_Value_Rate") {
	            $result_new_value_other = DB::query("SELECT job.Contract_Value_Other FROM job WHERE job.JID = '" . $params['jid'] . "'")->get();
	        }*/
		    //echo $result[0]->$params['type'];
		    //echo $params['value'];

		    if($result[0]->$params['type'] == $params['value']) {
		        $ret = array();
		        if($params["table"] == "payment"){
    		        $ret["table"] = $params["table"];
		            $ret["value"] = $result;
		        }
		        else if($params["table"] == "guarantee"){
    		        $ret["table"] = $params["table"];
		            $ret["value"] = $result;
		        }
		        /*else if($params['type'] == "Contract_Value_THB") {
    		        $ret["task"] = "new_po_amount";
		            $ret["value_payment"] = $result_new_payment_value;
		            $ret["value_guarantee"] = $result_new_guarantee_value;
		            $ret["value_other"] = $result_new_value_other;
		        }
		        else if($params['type'] == "Contract_Value_Other") {
    		        $ret["task"] = "new_value_other";
		            $ret["value_rate"] = $result_new_value_rate;
		        }
		        else if($params['type'] == "Contract_Value_Rate") {
    		        $ret["task"] = "new_value_rate";
		            $ret["value_other"] = $result_new_value_other;
		        }*/
		        else{
		            $ret["value"] = $result[0]->$params['type'];
		        }
		        echo json_encode(array("status" => true, 'obj' => $ret));
		    }
		    else {
		        echo json_encode(array("status" => false, "obj" => $params, "sql" => $sql_update));
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
		    $sql_payment = 'INSERT INTO `payment` (`PID`, `JID`, `Terms`, `Payment_Type`, `Amount_Actual_Price`, `Amount_Actual_Percentage`, `Invoice_Date`) ' .
                          'VALUES (' . 	self::nullValue(round(microtime(true) * 1000) . $params['jid']) . ', ' .
                          				self::nullValue($params['jid']) . ', ' .
                                        self::nullValue($params['terms']) . ', ' .
                                        self::nullValue($params['desc']) . ', ' .
                                        self::amountValue($params['amount'], $params['amount_percentage'], $params['full_price']) . ', ' .
                                        self::nullValue($params['payment_date']) .
                                    ')';
            DB::puts($sql_payment);
            
            $sql_select = "SELECT * FROM payment WHERE payment.JID = '" . $params['jid'] . "' AND payment.Payment_Type = '" . $params['desc'] . "' AND payment.Terms = '" . $params['terms'] . "'";
            $result = DB::query($sql_select)->get();
            $sql_select_credit = "SELECT job.Credit_Term FROM job WHERE job.JID = '" . $params['jid'] . "'";
            $result_credit = DB::query($sql_select_credit)->get();
            if(count($result_credit[0]->Credit_Term) == 0) {
            	$invoice_plus_credit = $result[0]->Invoice_Date;
            }
            else {
            	$invoice_plus_credit = date('Y-m-d', strtotime($result[0]->Invoice_Date . '+' . $result_credit[0]->Credit_Term . 'days'));
            }
            
            if(count($result) > 0) {
                echo json_encode(array("status" => true, "obj" => $result, "credit" => $invoice_plus_credit));
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
		    $sql_guarantee = 'INSERT INTO `guarantee` (`GID`, `JID`, `Terms`, `Guarantee_Type`, `Amount_Actual_Price`, `Amount_Actual_Percentage`, `Start_Plan`, `Until_Plan`) ' .
                           'VALUES (' . self::nullValue(round(microtime(true) * 1000) . $params['jid']) . ', ' .
                           				self::nullValue($params['jid']) . ', ' .
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
		
		public static function deletePayment($params) {
		    $sql_payment = "DELETE FROM payment WHERE payment.JID = '" . $params['jid'] . "' AND payment.Payment_Type = '" . $params['type'] . "' AND payment.Terms = '" . $params['terms'] . "'";
			DB::puts($sql_payment);
			
			$sql_select = "SELECT * FROM payment WHERE payment.JID = '" . $params['jid'] . "' AND payment.Payment_Type = '" . $params['type'] . "' AND payment.Terms = '" . $params['terms'] . "'";
            $result = DB::query($sql_select)->get();
            if(count($result) == 0) {
                echo json_encode(array("status" => true));
            }
            else {
                echo json_encode(array("status" => false));
            }
		}
		
		public static function deleteGuarantee($params) {
		    $sql_guarantee = "DELETE FROM guarantee WHERE guarantee.JID = '" . $params['jid'] . "' AND guarantee.Guarantee_Type = '" . $params['type'] . "' AND guarantee.Terms = '" . $params['terms'] . "'";
			DB::puts($sql_guarantee);
			
			$sql_select = "SELECT * FROM guarantee WHERE guarantee.JID = '" . $params['jid'] . "' AND guarantee.Guarantee_Type = '" . $params['type'] . "' AND guarantee.Terms = '" . $params['terms'] . "'";
            $result = DB::query($sql_select)->get();
            if(count($result) == 0) {
                echo json_encode(array("status" => true));
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
                $baht = ($full_price * ($amount_percentage / 100));
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
        
        public static function getType($params) {
            $sql_get_po_type = "SELECT " . $params . ".Description FROM " . $params;
            $result = DB::query($sql_get_po_type)->get();
            
            if(count($result != 0)) {
                sort($result);
                echo json_encode(array("status" => true, "obj" => $result));
            }
            else {
                echo json_encode(array("status" => false));
            }
        }
        
        public static function addType($params) {
            $sql_get_type = "SELECT " . $params['table'] . ".Description FROM " . $params['table'] . " WHERE " . $params['table'] . ".Description = '" . $params['desc'] . "'";
            $result = DB::query($sql_get_type)->get();
            
            if(count($result) != 0) {
                echo json_encode(array("status" => false));
            }
            else {
                $sql_add_type = "INSERT INTO `" . $params['table'] . "` (`Description`) " .
                                    "VALUES (" . self::nullValue($params['desc']) . ")";
                DB::puts($sql_add_type);
                
                $sql_get_type_check = "SELECT " . $params['table'] . ".Description FROM " . $params['table'] . " WHERE " . $params['table'] . ".Description = '" . $params['desc'] . "'";
                $result_check = DB::query($sql_get_type_check)->get();
                
                if(count($result_check) != 0) {
                    echo json_encode(array("status" => true)); 
                }
                else {
                    echo json_encode(array("status" => false));
                }
            }
        }
        
        public static function getChecklist($params) {
            $sql_get_checklist = "SELECT job.Check_List, job.Credit_Term FROM job WHERE job.JID = '".$params["jid"]."'";
            $result = DB::query($sql_get_checklist)->get();
            
            $sql_get_payment = "SELECT `PID`,`Terms`,`Payment_Type`,`Invoice_Date`,`Date_Actual`  FROM `payment` WHERE `JID` = '".$params["jid"]."' ORDER BY `Payment_Type` ASC, `Terms` ASC";
            
            $result2 = DB::query($sql_get_payment)->get();
            $np = count($result2);
            for($j=0;$j<$np;$j++){
			 	$result2[$j]->Payment_date_plan = dateTimes::calculationDate($result[0]->Credit_Term, $result2[$j]->Invoice_Date);
			}
            $sql_get_guarantee = "SELECT `GID`,`Terms`,`Guarantee_Type`,`Start_Actual`,`Until_Actual`  FROM `guarantee` WHERE `JID` = '".$params["jid"]."' ORDER BY `Guarantee_Type` ASC, `Terms` ASC";
            
            $result3 = DB::query($sql_get_guarantee)->get();
            
            $ret = array("Check_list" => $result[0]->Check_List, "payment" => $result2, "guarantee" => $result3, "sql" => $sql_get_payment);
            
            if(count($result != 0)) {
                sort($result);
                echo json_encode(array("status" => true, "obj" => $ret));
            }
            else {
                echo json_encode(array("status" => false));
            }
        }
        
        // public static function setChecklist($params) {
        //     $sql_set_checklist = "UPDATE job ";
        // }
    }
?>