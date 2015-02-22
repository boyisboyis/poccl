<?php
  
$GLOBALS["environment"] = parse_ini_file('config/env.ini');
if($GLOBALS["environment"]["maintain"] == 1){
  require('public/503.html');
  die();
}

$uri = ROUTE::getURI()->conPath();
print_r($uri);
 // $result =  ROUTE::getURI();
 // echo $result;
 // echo "<br/>";
 // //echo Redirect::to();
 // if($result === "/"){
 //   Redirect::to("home");
 //   //require __DIR__.'/app/view/application/application.php';
 //   die();
 // }
 // else{
   
 // }
 
  // $route = new ROUTE;
  // echo $route->getPath();
 // echo ROUTE::getPath()->getArray();
  
  //$paths = require __DIR__.'/bootstrap/paths.php';

  //$requested = $paths['public'].$uri;
 // echo "<br>";
  //echo $requested;
  
  
 /* $config = parse_ini_file('config/db.ini');
   $db = new DB($config['host'], $config['username'], ini_get('mysqli.default_pw'), $config['dbname']);
   $db->connect();*/
  /*$config = parse_ini_file('config/db.ini');
  //$this->con = mysqli_connect($config['host'], $config['username'], ini_get('mysqli.default_pw'), $config['dbname']);
  $GLOBALS["db_global"] = new DB($config['host'], $config['username'], "", $config['dbname']);
  $GLOBALS["db_global"]->connect();*/
  
  

?>