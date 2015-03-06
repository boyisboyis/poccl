<?php

if(Check::isAjax()){
	if((isset($_POST["month"]) && !empty($_POST["month"])) &&  (isset($_POST["year"]) && !empty($_POST["year"]))) {
	    $month = $_POST['month'];
	    $year = $_POST['year'];
	    reportOptions::report($month, $year);
	}
	else if(isset($_POST["get_years"]) && $_POST["get_years"] == "get_years"){
	    reportOptions::getYears();
	}
}
else{
	Redirect::to("/");
	die();
}

class reportOptions{
    
    public static function report($month, $year) {
        $sql = array();
        if($month != "" && $year != "") {
            foreach($year as $yy) {
                foreach($month as $m) {
                    $sql[] = "payment.Invoice_Date LIKE '" . $yy . "-" . $m . "-%'";
                }
            }
            $result = DB::query("SELECT * FROM payment JOIN job ON payment.JID = job.JID WHERE " . implode(" OR ", $sql) . " ORDER BY payment.Invoice_Date ASC")->get();
            echo json_encode(array("status" => true, "obj" => $result));
            //echo json_encode($result);
        }
        else {
            echo json_encode(array("status" => false));
        }
    }
    
    public static function getYears(){
        $result = DB::query("SELECT min(payment.Invoice_Date) as max, max(payment.Invoice_Date) as min FROM payment")->get();
        if(count($result) > 0){
            $max = explode("-", $result[0]->max);
            $min = explode("-", $result[0]->min);
            echo json_encode(array("status" => true, "obj" => array("max" => $max[0], "min" => $min[0])));
            die();
        }
        echo json_encode(array("status" => false));die();
    }
    
}