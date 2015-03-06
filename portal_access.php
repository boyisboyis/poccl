<?php

$GLOBALS["environment"] = parse_ini_file('config/env.ini');
if($GLOBALS["environment"]["maintain"] == 1){
  require('public/503.html');
  die();
}

$uri = ROUTE::getURI()->conPath();
$db_config = parse_ini_file(__DIR__.'/config/db.ini');
$DB = new DB($db_config['host'], $db_config['username'], ini_get('mysqli.default_pw'), $db_config['dbname']);
$DB->connect();
if($uri == ""){
  ROUTE::getPage("home");
}
else{
 ROUTE::getPage($uri);
}
 
?>