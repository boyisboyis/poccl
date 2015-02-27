<?php

class dateTimes{
  
  public static function calculationDate($day, $time = ""){
    if($time == ""){
      $time = new DateTime('NOW');
    }
    $date = new DateTime();
		$date->setTimestamp(strtotime($time) + ($day * 24 *60 * 60 ));
		return $date->format('Y-m-d');
  }
}

?>