<html><head>
<link rel="stylesheet" href="formtry.css">
<style type="text/css">
table {
  border-collapse:collapse;
  background-color: solid transparent;
  width:100%;
  color: #66d8fc;
  font-family: monospace;
  font-size: 25px;
  text-align: left;
}
th {
  background-color: rgba(30, 144, 255);
  color: white;
}
</style>
</head>
<body>
<?php session_start();?> 
<div class="body content">
    <div class="welcome">
        <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
         welcome <span class="user"><?= $_SESSION['fname']?></span>
         
        <table> 
        <tr>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        </tr>
         <?php
         //connect to database
         $conn=mysqli_connect("localhost","root","","sloting");
         if ($conn-> connect_error){
             die("connection failed:".$conn-> connect_error);
         }
         //sql to show student ID, NAMES and email
         $sql= "SELECT sid, fname, lname, address from students";
         $result =$conn->query($sql); //$result=mysqli_result object
         //for code to be executed you must have atleast one row 
         if ($result-> num_rows>0){
             //a while loop is run as long as condition remains true
             while($row = $result-> fetch_assoc()){
                 //only one row is executed per time
                 echo "<tr><td>".$row["sid"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."
                 </td><td>".$row["address"]."</td><tr>";
             }
             echo "</table>";
         }
         else {
             echo "0 result";
            }
            //remove database connection
            $conn-> close();
         ?>
         </table>
             </div>
             </body>
</html>
