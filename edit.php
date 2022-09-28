<?php
require_once('config.php');

$id= $_REQUEST['id'];
$ticket = $_GET['ticket'];

$conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
$Q= "INSERT INTO staffjobs(staff_id, ticketnumber) VALUES ($id,$ticket)";
$result1 = mysqli_query($conn,$Q) or die("<h1 style=color:red;> Could not execute query! </h1>");
mysqli_close($conn);
?>