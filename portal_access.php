<?php

  //################### Check Mac Address Before Render Page ###################//
 
  // $ipclient = get_client_ip();
  // $macAddr = false;
      
  // #run the external command, break output into lines
  // $arp = `arp -a $ipclient`;
  // $lines = explode("\n", $arp);
      
  // #look for the output line describing our IP address
  // foreach($lines as $line) {
  //   $cols = preg_split('/\s+/', trim($line));
  //   print_r($cols);
  //   if ($cols[0] == $ipclient) {
  //     $macAddr = $cols[1];
  //   }
  // }
  
  // #This is MacAddress Client
  // print_r($macAddr);

  // function get_client_ip() {
  //   $ipaddress = '';
  //   if (getenv('HTTP_CLIENT_IP'))
  //       $ipaddress = getenv('HTTP_CLIENT_IP');
  //   else if(getenv('HTTP_X_FORWARDED_FOR'))
  //       $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
  //   else if(getenv('HTTP_X_FORWARDED'))
  //       $ipaddress = getenv('HTTP_X_FORWARDED');
  //   else if(getenv('HTTP_FORWARDED_FOR'))
  //       $ipaddress = getenv('HTTP_FORWARDED_FOR');
  //   else if(getenv('HTTP_FORWARDED'))
  //     $ipaddress = getenv('HTTP_FORWARDED');
  //   else if(getenv('REMOTE_ADDR'))
  //       $ipaddress = getenv('REMOTE_ADDR');
  //   else
  //       $ipaddress = 'UNKNOWN';
  //   return $ipaddress;
  // }

  // die();
    
    
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