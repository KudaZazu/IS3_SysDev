<!-- Update 2022/09/28 09.23 by Gosego Menwe -->
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
        <title>Ctrl Solution-Staff-Jobs</title>
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
            <a href="index_tech.php" class="nav-item">Home</a>
        <a href="newTicket.php" class="nav-item">New Ticket</a>
        <a href="Job_Staff.php" class="nav-item">Jobs</a>
        <a href="Update_Tech.php" class="nav-item">Update</a>
        <a href="Orders_Tech.php" class="nav-item">Orders</a>
        <a href="logout.php" class="nav-item"><i class="fa-circle-question rounded-pill"></i></a>
        </nav>

        
        <section id="mainSection">
            <h1 class="Display-2 text-center">Current Jobs</h1><br>

            <table class="table">
                <thead>
                  <tr>
                    <th>Device Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Tech</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
            <?php
                require_once("config.php");

                $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                $query= "SELECT * FROM job INNER JOIN devices ON job.device_id = devices.device_id INNER JOIN staff ON job.staff_id=staff.staff_id WHERE  status =\"In Process\" ";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['name']. "</td>";
                    echo "<td>" . $row['type']. "</td>";
                    echo "<td>" . $row['description']. "</td>";
                    echo "<td>" . $row['fname']. " ". $row['lname']. "</td>";
                    echo "<td>" . $row['status']. "</td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
            ?>

          
                  
                </tbody>
              </table>

        </section>
    </body>
    </html>
<?php
}else{

header("Location: login_staff.php?error=Session ended/ Does not exist");

exit();

}
?>