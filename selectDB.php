<html>
   <head>
      <title>Connecting MySQLi Server</title>
   </head>

   <body>
      <?php
         $dbhost = 'localhost:3306';
         $dbuser = 'root';
         $dbpass = '';
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
   
         if(! $conn ) {
            die ('Connected failure<br>'.mysqli_error());
         }
         echo 'Connected successfully<br>';
          $sql = "ALTER TABLE `students`  ADD `choices` VARCHAR(10) 
          NOT NULL  AFTER `address`";
         mysqli_select_db( "sloting" );
        
         $retval=mysqli_query($sql,$conn);
         if (!$retval){
            die('column couldnot be added');
         }
         echo "column added";
        
         mysqli_close($conn);
      ?>
   </body>
</html>