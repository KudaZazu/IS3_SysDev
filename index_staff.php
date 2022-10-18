<!-- Update 2022/09/28 13:32 by Kenneth Chieza 
added .php extension to Jobs_Staff href in navbar
-->
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
    <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Ctrl Solution-Index</title>
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
                <a class="nav-link active" href="index_staff.php">Home</a>
            </li>
            <li class="nav-item px-5">
                <a class="nav-link" href="newTicket.php">New Ticket</a>
            </li>
            <li class="nav-item px-5">
                <a class="nav-link" href="Job_Staff.php">Jobs</a>
            </li>
            <li class="nav-item px-5">
                <a href="logout.php" class="nav-link"><i class="fa-solid fa-right-from-bracket"> Logout</i></a>
            </li>
        </ul>
    </div>
</div>
</nav>


    <section id="mainContainer">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-8 p-3">
                    <section id="newJobs">
                        <fieldset>
                            <legend>Unallocated Jobs</legend>
                            <table class="table">
                                <tr>
                                    <th>Ticket #</th>
                                    <th>Recived on</th>
                                    <th>Device Name</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Allocate</th>
                                </tr>
                                <tbody>

                                    <?php
                                        require_once("config.php");

                                        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                                        $query = "SELECT * 
                                        FROM job JOIN devices ON job.device_id=devices.device_id
                                        WHERE job.status= \"Not allocated\"";
                                        $result = mysqli_query($conn, $query) or die("Cannot execute query");

                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['ticket_number'] . "</td>";
                                            echo "<td>" . $row['start'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['type'] . "</td>";
                                            echo "<td>" . $row['description'] . "</td>";
                                            echo "<td><a href=\"Allocate.php?id={$row['ticket_number']}\">Allocate</a></td>";
                                            echo "</tr>";
                                        }

                                        ?>
                                </tbody>
                            </table>
                        </fieldset>
                    </section><br>

                    <section id="jobHistory">
                        <fieldset>
                            <legend>Inquiries</legend>
                            <section id="userinf">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Ticket #</th>
                                            <th>From</th>
                                            <th>email</th>
                                            <th>Inquiry</th>
                                            <th>Delete</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "  SELECT * 
                                            FROM ctrlintelligence.messages 
                                            JOIN ctrlintelligence.job ON messages.staff_id = job.staff_id AND messages.customer_id = job.customer_id
                                            JOIN ctrlintelligence.customer ON messages.customer_id = customer.customer_id";
                                            $result = mysqli_query($conn, $query) or die("Cannot execute query");
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['ticket_number'] . "</td>";
                                                echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                                                echo "<td>" . $row['email'] . "</td>";
                                                echo "<td>" . $row['message'] . "</td>";
                                                echo "<td><a href=\"deleteInquiry.php?id={$row['idmessages']}\">I have replied to this inquiry</a></td>";
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </section>
                        </fieldset>
                         </section>                      
                </div>
                <div class="col-md-2 p-5">
                    <aside style="float: left;">
                        <fieldset style="border:2px black ;">
                            <?php
                                echo "<legend>{$_SESSION['userID']}</legend>";
                                ?>
                            <section id="notif">
                                <button type="button" class="btn btn-primary" data-bs-toggle="collapse"
                                    data-bs-target="#demo1">My Notification</button>
                                <div id="demo1" class="collapse show">
                                    <?php
                                    $query1 = "SELECT * FROM messages where staff_id={$_SESSION['id']} ";
                                    $result1 = mysqli_query($conn, $query1) or die("message not sent");

                                    while($row = mysqli_fetch_array($result1)){
                                     echo "<p>". $row['message']."</p><br";
                                    }
                                     mysqli_close($conn);?>
                                </div>
                                <a href="delete1.php"><input type="button" class="btn btn-success"
                                        value="Delete All"><a>
                                        <hr>
                            </section><br>
                        </fieldset>
                    </aside>
                </div>
                 
            </div>
        </div>
       

    </section>
    <?php require_once("footer.html"); ?>

</body>

</html>

<?php

} else {

    header("Location: Start.html");

    exit();
}

?>