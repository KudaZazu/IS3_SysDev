<?php
session_start();

if ($_SESSION['accessHOD'] ='yes') {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>Generate Queries</title>
    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 py-4">

        <div class="container-fluid ">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
                <ul class="navbar-nav text-uppercase ">
                    <li class="nav-item px-5">
                        <a class="nav-link active" href="index_tech.php">Home</a>
                    </li>
                    <li class="nav-item px-5">
                        <a class="nav-link" href="newTicket.php">New Ticket</a>
                    </li>
                    <li class="nav-item px-5">
                        <a class="nav-link" href="Job_Staff.php">Jobs</a>
                    </li>

                    <li class="nav-item px-5">
                        <a class="nav-link" href="Orders_Tech.php">Orders</a>
                    </li>
                    <li class="nav-item px-5">
                        <a href="logout.php" class="nav-link"><i class="fa-solid fa-right-from-bracket"> Logout</i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>

    <h2>Generate Query For: </h2>
    <?php
        require_once("config.php");
        $conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h2 style=\'color:red;\'>DATABASE ERROR: unable to validate your credentials!</h2>");
        $query = "SELECT fname,lname,staff_id FROM staff";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($visresult1))
        {
            echo "<a href=\"staffquery.php\">".$row['fname']." ".$row['lname']." ".$row['staff_id']."</a>";
        }
    ?>
    
    </body>

    </html>

    <?php

} else {

    header("Location: Start.html");

    exit();
}

?>