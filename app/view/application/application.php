<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="jquery"></script>
  </head>
  <body>
    test
    <?php 
      DB::query("SELECT * FROM a");
    ?>
  </body>
</html>