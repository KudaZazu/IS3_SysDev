<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['userID'])) {

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ctrl Solution</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }
    </style>
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

    <div style="margin-left: 35%;">
        <a href="visuals.php">
            <button type="submit" class="btn btn-success w-50">Department Overview</button>
        </a>
        <br><br>
        <a href="genquery.php">
            <button type="submit" class="btn btn-success w-50">Generate reports</button>
        </a>
    </div>

</body>

</html>
<?php

} else {

    header("Location: Start.html");

    exit();
}

?>