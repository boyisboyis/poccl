<?php
	include_once("../../config/connectdb.php");

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
	}
?>