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
                    <h1 class="display-5 text-center">Update Repair Job</h1>
                    <form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Part Name</th>
                                    <th>Quantity Used</th>
                                </tr>
                            </thead>
                            <tbody id="responce">
                                <?php
                                    require_once('config.php');
                                    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("NO");
                                    $ticket = $_REQUEST['ticketNum'];
                                    $query = "SELECT * FROM ctrlintelligence.parts
                                    WHERE ticket_number = $ticket";
                                    $result = mysqli_query($conn, $query) or die("Could not execute");
                                    $count = 0;
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "
                                        <tr>
                                        <td><input type=\"text\" class=\"form-control\" id=\"PartName\" value=\"{$row['name']}\" name=\"part1\"
                                                size=\"2\" readonly></td>
                                        <td><input type=\"text\" class=\"form-control\" id=\"PartName\" value=\"{$row['quantity']}\" name=\"part1\"
                                                size=\"2\"></td>
                                        </tr>
                                        ";
                                    }
                                    ?>
                                <tr>
                                    <td>
                                        <select class="form-select" name="PartName" id="PartName" size="1">
                                            <?php
                                            $query = "SELECT * FROM ctrlintelligence.parts_stock";
                                            $result = mysqli_query($conn, $query) or die("query not executed");
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "<option value=\"part\">{$row['name']}</option>";
                                            }
                                            
                                        ?>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" id="PartName" name="part1" size="1">
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </form>
                    <input value="add" type="button" onclick="addInput()" />


                    <script>
                    var countBox = 1;
                    var countBox2 = 10;
                    var boxName = 0;
                    var boxName2 = 0;

                    function addInput() {
                        var boxName = "textBox" + countBox;
                        var boxName2 = "textBox" + countBox2;
                        document.getElementById('responce').innerHTML +=
                            '<tr><td><<select class="form-select" name="PartName" id="PartName" size="1">' +
                            <?php
                            $query = "SELECT * FROM ctrlintelligence.parts_stock";
                            $result = mysqli_query($conn, $query) or die("query not executed");
                            while ($row = mysqli_fetch_array($result)) {
                                echo "\"<option value=\"part\">{$row['name']}</option>\"";
                            }
                            ?> + '</select></td><td><input type="text" class="form-control" id="' + boxName2 +
                            '" value="' +
                            boxName2 + '" "  /></td></tr>';
                        countBox += 1;
                        countBox2 += 1;
                    }
                    </script>
                </div>
                <div class="col-sm-2"></div>
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