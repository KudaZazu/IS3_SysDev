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
    <link rel="stylesheet" href="Start.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Customer Portal</title>
    <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/CI.png" alt="Logo" style="width:40px;" class="rounded-pill">
            </a>
        </div>
        <a href=# class="nav-item">Home</a>
        <a href="HowTo.html" class="nav-item">How To</a>
        <a href="Find_Us.html" class="nav-item">Find Us</a>
        <a href="#" class="nav-item">Book Consultation</a>
        <a href="logout.php" class="nav-item"><i class="fa-circle-question rounded-pill"></i></a>
    </nav>

    <?php
        require_once("config.php");
        $ID = $_SESSION['userID'];

        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
        $query = "SELECT customer.userID, job.status from customer inner join job on customer.customer_id = job.customer_id where  customer.userID = \"$ID\" ";
        $result = mysqli_query($conn, $query) or die("Cannot execute query");

        $r = 0;
        $row = mysqli_fetch_array($result);
        if ($row['status'] = "Not allocated") {
            $r = 25;
        } elseif ($row['status'] = "in progress") {
            $r = 50;
        } elseif ($row['status'] = "complete") {
            $r = 100;
        }

        ?>

    <section id="mainContainer">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-8 p-3">
                    <fieldset>
                        <p class="text-center display-5">Repair progress</p>
                        <div class="progress">
                            <div class="progress-bar bg-success progress-bar-animated"
                                style="width:<?php echo $r . "%"; ?>"></div>
                        </div><br>
                    </fieldset>

                    <fieldset>
                        <legend>Current Repair</legend>
                        <section id="userinf">
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
                                        require_once("config.php");

                                        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                                        $query = "SELECT * FROM job INNER JOIN devices ON job.device_id = devices.device_id INNER JOIN staff ON job.staff_id=staff.staff_id WHERE  job.customer_id = {$_SESSION['id']} ";
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

                                                <form action="new.php" method="post">
                                                    <textarea class="form-control" id="techmessage" rows="6"
                                                        name="message"></textarea>
                                                    <input type="submit" value="Send" name="send">
                                                </form>

                                                <?php
                                                    if (isset($_REQUEST['send'])) {
                                                        $query = "INSERT INTO ctrlintelligence.messages(message, customer_id, staff_id) 
                                                        VALUE ('{$_REQUEST['message']}', '{$_SESSION['id']}', {$row['staff_id']})";
                                                        $result = mysqli_query($conn, $query) or die("message not sent");
                                                    }
                                                    ?>
                                            </fieldset>
                                        </div>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>
                    </fieldset><br>
                    <fieldset>
                        <legend>Completed Repairs</legend>
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
                                        $query = "SELECT * FROM job INNER JOIN devices ON job.device_id = devices.device_id INNER JOIN staff ON job.staff_id=staff.staff_id WHERE job.customer_id = {$_SESSION['id']} AND status =\"Complete\"";
                                        $result = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($result) == 0) {
                                            echo "<td> No completed repairs </td>";
                                        } else {
                                            while ($row = mysqli_fetch_array($result)) {
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
                <div class="col-md-3 p-5">
                    <aside style="float: left;">

                        <fieldset style="border:2px black ;">
                            <?php

                                echo "<legend>$ID</legend>";
                                ?>
                            <section id="notif">
                                <button type="button" class="btn btn-primary" data-bs-toggle="collapse"
                                    data-bs-target="#demo1">My Messages</button>
                                <div id="demo1" class="collapse show">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                    veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </div>
                            </section><br>
                        </fieldset>
                    </aside>
                </div>
            </div>
        </div>


    </section>
</body>

</html>
<?php
} else {

    header("Location: HowTo.html?error=Incorrect Login Details");

    exit();
}

?>