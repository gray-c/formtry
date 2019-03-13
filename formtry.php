<!doctype html>
<html>
<head>
<title>form</title>
</head>
<body>
<?php
session_start();
$_SESSION['message']='';
//connect to mysqli database
$mysqli= new mysqli('localhost:3306','root','','sloting');
//form has to be submitted
if(isset($_POST["submit"])){
  //real escape string used to avoid detail in cases used
  $sid= $mysqli->real_escape_string($_POST['sid']);
  $fname= $mysqli->real_escape_string($_POST['fname']);
  $lname= $mysqli->real_escape_string($_POST['lname']);
  $address= $mysqli->real_escape_string($_POST['address']);
  

    $_SESSION['sid']=$sid;
    $_SESSION['fname']=$fname;
    $_SESSION['lname']=$lname;
    $_SESSION['address']=$address;
    $_SESSION['slot']=$slot;

    
     $slot=$_POST["slot"];
    //specify all column names inserting into database
    $sql="INSERT INTO students (sid,fname,lname,address,slot)"
            . "VALUES ('$sid','$fname','$lname','$address','$slot')";
            //if the query is successful we redirect to welcome page
         if ($mysqli->query($sql)=== true) {
           $_SESSION['message']="registeration of student is succesful. added to database!";
           header("location:welcometry.php");
         }  
         else {
           $_SESSION['message']= "user could not be added to the database!";
         } 
         
}
?>
    <link rel="stylesheet" href="formtry.css" type="text/css">
<div class="body-content">
  <div class="module">
    <h1><b>fill in the form to book a slot</b></h1>
    <form class="form" action="formtry.php" method="post" enctype="multipart/form-data" autocomplete="off">

        First Name:<br> 
        <input type="text" placeholder="First Name" name="fname" required><br>
        Last Name:<br>
        <input type="text" placeholder="Last Name" name="lname"required><br>
        Student ID:<br>
        <input type="text"placeholder="Admission number" name="sid"required><br>
        email address:<br>
        <input type="email"placeholder="...@something.com" name="address"required><br>
        book a space in one of the time slots:
        <div class="custom-select" style="width:200px;">
          <select name="slot">
          <option value="">tap to choose</option>
            <option value="8am">class 8am</option>
            <option value="10am">class 10am</option>
            <option value="2pm">class 2pm</option>
            <option value="4pm">class 4pm</option>
          </select>
        </div>
    
        <input type="submit" name="submit" value="register" class="btn btn-primary">
        <input type="reset" name="reset"class="btn btn-primary">
    </form>
    
    
    <script>
        var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
    </script>

</body>
</html>
