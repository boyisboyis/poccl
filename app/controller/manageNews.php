<?php

if(Check::isAjax()){
	if(isset($_POST["type"]) && !empty($_POST["type"])) {
		$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
		switch($type){
			case "paymentsAlert" : News::paymentsAlert();break;
			case "guaranteesAlert" : News::guaranteesAlert();break;
			case "poidnullAlert" : News::poidnullAlert();break;
			case "paymentsNearAlert" : News::paymentsNearAlert();break;
			case "checkListsAlert" : News::checkListsAlert();break;
			break;
		}		
	}
}
else{
	Redirect::to("/");
	die();
}


class News {
	public static function paymentsAlert(){
		$result = DB::query("SELECT payment.JID, payment.Invoice_Date, job.Credit_Term FROM payment, job WHERE payment.Invoice_Date <= '" . date("Y-m-d") . "' AND payment.Date_Actual is null AND payment.JID = job.JID")->get();
		$n = count($result);
		if($n > 0){
			$time_now = new DateTime("now");
			$return = array('obj' => array(), 'status' => true);
			for($i=0;$i<$n;$i++){
				$credit_term = $result[$i]->Credit_Term;
				$invoice = $result[$i]->Invoice_Date;
				$time_add = dateTimes::calculationDate($credit_term, $invoice);
				if($time_now > new DateTime($time_add)){
					$return['obj'][$i] = $result[$i];
					$return['obj'][$i]->Payment = $time_add;
				}
			}
		  sort($return['obj']);
		  if(count($return['obj']) > 0) {
		  	echo json_encode($return);
		  }
		  else {
		  	echo json_encode(array("status" => false));die();
		  }
		  die();
		}
		else{
			echo json_encode(array("status" => false));die();
		}
	}
	public static function guaranteesAlert() {
		$result = DB::query("SELECT guarantee.JID, guarantee.Until_Plan FROM guarantee, job WHERE guarantee.Until_Plan <= '" . date("Y-m-d") . "' AND guarantee.Until_Actual is null AND guarantee.JID = job.JID ORDER BY  guarantee.Until_Plan")->get();
		$n = count($result);
		if($n > 0){
			$time_now = new DateTime("now");
			$return = array('obj' => array(), 'status' => true);
			for($i=0;$i<$n;$i++){
				$until = $result[$i]->Until_Plan;
				if($time_now > new DateTime($until)){
					$return['obj'][$i] = $result[$i];
					$return['obj'][$i]->Guarantee = $until;
				}
			}
		  sort($return['obj']);
		  if(count($return['obj']) > 0) {
		  	echo json_encode($return);
		  }
		  else {
		  	echo json_encode(array("status" => false));die();
		  }
		  die();
		}
		else{
			echo json_encode(array("status" => false));die();
		}
	}
	public static function poidnullAlert() {
		$result = DB::query("SELECT po_asso.JID FROM po_asso WHERE po_asso.PO_No is null")->get();
		$n = count($result);
		if($n > 0){
			$time_now = new DateTime("now");
			$return = array('obj' => array(), 'status' => true);
			for($i=0;$i<$n;$i++){
				$return['obj'][$i] = $result[$i];
			}
		  	sort($return['obj']);
		  	if(count($return['obj']) > 0) {
		  		echo json_encode($return);
		  	}
		  	else {
		  		echo json_encode(array("status" => false));die();
		  	}
		  	die();
		}
		else{
			echo json_encode(array("status" => false));die();
		}
	}
	public static function paymentsNearAlert() {
		$respond = array('obj' => array(), 'status' => true);
		$today = date('Y-m-d');
		$next30day = date('Y-m-d', strtotime('+30 days'));
		$result = DB::query("SELECT payment.JID, payment.Invoice_Date, job.Credit_Term FROM payment LEFT JOIN job ON payment.JID = job.JID WHERE payment.Invoice_Date BETWEEN '" . $today . "' AND '" . $next30day . "'")->get();

		if(count($result) > 0) {
			for($count = 0; $count < count($result); $count++) {
				if($count + 1 < count($result)) {
					for($countIn = $count + 1; $countIn < count($result); $countIn++) {
						if(!self::findMinDate($result[$count]->Invoice_Date, $result[$countIn]->Invoice_Date)) {
							$temp = $result[$count];
							$result[$count] = $result[$countIn];
							$result[$countIn] = $temp;
						}
					}
				}
			}
			$generate = 0;
			for($count = 0; $count < count($result); $count++) {
				if(is_null($result[$count]->Credit_Term)) {
					$result[$count]->Credit_Term = 0;
				}
				if((strtotime(date('Y-m-d', strtotime($result[$count]->Invoice_Date . '+' . $result[$count]->Credit_Term . ' days'))) - strtotime(date('Y-m-d'))) >= 0) {
					$respond['obj'][$generate] = array("JID" => $result[$count]->JID, "Invoice_plus_credit_date" => $result[$count]->Invoice_Date);
					$generate += 1;
				}
			}
			if(!empty($respond['obj'])) {
				echo json_encode($respond);
			}
			else {
				echo json_encode(array("status" => false));
			}
		}
		else {
			echo json_encode(array("status" => false));
			die();
		}
	}
	public static function findMinDate($oldMin, $check) {
	    if(strtotime($oldMin) - strtotime($check) < 0){
	    	return true;
	    }
	    else {
	    	return false;
	    }
	}
	public static function checkListsAlert() {
		$result = DB::query("SELECT job.JID FROM job WHERE job.Check_List = '0'")->get();
		$n = count($result);
		if($n > 0){
			$return = array('obj' => array(), 'status' => true);
			for($i = 0; $i < $n; $i++){
				$return['obj'][$i] = $result[$i];
			}
		  	sort($return['obj']);
		  	if(count($return['obj']) > 0) {
		  		echo json_encode($return);
		  	}
		  	else {
		  		echo json_encode(array("status" => false));die();
		  	}
		  	die();
		}
		else{
			echo json_encode(array("status" => false));die();
		}
	}
}

/*	include_once("../../config/connectdb.php");

	if(is_ajax()) {
		if(isset($_POST["data"]) && !empty($_POST["data"])) {
			$data = $_POST["data"];
			switch($data) {
				case "update":	updateNews();
									break;
			}
		}
	}

	function is_ajax() {
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

	function updateNews() {
		$return = null;
		$query = "SELECT * FROM payment WHERE payment.Invoice_Date < '" . date("Y-m-d") . "' AND payment.Payment_Status = '0'";
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
		//echo date('Y-m-d', strtotime("+30 days"));
		for($k = 0; $k < count($temp); $k++) {
			$return2 = null;
			$query = "SELECT * FROM job WHERE job.JID = '" . $temp[$k]->JID . "'";
			$result = mysql_query($query);
			$credit_term = 0;
			while($obj = mysql_fetch_object($result)) {
		      	$credit_term = $obj->Credit_Term;
				$invoice = $temp[$k]->Invoice_Date;
				$date = new DateTime();
				$date->setTimestamp(strtotime($invoice) + ($credit_term * 24 *60 * 60 ));
				$date1 = new DateTime($date->format('Y-m-d'));
				$date2 = new DateTime("now");
				//if(date()->diff($date->format('Y-m-d'))){
				if($date2 > $date1){
				  	$return[$i] = $obj;
					$return[$i]->Payment[0] = $date->format('Y-m-d');
				 	$i++;
				}
			}

		}
		echo json_encode($return);
	}*/
?>