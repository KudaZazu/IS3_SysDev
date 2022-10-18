<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How To</title>
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
                        <a class="nav-link" href="index_cust.php">Home</a>
                    </li>
                    <li class="nav-item px-5">
                        <a class="nav-link active" href="HowTo.php">How To</a>
                    </li>
                    <li class="nav-item px-5">
                        <a class="nav-link" href="Find_Us.html">Find Us</a>
                    </li>
                    <li class="nav-item px-5">
                        <a href="logout.php" class="nav-link"><i class="fa-solid fa-right-from-bracket"> Logout</i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-3">
        <h1 class="text-center display-2 mt-5 mb-3">How to get your device repaired</h1>

        <div class="row mt-5">
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="images\Backup.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Back Up Data</h5>
                        <p class="card-text">Back up your device data if possible. Your device data may be lost or
                            corrupted
                            during the repair.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="images\dropoff.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Drop off Device</h5>
                        <p class="card-text">Drop off your device at the IT department. An account will be created for
                            first time customers.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="images\loginv2.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Check Repair Status</h5>
                        <p class="card-text">Logon to the customer portal to check for updates or to make inquiries.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="images\pickup2.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Collect Device</h5>
                        <p class="card-text">Collect your device once you have been notified that
                            your repair is complete.</p>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (!isset($_SESSION['acesssCust'])) {
            echo
            "<button type=\"button\" class=\"btn btn-success d-table w-100 my-5 mx-auto btn-lg\" data-bs-toggle=\"modal\"
            data-bs-target=\"#ModalForm\">
            Login
            </button>";
        }

        ?>

        <!-- Modal Form -->
        <div class="modal fade" id="ModalForm" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Login Form -->
                    <form action="Login.php" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title">Login</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Username">Username<span class="text-danger">*</span></label>
                                <input type="text" name="uname" class="form-control" id="Username"
                                    placeholder="Enter Username">
                            </div>

                            <div class="mb-3">
                                <label for="Password">Password<span class="text-danger">*</span></label>
                                <input type="password" name="psw" class="form-control" id="Password"
                                    placeholder="Enter Password">
                            </div>
                            <div class="mb-3">
                                <a href="resetcust.html" class="float-end">Forgot Password</a>
                            </div>
                        </div>
                        <div class=modal-footer pt-4>
                            <button type="submit" class="btn btn-success mx-auto w-100">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <?php require_once("footer.html") ?>
</body>

</html>