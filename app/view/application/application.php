<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="maincss" type="text/css" />
    <script type="text/javascript" src="jquery"></script>
  </head>
  <body>
    <div id="aaa">AAA</div>test
    <?php 
      $x = DB::query("SELECT * FROM a")->getOne()->get();
    ?>
  </body>
</html>