<?php
  
$GLOBALS["environment"] = parse_ini_file('config/env.ini');
if($GLOBALS["environment"]["maintain"] == 1){
  require('public/503.html');
  die();
}

$uri = ROUTE::getURI()->conPath();
if($uri == ""){
  ROUTE::getPage("home");
}
else{
 ROUTE::getPage($uri);
}
 
?>