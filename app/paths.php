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
    )
  
);

?>