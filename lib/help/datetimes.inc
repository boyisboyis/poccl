<?php

class dateTimes{
  
  public static function calculationDate($day, $time = ""){
    if($time == ""){
<<<<<<< HEAD
      $time = new DateTime('NOW');
    }
    $date = new DateTime();
		$date->setTimestamp(strtotime($time) + ($day * 24 *60 * 60 ));
		return $date->format('Y-m-d');
  }
=======
      $t = new DateTime("now");
      $time = strtotime($t);
    }
    $date_time = new DateTime();
    $date_time->setTimestamp(strtotime($time) + ($day * 24 *60 * 60 ));
    return $date_time->format('Y-m-d');
  }
  
>>>>>>> dev
}

?>