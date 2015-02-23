<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="jquery"></script>
  </head>
  <body>
    test
    <?php 
      $x = DB::query("SELECT * FROM a")->getOne()->get();
    ?>
  </body>
</html>