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
                <?php if (isset($_GET['conf'])) { ?>
                <p class="conf"><?php echo $_GET['conf']; ?></p>

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
                            <th></th>
                        </tr>

                        <tbody>

                            <?php
                             require_once("config.php");
                             $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                        $query="SELECT * FROM parts_stock";
                        $result = mysqli_query($conn,$query);
                        $_SESSION['ticket']=$_REQUEST['ticketNum'];

                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            $pID= $row['part_id'];
                            echo "<td>" . $row['name'];
                            $quan=$row['quantity'];
                            echo "<td> <a href=\"editParts.php?id={$pID}\"><input type=\"button\" class=\"btn btn-primary\" name=\"bParts\" value=\"Edit\"></a></td>";
                            echo "</tr>";
                        }
                        

                        mysqli_close($conn);
                        
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>

</body>
<div class="col-md-1"></div>
            </div>
            <?php require_once("footer.html"); ?>
        </div>

</html>

<?php

}else{

    header("Location: login_staff.php?error=Session ended/ Does not exist");

    exit();

}
?>