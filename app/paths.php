<?php

return array(
  
  /* 
  * Path file
  */
  "home" => array(
    "file" => "app/view/application/application.php",
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
    ) 
  
);

?>