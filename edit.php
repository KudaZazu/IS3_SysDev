<?php

//Update 2022/09/01 19:44 by Gosego Menwe -->
//Yea


session_start();

if (isset($_SESSION['ticket']) /*&& isset($_GET['staffID']) */) {
    require_once('config.php');
   

$conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
$Q= "UPDATE job SET staff_id={$_GET['id']}, status=\"In Process\" WHERE ticket_number={$_SESSION['ticket']} ";
$R = "INSERT INTO messages(message,customer_id,staff_id) Values(\"You have been allocted a new ticket {$_SESSION['ticket']}\",{$_SESSION['id']},{$_GET['id']})";
$result1 = mysqli_query($conn,$Q) or die("<h1 style=color:red;> Could not execute query! </h1>");
$result2 = mysqli_query($conn,$R) or die("<h1 style=color:red;> Could not execute queryR! </h1>");
mysqli_close($conn);  

header("Location:Allocate.php?conf=Successfully allocated&id={$_SESSION['ticket']}");

}else{

    header("Location: login_staff.php?error=Session ended/ Does not exist");
    
    exit();
    
  }
?>