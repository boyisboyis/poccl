<?php
session_start();
  ################### Check Mac Address Before Render Page ###################//
 
  // $ipclient = get_client_ip();
  // $macAddr = false;
  // print_r($ipclient);
      
  #run the external command, break output into lines
  // $arp = `arp -a $ipclient`;
  // $lines = explode("\n", $arp);
      
  #look for the output line describing our IP address
  // foreach($lines as $line) {
  //   $cols = preg_split('/\s+/', trim($line));
  //   print_r($cols);
  //   if ($cols[0] == $ipclient) {
  //     $macAddr = $cols[1];
  //   }
  // }
  
  #This is MacAddress Client
  // print_r($macAddr);
  
  // function get_client_ip() {
  //   $indicesServer = array('PHP_SELF', 
  //   'argv', 
  //   'argc', 
  //   'GATEWAY_INTERFACE', 
  //   'SERVER_ADDR', 
  //   'SERVER_NAME', 
  //   'SERVER_SOFTWARE', 
  //   'SERVER_PROTOCOL', 
  //   'REQUEST_METHOD', 
  //   'REQUEST_TIME', 
  //   'REQUEST_TIME_FLOAT', 
  //   'QUERY_STRING', 
  //   'DOCUMENT_ROOT', 
  //   'HTTP_ACCEPT', 
  //   'HTTP_ACCEPT_CHARSET', 
  //   'HTTP_ACCEPT_ENCODING', 
  //   'HTTP_ACCEPT_LANGUAGE', 
  //   'HTTP_CONNECTION', 
  //   'HTTP_HOST', 
  //   'HTTP_REFERER', 
  //   'HTTP_USER_AGENT', 
  //   'HTTPS', 
  //   'REMOTE_ADDR', 
  //   'REMOTE_HOST', 
  //   'REMOTE_PORT', 
  //   'REMOTE_USER', 
  //   'REDIRECT_REMOTE_USER', 
  //   'SCRIPT_FILENAME', 
  //   'SERVER_ADMIN', 
  //   'SERVER_PORT', 
  //   'SERVER_SIGNATURE', 
  //   'PATH_TRANSLATED', 
  //   'SCRIPT_NAME', 
  //   'REQUEST_URI', 
  //   'PHP_AUTH_DIGEST', 
  //   'PHP_AUTH_USER', 
  //   'PHP_AUTH_PW', 
  //   'AUTH_TYPE', 
  //   'PATH_INFO', 
  //   'ORIG_PATH_INFO',
  //   'HTTP_CLIENT_IP',
  //   'HTTP_X_FORWARDED_FOR',
  //   'HTTP_X_FORWARDED',
  //   'HTTP_FORWARDED_FOR',
  //   'HTTP_FORWARDED') ; 
    
  //   echo '<table cellpadding="10">' ; 
  //   foreach ($indicesServer as $arg) { 
  //       if (isset($_SERVER[$arg])) { 
  //           echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ; 
  //       } 
  //       else { 
  //           echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ; 
  //       } 
  //   } 
  //   echo '</table>' ;
  // }

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

	//echo Keys::encryptPassword("admin");
	//echo "<br/>";
	//echo Keys::encryptId("admin");
	//die();
  //unset($_SESSION);
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