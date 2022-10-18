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
    <link href="Start.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Ctrl Solution-HOD</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/CI.png" alt="Logo" style="width:40px;" class="rounded-pill">
            </a>
        </div>
        <a href="reports1.php" class="nav-item">Home</a>
        <a href="newTicket.php" class="nav-item">Admin</a>
        <a href="Job_Staff.php" class="nav-item">Techs</a>
        <a href="Allocate.php" class="nav-item">Allocate</a>
        <a href="reports1.php" class="nav-item">Reports</a>
        <a href="logout.php" class="nav-item"><i class="fa-question rounded-pill"></i></a>
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
                                            echo "<td> Allocate </td>";
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
                    <br>
                    <input type="button" name="submitt" value="Create New Ticket" class="btn btn-success" width="100%"
                        onclick="newTicket.php">
                </div>

                <div class="col-md-4 p-3">
                    <fieldset>
                        <section id="notifs">
                            <button type="button" class="btn btn-primary" data-bs-toggle="collapse"
                                data-bs-target="#demo">My Notifications</button>
                            <div id="demo" class="collapse show">
                                <!-- Remember to do the messages-->
                                <p>hdujfvvvvndnnndndsndsndndmmcds</p>
                            </div>
                            <div id="date">
                                <script>
                                document.getElementById("current_date").innerHTML = Date();
                                </script>
                            </div>
                        </section>
                    </fieldset>
                </div>
            </div>
        </div>

    </section>
</body>

</html>

<?php

} else {

    header("Location: login_staff.php");

    exit();
}

?>