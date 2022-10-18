<?php

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['userID'])) {

    require_once('config.php');
    $ID = $_SESSION['id'];

    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
    $query = "DELETE FROM messages where staff_id=$ID ";
    $result = mysqli_query($conn, $query) or die("Cannot execute query");
    mysqli_close($conn);
    if ($ID== 2){
    header("Location: index_staff.php");
} else{ header("Location: index_tech.php");}
    

} else {

    header("Location: login_staff.php?error=Session ended/ Does not exist");

    exit();
}
?>