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
    <link rel="stylesheet" href="Start.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="nav.css" type="text/css">
    <link rel="stylesheet" href="SignUp.css" type="text/css">
    <title>Crtl Intelligence- Update Repair</title>
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

    <div class="container-fluid">

        <div class="m-5">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <h1 class="display-5">Update Repair Job</h1>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-5">
                <h3>Job Information:</h3>
            </div>
            <div class="col-sm-5"></div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form action="Update_Tech.php" method="post" enctype="multipart/form-data">
                    <div id="center">
                        <div class="mb-1 mt-1">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            Ticket Number
                            </button>
                            <ul class="dropdown-menu">
                            <?php
                            require_once("config.php");
                            $ID= $_SESSION['id'];

                            $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                    
                            $query1= "SELECT * FROM job  INNER JOIN devices on job.device_id=devices.device_id  WHERE job.staff_id=\"$ID\" ";
                            $result1= mysqli_query($conn, $query1);
                            //var_dump($result1);
                    
                            while($row= mysqli_fetch_array($result1)){
                             echo "<li><a class=\"dropdown-item\" href=\"#\">".$row['ticket_number']."</a></li>";
                            }

                            ?>

                           
                            </ul>
                        </div>
                        <div class="mb-1">
                            <!--  value="<//?php echo $row['name'];?>" -->
                            <label for="Lnameid" class="form-label">Device Name:</label>
                            <input type="text" id="Lnameid" name="Lname" class="form-control">
                        </div>
                        <div class="mb-1">
                            <label for="studentid" class="form-label">Device Type:</label>
                            <input type="text" id="studentid" name="student"  class="form-control">
                        </div>
                    </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <hr>
            </div>
            <div class="c0l-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-5">
                <h3>Equipment used:</h3>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>

                <?php } ?>
            </div>
            <div class="col-sm-5"></div>
        </div>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col">
                <div class="mb-1 mt-1">
                    <?php
                        $query="SELECT * FROM parts";
                        $result = mysqli_query($conn,$query);

                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            $pID= $row['part_id'];
                            $_SESSION['partID'] = $pID;
                            $quan=$row['quantity'];
                            echo "<td>" . $row['name']. "&nbsp <a href=\"editParts.php\"><input type=\"button\" name=\"bParts\" value=\"edit\"></a></td>";
                            echo "</tr>";
                        }
                        
                    ?>
                </div>
    </div>

    <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <input type="button" name="submit" value="Update Repair" class="btn btn-success">
            </div>
            <div class="col-sm-3"></div>

    

    

</body>

</html>

<?php

}else{

    header("Location: login_staff.php?error=Session ended/ Does not exist");

    exit();

}
?>