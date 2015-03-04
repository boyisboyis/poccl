<?php

if(Check::isAjax()){
	if((isset($_POST["month"]) && !empty($_POST["month"])) &&  (isset($_POST["year"]) && !empty($_POST["year"]))) {
	    $month = $_POST['month'];
	    $year = $_POST['year'];
	    reportOptions::report($month, $year);
	}
}
else{
	Redirect::to("/");
	die();
}

class reportOptions{
    
    public static function report($month, $year) {
        if($month != "" && $year != "") {
            foreach($year as $yy) {
                foreach($month as $m) {
                    $sql = "payment.Invoice_Date LIKE '" . $yy . "-" . $m . "-%'";
                }
            }
            $result = DB::query("SELECT * FROM payment WHERE " . implode(" OR ", $sql))->get();
            echo json_encode($result);
        }
        else {
            echo json_encode(array("status" => false));
        }
    }
    
}