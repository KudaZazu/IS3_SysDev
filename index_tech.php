<!-- Update 2022/09/01 21:53 by Gosego Menwe -->
<!-- Updating code fot tech my messages sections-->

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
    <title>Ctrl Solution-Home</title>
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


    <section id="mainContainer">
        <div class="container-fluid mt-1">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-8 p-3">
                    <fieldset>
                        <h1 class="text-center display-2 mt-2 mb-5">Repairs Allocated</h1>
                        <div id="userinf">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ticket #</th>
                                        <th>Recived on</th>
                                        <th>Device Name</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Update Parts</th>
                                        <th>Update Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        require_once("config.php");
                                        $ID = $_SESSION['id'];

                                        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                                        $query = "  SELECT * 
                                                    FROM job JOIN devices ON job.device_id = devices.device_id
                                                    WHERE staff_id=$ID AND status =\"In Process\"";
                                        $result = mysqli_query($conn, $query) or die("Cannot execute query");


                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['ticket_number'] . "</td>";
                                            echo "<td>" . $row['start'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['type'] . "</td>";
                                            echo "<td>" . $row['description'] . "</td>";
                                            echo "<td><a href=\"Update_tech.php?ticketNum={$row['ticket_number']}\"> <input type=\"button\" class=\"btn btn-primary\" value=\"Parts Used\"></a> </td>";
                                            echo "<td><a href=\"statusUpdate.php?ticketNum={$row['ticket_number']}&status={$row['status']}\"> <input type=\"button\" class=\"btn btn-primary\" value=\"Complete Repair\"></a> </td>";
                                            echo "</tr>";
                                        }

                                        ?>

                                    <div id="demo" class="collapse hide">
                                        <fieldset>
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
                                        </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-1"></div>

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
                                        $query1 = "SELECT * FROM messages where staff_id={$ID} and customer_id=\"2\"";
                                        $result1 = mysqli_query($conn, $query1) or die("message not sent");

                                        while ($row = mysqli_fetch_array($result1)) {
                                            echo "<p>" . $row['message'] . "</p><br";
                                        }
                                        ?>
                                        <a href="delete1.php"><input type="button" class="btn btn-success"
                                        value="Delete All"><a>
                                </div>
                                
                                        <hr>
                            </section><br>
                        </fieldset>
                    </aside>
                </div>

            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-12"></div>
        <div class="col-12"></div>
    </div>

    <?php require_once("footer.html") ?>

</body>

</html>

<?php

} else {

    header("Location: Start.html");

    exit();
}
?>