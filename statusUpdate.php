<?php

//Update 2022/09/28 09.23 by Gosego Menwe -->
//Update 2022/10/01 10:00 by Kenneth Chieza -->

session_start();

if (isset($_SESSION['id'])) {
    require_once('config.php');
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("NO");

    //if (isset($_REQUEST['submit'])){
    if ($_REQUEST['status'] == "In Process") {
        $date = date("Y-m-d H:i:s");
        $query2 = "UPDATE job SET status = \"Completed\", end = '$date' where ticket_number={$_REQUEST['ticketNum']} ";
        $R = "INSERT INTO messages(message,customer_id,staff_id) Values(\"Job Number {$_REQUEST['ticketNum']} has been completed \",{$_SESSION['id']},\"2\")";
        $result2 = mysqli_query($conn, $query2) or die("Its me on line 162");
        $result1 = mysqli_query($conn, $R) or die("Its me on line 162");

        mysqli_close($conn);


        header("Location:index_tech.php");
    } else {
        header("Location:index_tech.php?error=Job already completed");
    }
} else {

    header("Location: login_staff.php?error=Session ended/ Does not exist");

    exit();
}