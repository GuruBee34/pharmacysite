<?php

$uname1 = $_POST['uname'];
$upswd1 = $_POST['upswd'];




if (!empty($uname1) || !empty($upswd1) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "sevalaya";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT uname From login_info Where uname = ? Limit 1";
  $INSERT = "INSERT Into login_info (uname ,upswd )values(?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $uname);
     $stmt->execute();
     $stmt->bind_result($uname);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ss", $uname,$upswd);
      $stmt->execute();
      echo "You loged in successfully";
     } else {
      echo "The user name or password is incorrect";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>