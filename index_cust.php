<!-- Update 2022/09/28 18:23 by Kenneth Chieza -->
<?php

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['userID'])) {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Customer Portal</title>
    <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    .bs4-order-tracking {
        margin-bottom: 30px;
        overflow: hidden;
        color: black;
        padding-left: 0px;
        margin-top: 30px
    }

    .bs4-order-tracking li {
        list-style-type: none;
        font-size: 13px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400;
        color: black;
        text-align: center
    }

    .bs4-order-tracking li:first-child:before {
        margin-left: 15px !important;
        padding-left: 11px !important;
        text-align: left !important
    }

    .bs4-order-tracking li:last-child:before {
        margin-right: 5px !important;
        padding-right: 11px !important;
        text-align: right !important
    }

    .bs4-order-tracking li>div {
        color: #fff;
        width: 29px;
        text-align: center;
        line-height: 29px;
        display: block;
        font-size: 12px;
        background: black;
        border-radius: 50%;
        margin: auto
    }

    .bs4-order-tracking li:after {
        content: '';
        width: 150%;
        height: 2px;
        background: black;
        position: absolute;
        left: 0%;
        right: 0%;
        top: 15px;
        z-index: -1
    }

    .bs4-order-tracking li:first-child:after {
        left: 50%
    }

    .bs4-order-tracking li:last-child:after {
        left: 0% !important;
        width: 0% !important
    }

    .bs4-order-tracking li.active {
        font-weight: bold;
        color: #5cb85c
    }

    .bs4-order-tracking li.active>div {
        background: #5cb85c
    }

    .bs4-order-tracking li.active:after {
        background: #5cb85c
    }

    .card-timeline {
        background-color: #fff;
        z-index: 0
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
                        <a class="nav-link active" href="index_cust.php">Home</a>
                    </li>
                    <li class="nav-item px-5">
                        <a class="nav-link" href="HowTo.php">How To</a>
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

    <?php
        require_once("config.php");
        $ID = $_SESSION['userID'];

        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
        $query = "SELECT customer.userID, job.status from customer inner join job on customer.customer_id = job.customer_id where  customer.userID = \"$ID\"";
        $result = mysqli_query($conn, $query) or die("Cannot execute query");

        $r = 0;
        $row = mysqli_fetch_array($result);
        if ($row['status'] = "Not allocated") {
            $processed = "step active";
            $inProgress = "step";
            $complete = "step";
            $collect = "step";
            $status = "Your repair has been processed ";
        } elseif ($row['status'] = "In Process") {
            $processed = "step active";
            $inProgress = "step active";
            $complete = "step";
            $collect = "step";
            $status = "A technician is currently busy with your repair";
        } elseif ($row['status'] = "Completed") {
            $processed = "step active";
            $inProgress = "step active";
            $complete = "step active";
            $collect = "step active";
            $status = "Your repaired device is ready for collection";
        }

        ?>


    <section id="mainContainer">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 p-3">
                    <fieldset>
                        <div class="card card-timeline px-2 border-none">
                            <p class="text-center display-4">Current Repair</p>
                            <ul class="bs4-order-tracking">
                                <li class="<?php echo $processed ?>">
                                    <div><i class="fas fa-user"></i></div> Processed
                                </li>
                                <li class="<?php echo $inProgress ?>">
                                    <div><i class="fa fa-wrench"></i></div> In progress
                                </li>
                                <li class="<?php echo $complete ?>">
                                    <div><i class="fa fa-check"></i></div> Complete
                                </li>
                                <li class="<?php echo $collect ?>">
                                    <div><i class="fa fa-shopping-bag"></i></div> Ready for collection
                                </li>
                            </ul>
                            <h5 class="text-center" style="color:#5cb85c"><?php echo $status ?></h5>

                            <div id="userinf" class="mt-5">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Recived on</th>
                                            <th>Device Name</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Repairied by</th>
                                            <th>Inquire</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $query = "  SELECT * 
                                                    FROM job INNER JOIN devices ON job.device_id = devices.device_id INNER JOIN staff ON job.staff_id=staff.staff_id 
                                                    WHERE  job.customer_id = {$_SESSION['id']} AND status =\"In Process\"";
                                            $result = mysqli_query($conn, $query);

                                            if (mysqli_num_rows($result) == 0) {
                                                echo "<td> No current repairs </td>";
                                            } else {
                                                $row = mysqli_fetch_array($result);
                                                echo "<tr>";
                                                echo "<td>" . $row['start'] . "</td>";
                                                echo "<td>" . $row['name'] . "</td>";
                                                echo "<td>" . $row['type'] . "</td>";
                                                echo "<td>" . $row['description'] . "</td>";
                                                echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                                            }
                                            ?>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="collapse"
                                                data-bs-target="#demo">Make Inquiry</button>
                                            <div id="demo" class="collapse hide">
                                                <fieldset>
                                                    <legend>Send a message to your tech</legend>

                                                    <form action="index_cust.php" method="post">
                                                        <textarea class="form-control" id="techmessage" rows="6"
                                                            name="message"></textarea>
                                                        <input type="submit" value="Send" name="send">
                                                    </form>

                                                    <?php
                                                        if (isset($_REQUEST['send'])) {
                                                            $query3 = "INSERT INTO ctrlintelligence.messages(message, customer_id, staff_id) 
                                                        VALUE ('{$_REQUEST['message']}', '{$_SESSION['id']}', {$row['staff_id']})";
                                                            $result3 = mysqli_query($conn, $query3) or die("message not sent");
                                                        }
                                                        ?>
                                                </fieldset>
                                            </div>
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset><br>

                    <div class="card border-none">
                        <fieldset>
                            <p class="text-center display-4">Repair History</p>
                            <section id="userinf">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Recived on</th>
                                            <th>Device Name</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Repairied by</th>
                                            <th>completed on</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query4 = "  SELECT * 
                                                    FROM job INNER JOIN devices ON job.device_id = devices.device_id INNER JOIN staff ON job.staff_id=staff.staff_id 
                                                    WHERE job.customer_id = {$_SESSION['id']} AND status =\"Completed\"";
                                            $result4 = mysqli_query($conn, $query4);
                                            if (mysqli_num_rows($result4) == 0) {
                                                echo "<td> No completed repairs </td>";
                                            } else {
                                                while ($row = mysqli_fetch_array($result4)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['start'] . "</td>";
                                                    echo "<td>" . $row['name'] . "</td>";
                                                    echo "<td>" . $row['type'] . "</td>";
                                                    echo "<td>" . $row['description'] . "</td>";
                                                    echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                                                    echo "<td>" . $row['end'] . "</td>";
                                                }
                                            }
                                            mysqli_close($conn);
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </section>
                        </fieldset><br>
                    </div>

                </div>
                <div class="col-md-1"></div>
            </div>
            <?php require_once("footer.html"); ?>
        </div>


    </section>
</body>

</html>
<?php
} else {

    header("Location: HowTo.php?error=Incorrect Login Details");

    exit();
}

?>