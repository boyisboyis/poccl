<?php

if(Check::isAjax()){
	if(isset($_POST["type"]) && !empty($_POST["type"])) {
		$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
		switch($type){
			case "job" : searchOptions::search("job", filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING));
			break;
			case "contract" : searchOptions::search("contract", filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING));
			break;
			case "poid" : searchOptions::search("poid", filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING));
			break;
		}		
	}
}
else{
	Redirect::to("/");
	die();
}

class searchOptions{
	
	public static function search($type, $search = ""){
		$where = array("job" => "JID", "contract" => "Contactor_Name", "poid" => "PO_No");
		if($search != ""){
			$result = DB::query("SELECT * FROM po_asso WHERE po_asso.".$where[$type]." LIKE '%".$search."%'")->get();
		}
		else{
			$result = DB::query("SELECT * FROM po_asso")->get();
		}
		$n = count($result);
		if($n > 0){
			$return = array('status' => true, 'obj' => array());
			for($i=0;$i<$n;$i++){
				$return['obj'][$i] = $result[$i];
				$jid = $result[$i]->JID;
				$job = DB::query("SELECT * FROM job WHERE job.JID = '$jid' ORDER BY job.JID")->get();
				$payment = DB::query("SELECT * FROM payment WHERE payment.JID = '$jid' ORDER BY payment.Terms")->get();
				$job[0]->Secrecy_Agreement = ($job[0]->Secrecy_Agreement == null || $job[0]->Secrecy_Agreement == false)?"NO":"YES";
				$job[0]->Late_Pay_Finan_Chage = ($job[0]->Late_Pay_Finan_Chage == null)?"-": ($job[0]->Late_Pay_Finan_Chage == false)?"NO":"YES";
				$np = count($payment);
				for($j=0;$j<$np;$j++){
				 	$payment[$j]->Payment_date_plan = dateTimes::calculationDate($job[0]->Credit_Term, $payment[$j]->Invoice_Date);
				}
				$return['obj'][$i]->Job = $job[0];
				$return['obj'][$i]->Guarantee = DB::query("SELECT * FROM guarantee WHERE guarantee.JID = '$jid' ORDER BY guarantee.Terms")->get();
				$return['obj'][$i]->Payment = $payment;
			}
			//$return['status'] = true;
			echo json_encode($return);
		}
		else{
			echo json_encode(array("status" => false));
		}
	
	}
	
}

	/*include_once("../../config/connectdb.php");

	if(is_ajax()) {
		if(isset($_POST["search"]) && !empty($_POST["search"])) {
			$search = $_POST["search"];
			$data = $_POST["data"];
			switch($search) {
				case "contract":	searchContract($data);
									break;
				case "job":			searchJob($data);
									break;
				case "payment":		searchPayment($data);
									break;
			}
		}
	}

	function is_ajax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

	function searchContract($data) {
		if($data != ""){
			$query = "SELECT * FROM po_asso WHERE PO_No LIKE '%$data%'";
		}
		else{
			$query = "SELECT * FROM po_asso";
		}
		$result = mysql_query($query) or die(mysql_error());
		$return = null;
		$i = 0;
		while($obj = mysql_fetch_object($result)) {
			$return[$i] = $obj;

			$po_no = $obj->JID;
			$query2 = "SELECT * FROM job WHERE job.JID = '$obj->JID' ORDER BY job.JID";
			$result2 = mysql_query($query2) or die(mysql_error());
			$query3 = "SELECT * FROM guarantee WHERE guarantee.JID = '$obj->JID' ORDER BY guarantee.Terms";
			$result3 = mysql_query($query3) or die(mysql_error());
			$query4 = "SELECT * FROM payment WHERE payment.JID = '$obj->JID' ORDER BY payment.Terms";
			$result4 = mysql_query($query4) or die(mysql_error());
			$return2 = array();
			$return3 = array();
			$return4 = array();
			while($obj2 = mysql_fetch_object($result2)) {
				$return2[] = $obj2;
			}
			while($obj3 = mysql_fetch_object($result3)) {
				$return3[] = $obj3;
			} 
			while($obj4 = mysql_fetch_object($result4)) {
				$return4[] = $obj4;
			} 
			$return[$i]->job = $return2;
			$return[$i]->Guarantee = $return3;
			$return[$i]->Payment = $return4;
			$i++;
		}
		echo json_encode($return);*/
		//echo json_encode($result);
		/*$query = "SELECT * FROM po WHERE po.Contract_No LIKE '%$data%'";
		$result = mysql_query($query) or die(mysql_error());
		$i = 0;
		$return = null;

		while($obj = mysql_fetch_object($result)) {
			$return[$i] = $obj;
			$query2 = "SELECT * FROM payment WHERE payment.Job_No = '$obj->Job_No' ORDER BY payment.Term";
			$result2 = mysql_query($query2) or die(mysql_error());
			$query3 = "SELECT * FROM guarantee WHERE guarantee.Job_No = '$obj->Job_No' ORDER BY guarantee.Term";
			$result3 = mysql_query($query3) or die(mysql_error());
			$j = 0;
			$k = 0;
			while($obj2 = mysql_fetch_object($result2)) {
				$return2[$j] = $obj2;
				$j++;
			}
			while($obj3 = mysql_fetch_object($result3)) {
				$return3[$k] = $obj3;
				$k++;
			} 
			$return[$i]->Payment = $return2;
			$return[$i]->Guarantee = $return3;
			$i++;
		}
		echo json_encode($return);*/
//	}

	// function searchJob($data) {
	// 	if($data != ""){
	// 		$query = "SELECT * FROM po_asso WHERE JID LIKE '%$data%'";
	// 	}
	// 	else{
	// 		$query = "SELECT * FROM po_asso";
	// 	}
	// 	$result = mysql_query($query) or die(mysql_error());
	// 	$return = null;
	// 	$i = 0;
	// 	while($obj = mysql_fetch_object($result)) {
	// 		$return[$i] = $obj;

	// 		$po_no = $obj->JID;
	// 		$query2 = "SELECT * FROM job WHERE job.JID = '$obj->JID' ORDER BY job.JID";
	// 		$result2 = mysql_query($query2) or die(mysql_error());
	// 		$query3 = "SELECT * FROM guarantee WHERE guarantee.JID = '$obj->JID' ORDER BY guarantee.Terms";
	// 		$result3 = mysql_query($query3) or die(mysql_error());
	// 		$query4 = "SELECT * FROM payment WHERE payment.JID = '$obj->JID' ORDER BY payment.Terms";
	// 		$result4 = mysql_query($query4) or die(mysql_error());
	// 		$return2 = array();
	// 		$return3 = array();
	// 		$return4 = array();
	// 		while($obj2 = mysql_fetch_object($result2)) {
	// 			$return2[] = $obj2;
	// 		}
	// 		while($obj3 = mysql_fetch_object($result3)) {
	// 			$return3[] = $obj3;
	// 		} 
	// 		while($obj4 = mysql_fetch_object($result4)) {
	// 			$return4[] = $obj4;
	// 		} 
	// 		$return[$i]->job = $return2;
	// 		$return[$i]->Guarantee = $return3;
	// 		$return[$i]->Payment = $return4;
	// 		$i++;
	// 	}
	// 	echo json_encode($return);
	// 	/*$query = "SELECT * FROM po WHERE po.Job_No LIKE '%$data%'";
	// 	$result = mysql_query($query) or die(mysql_error());
	// 	$i = 0;
	// 	$return = null;

	// 	while($obj = mysql_fetch_object($result)) {
	// 		$return[$i] = $obj;
	// 		$query2 = "SELECT * FROM payment WHERE payment.Job_No = '$obj->Job_No' ORDER BY payment.Term";
	// 		$result2 = mysql_query($query2) or die(mysql_error());
	// 		$query3 = "SELECT * FROM guarantee WHERE guarantee.Job_No = '$obj->Job_No' ORDER BY guarantee.Term";
	// 		$result3 = mysql_query($query3) or die(mysql_error());
	// 		$j = 0;
	// 		$k = 0;
	// 		while($obj2 = mysql_fetch_object($result2)) {
	// 			$return2[$j] = $obj2;
	// 			$j++;
	// 		}
	// 		while($obj3 = mysql_fetch_object($result3)) {
	// 			$return3[$k] = $obj3;
	// 			$k++;
	// 		} 
	// 		$return[$i]->Payment = $return2;
	// 		$return[$i]->Guarantee = $return3;
	// 		$i++;
	// 	}
	// 	echo json_encode($return);*/
	// }

	/*function searchPayment($data) {
		$query = "SELECT * FROM payment WHERE payment.Payment_Date LIKE '$data'";
		$result = mysql_query($query) or die(mysql_error());
		$i = 0;
		$payment = null;

		while($obj = mysql_fetch_object($result)) {
			$payment[$i] = $obj;
			$i++;
		}

		$temp = $payment;
		$k = 0;
		$i = 0;
		$return = null;

		for($k = 0; $k < count($temp); $k++) {
			$return2 = null;
			$query = "SELECT * FROM po WHERE po.Job_No = '" . $temp[$k]->Job_No . "'";
			$result = mysql_query($query);
			while($obj = mysql_fetch_object($result)) {
				$return[$i] = $obj;
				$query2 = "SELECT * FROM payment WHERE payment.Job_No = '" . $temp[$k]->Job_No . "' ORDER BY payment.Term";
				$result2 = mysql_query($query2) or die(mysql_error());
				$query3 = "SELECT * FROM guarantee WHERE guarantee.Job_No = '$obj->Job_No' ORDER BY guarantee.Term";
				$result3 = mysql_query($query3) or die(mysql_error());
				$j = 0;
				$m = 0;
				while($obj2 = mysql_fetch_object($result2)) {
					$return2[$j] = $obj2;
					$j++;
				}
				while($obj3 = mysql_fetch_object($result3)) {
					$return3[$m] = $obj3;
					$m++;
				} 
				$return[$i]->Payment = $return2;
				$return[$i]->Guarantee = $return3;
				$i++;
			}
		}
		echo json_encode($return);
	}

	mysql_close();*/
?>