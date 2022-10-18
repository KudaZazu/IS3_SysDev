<?php
//connect to database
require_once("configK.php");
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
    or die("<h1 style=color:red;> Could not connect to database! </h1>");

$userID = $_REQUEST['student'];

if (isset($_REQUEST['submit'])) {
    //requestor values
    $fname = $_REQUEST['Fname'];
    $lname = $_REQUEST['Lname'];
    $email = $userID . "@woodstreet.ac.za";
    $contact = $_REQUEST['number'];

    //query instruction
    $query = "INSERT INTO customer(fname, lname, contact, email, userID)
                VALUE('$fname','$lname','$contact','$email','$userID')";
    $result = mysqli_query($conn, $query)
        or die("<h1 style=color:red;> Could not execute query! </h1>" . mysqli_error($conn));

    require_once("device.php");
}

if (isset($_REQUEST['submitt'])) {
    require_once("device.php");
}