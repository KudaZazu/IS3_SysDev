<!-- Update 2022/09/30 12:35 by Gosego Menwe -->
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
    <title>Ctrl Solution-Order Parts</title>
    <link rel="stylesheet" href="SignUp.css" type="text/css">
    <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
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
                        <a class="nav-link active" href="Orders_Tech.php">Orders</a>
                    </li>
                    <li class="nav-item px-5">
                        <a href="logout.php" class="nav-link"><i class="fa-solid fa-right-from-bracket"> Logout</i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section id="mainSection">
        <h1 class="Display-2 text-center">Parts</h1><br>
        <?php if (isset($_GET['conf'])) { ?>

        <p class="conf"><?php echo $_GET['conf']; ?></p>

        <?php } ?>

        <?php if (isset($_GET['error'])) { ?>

        <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Part Name</th>
                    <th>Quantity</th>
                    <th>Supplier</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once("config.php");

                    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                    $query = "SELECT * FROM parts_stock Left Join supplier on parts_stock.supplier=supplier.supplier_id";
                    $result = mysqli_query($conn, $query) or die("Nope");
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        $_SESSION['sName'] = $row['supplier'];
                        echo "<td>" . $row['sname'] . "</td>";
                        //echo "<td>" . $row['contact']. "</td>";
                        $_SESSION['pName'] = $row['name'];
                        $pID = $row['part_id'];
                        echo "<td><a href=\"orderP.php?id={$row['part_id']} \"  ><input type=\"button\" class=\"btn btn-success\" value=\"Order\" </a></td>";
                        echo "</tr>";
                    }
                   
                    ?>

            </tbody>
        </table>


    </section>
    <!-- Modal Form -->
    <div class="modal fade" id="ModalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Login Form -->

                <form action="order.php?id=<?php echo $_REQUEST['id']; ?>" method="post">
                    <?php

                        ?>
                    <div class="modal-header">
                        <h5 class="modal-title">How Many Parts Are you ordering?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="PartName">Part<span class="text-danger">*</span></label>
                            <input type="text" name="PartName" class="form-control" id="PartName"
                                placeholder="<?php echo $_REQUEST['id']; ?>">
                            <!--<select class="form-select" name="PartName" id="PartName" size="1">
                                <?php
                                   /* $query6 = "SELECT * FROM ctrlintelligence.parts_stock  ";
                                    $result6 = mysqli_query($conn, $query6) or die("query not executed");
                                    while ($row = mysqli_fetch_array($result6)) {
                                        echo "<option value=\"part\">{$row['name']}</option>";
                                       
                                        echo "<option value=\"part\">{$_REQUEST['id']}</option>";
                                    }
                                    mysqli_close($conn); */
                                    ?> 
                            </select>-->
                        </div>
                        <div class="mb-3">
                            <label for="quantity">Quantity:<span class="text-danger">*</span></label>
                            <input type="text" name="quantity" class="form-control" id="quantity"
                                placeholder="Enter quantity of parts you want to order">
                        </div>
                        <div class=modal-footer pt-4>
                        <button type="submit" class="btn btn-success mx-auto w-100">Order</button>
                    </div>
                    </div>
                        

                    </div>
                    
                </form>
            </div>
            <div class="col-md-1"></div>
            </div>
            <?php require_once("footer.html"); ?>
        </div>

</body>

</html>
<?php
} else {

    header("Location: login_staff.php?error=Session ended/ Does not exist");
    exit();
}
?>