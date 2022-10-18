<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['userID'])) {
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="SignUp.css" type="text/css">

    <title>Staff_Allocate</title>
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





    <div class="container-fluid">

        <div class="m-5">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <h1 class="display-5">Allocate Technician</h1>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-sm-2"></div>
            <div class="col-sm-5">
                <h3>Job Information:</h3>
            </div>
            <div class="col-sm-5"></div>
        </div>
        <div class="row">
            <div class="col">
                <form action="edit.php" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                        <div class="mb-1 mt-1">
                            <!--<div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                    Ticket Number
                                </button>
                                <ul class="dropdown-menu">
                                    <?php
                                        require_once("config.php");

                                        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");

                                        $query1 = "SELECT * from job where status =\"Not allocated\" and ticket_number ={$_REQUEST['id']} ";
                                        $result1 = mysqli_query($conn, $query1);

                                        while ($row = mysqli_fetch_array($result1)) {
                                            echo "<li><a class=\"dropdown-item\" >" . $row['ticket_number'] . " : " . $row['description'] . "</a></li>";
                                            $_SESSION['ticket'] = $row['ticket_number'];
                                        }


                                        ?>
                                </ul>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>-->

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
                <?php if (isset($_GET['conf'])) { ?>
                <p class="conf"><?php echo $_GET['conf']; ?></p>
                <?php } ?>


                <?php if (isset($_GET['error'])) { ?>

                <p class="error"><?php echo $_GET['error']; ?></p>

                <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="text-center"></div>
            <div class="mb-1 mt-1">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Technician Name</th>
                            <th>Staff ID</th>
                            <th>Number of Jobs</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        $_SESSION['ticket']= $_REQUEST['id'];
                            $query = "SELECT distinct fname,lname, staff.staff_id, (select count(job.staff_id)  from job where job.staff_id = staff.staff_id and status != \"Completed\") AS Jobs from staff,job 
                            where staff.role=\"Tech\" and 'Jobs' < 5 ";
                            $result = mysqli_query($conn, $query) or die("Cannot execute query");

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                                echo "<td>" . $row['staff_id'] . "</td>";
                                echo "<td>" . $row['Jobs'] . "</td>";
                                echo "<td><a href= \"edit.php?id=" . $row['staff_id'] . "\"><input type=\"button\" value=\"Select\" class=\"btn btn-primary\"></a> </td>";
                                echo "</tr>";
                            }
                            mysqli_close($conn);
                            ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <!--<input type="Submit" name="submit" value="Allocate" class="btn btn-info">-->
        </div>

    </div>
    </form>
    </div>
</body>
<?php require_once("footer.html"); ?>

</html>

<?php
} else {

    header("Location: login_staff.php?error=Session ended/ Does not exist");
    exit();
}
?>