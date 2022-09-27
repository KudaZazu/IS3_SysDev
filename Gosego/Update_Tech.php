!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Start.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="nav.css">
    <title>Crtl Intelligence- Update Repair</title>
</head>


<body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/CI.png" alt="Logo" style="width:40px;" class="rounded-pill">
            </a>
        </div>
        <a href="#" class="nav-item">Home</a>
                <a href="newTicket.php" class="nav-item">New Ticket</a>
                <a href="Jobs_Staff.php" class="nav-item">Jobs</a>
                <a href="#" class="nav-item">Update </a>
                <a href="Order.php" class="nav-item">Order </a>
                <a href="#" class="nav-item"><i class="fa-circle-question rounded-pill"></i></a>
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

                            $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                    
                            $query1= "SELECT * FROM job INNER JOIN staff on job.staff_id= staff.staff_id INNER JOIN devices on job.device_id=devices.device_id  WHERE staff.userID=\"$ID\" ";
                            $result1= mysqli_query($conn, $query1);
                    
                            while($row= mysqli_fetch_array($result1)){
                             echo "<button type=\submit\" name=\"ticket\"><li>".$row['ticket_number']."</li></button>";
                            }

                            $row = mysqli_fetch_array($result1);
                            $dName= $row['ticket_number'];
                            ?>

                           
                            </ul>
                        </div>
                        <div class="mb-1">
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
            </div>
            <div class="col-sm-5"></div>
        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="mb-1 mt-1">
                    <?php
                        $query="SELECT * FROM parts";
                        $result = mysqli_query($conn,$query);

                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            echo "<td>" . $row['name']. "   <input type =\"number\" name=\"numParts\"></td>";
                            echo "</tr>";
                        }
                        mysqli_close($conn);
                    ?>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <input type="Submit" name="submit" value="Update Repair" class="btn btn-success">
            </div>
            <div class="col-sm-3"></div>
        </div>


        </form>
    </div>
    <?php
    if (isset($_REQUEST['submit'])) {

        //requestor values
        $fname = $_REQUEST['Fname'];
        $lname = $_REQUEST['Lname'];
        $userID = $_POST['student'];
        $email = $userID . "@woodstreet.ac.za";
        $contact = $_REQUEST['number'];

        
        //device values
        $devicename = $_REQUEST['devicename'];
        $devicenumber = $_REQUEST['devicenumber'];
        $type = $_REQUEST['type'];
        $descrption = $_REQUEST['descrption'];
        $mouse = $_REQUEST['mouse'];
        $bag = $_REQUEST['bag'];
        $charger = $_REQUEST['charger'];


        include('index_cust.php');
        //connect to database
        require_once("config.php");
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("<h1 style=color:red;> Could not connect to database! </h1>");

        //query instruction
        $query = "INSERT INTO customer(fname, lname, contact, email, userID)
                VALUE('$fname','$lname','$contact','$email','$userID')";
        $result = mysqli_query($conn, $query)
            or die("<h1 style=color:red;> Could not execute query! </h1>");

            //insert values from form here
            // Use password_hash() function to
            // create a password hash
            $hash_default_salt = password_hash($pwd,
                    PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
            
            $query1 = "INSERT INTO users(userID, saltedPassword) VALUES (\"$userID\", \"$hash_default_salt\")";
            $result1 = mysqli_query($conn,$query1) or die("<h1 style=color:red;> Could not execute query! </h1>");
        mysqli_close($conn);
    }

        
    ?>

</body>

</html>