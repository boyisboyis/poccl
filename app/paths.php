<?php

return array(
  
  /* 
  * Path file
  */
  "home" => array(
    "file" => "app/view/application/application.php",
    "type" => "require"
  ),
  "managenews"=> array(
    "file" => "app/controller/manageNews.php",
    "type" => "require"
  ),
  "search_options" => array(
    "file" => "app/controller/searchOptions.php",
    "type" => "require"
  ),
  "report_options" => array(
    "file" => "app/controller/reportOptions.php",
    "type" => "require"
  ),
  "login" => array(
    "file" => "app/view/login/login.php",
    "type" => "require"
  ),
  "login_controller" => array(
    "file" => "app/controller/loginAdmin.php",
    "type" => "require"
  ),
  
  /*
   *Javascript file
  */
  
  "jquery" => array(
      "file" => "lib/asset/js/jquery.min.js",
      "type" => "file_get_contents"
    ),
  "jquery-ui" => array(
      "file" => "lib/asset/js/jquery-ui.js",
      "type" => "file_get_contents"
    ),
  "applicationjs" => array(
      "file" => "app/asset/js/application.js",
      "type" => "file_get_contents"
   ),
   "loginjs" => array(
    "file" => "app/asset/js/login.js",
    "type" => "file_get_contents"
  ),
  "angular" => array(
    "file" => "lib/asset/js/angular.min.js",
    "type" => "file_get_contents"
  ),
    
    /*
    * CSS file
    */
    "maincss" => array(
      "file" => "lib/asset/css/main.css",
      "header" => "text/css",
      "type" => "file_get_contents"
    ),
    "applicationcss" => array(
      "file" => "app/asset/css/application.css",
      "header" => "text/css",
      "type" => "file_get_contents"
    ),
    "fontcss" => array(
      "file" => "lib/asset/css/font-awesome.min.css",
      "header" => "text/css",
      "type" => "file_get_contents"
    ),
    "logincss" => array(
      "file" => "app/asset/css/login.css",
      "header" => "text/css",
      "type" => "file_get_contents"
    )
  
);

?>