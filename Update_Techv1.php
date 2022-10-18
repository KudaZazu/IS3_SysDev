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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="SignUp.css" type="text/css">
    <title>Crtl Intelligence- Update Repair</title>
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
                        <a class="nav-link" href="index_tech.php">Home</a>
                    </li>
                    <li class="nav-item px-5">
                        <a class="nav-link" href="newTicket.php">New Ticket</a>
                    </li>
                    <li class="nav-item px-5">
                        <a class="nav-link" href="Job_Staff.php">Jobs</a>
                    </li>
                    <li class="nav-item px-5">
                        <a class="nav-link active" href="Update_Tech.php">Update</a>
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
                            <input type="text" id="studentid" name="student" class="form-control">
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
                    <table class="table">
                        <tr>
                            <th>Part</th>
                            <th>/</th>
                        </tr>

                        <tbody>

                            <?php
                        $query="SELECT * FROM parts_stock";
                        $result = mysqli_query($conn,$query);
                        

                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            $pID= $row['part_id'];
                            echo "<td>" . $row['name'];
                            $quan=$row['quantity'];
                            echo "<td> <a href=\"editParts.php?id=$pID\"><input type=\"button\" class=\"btn btn-primary\" name=\"bParts\" value=\"edit\"></a></td>";
                            echo "</tr>";
                        }

                        mysqli_close($conn);
                        
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input type="button" name="submit" value="Update Repair" class="btn btn-success text-center">
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