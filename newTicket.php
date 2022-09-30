<!-- Update 2022/09/28 13:33 by Kenneth Chieza 
added functionality to switch navbar depending on if staff/tech is logged in
-->
<?php
session_start();
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
    <link rel="stylesheet" href="nav.css">
    <title>Document</title>
</head>

<body>

    <div class="navbar">
        <?php require_once("staffORtech_nav.php"); ?>
    </div>
    <div class="container-fluid">

        <div class="m-5">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <h1 class="display-5">New Repair Job</h1>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>

        <div class="m-5">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <form action="newTicket.php" method="post" enctype="multipart/form-data">
                        <div id="center">
                            <div class="mb-1">
                                <label for="studentid" class="form-label">Student Number:</label>
                                <input type="text" id="studentid" name="student" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="col"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <input type="Submit" name="submit" value="Submit" class="btn btn-success">
            </div>
            <div class="col-sm-3"></div>
        </div>


        </form>
    </div>

    <?php
    if (isset($_REQUEST['submit'])) {
        require_once("configK.php");
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h2 style='color:red;'>DATABASE ERROR: unable to validate your credentials!</h2>");

        //insert values from form here
        $userID = $_REQUEST['student'];

        //create a password
        function genPassword()
        {
            $char = "abcdefghijklmnopqrstuvwxyz01234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789~`!@#$%^&*()_-+=|\:;'.?/";
            $pwd = "";
            while (strlen($pwd) < 14) {
                $pwd = $pwd . $char[rand(0, strlen($char) - 1)];
            }
            return $pwd;
        }



        $query = "SELECT userID FROM ctrlintelligence.users
            WHERE userID = '$userID'";
        $result = mysqli_query($conn, $query)
            or die("<h1 style=color:red;> Could not execute query! </h1>");
        $row = mysqli_fetch_array($result);


        if (isset($row['userID'])) {
            header("Location: newTicket1.php?userID={$_REQUEST['student']}");
        } else {
            // Use password_hash() function to
            // create a password hash
            $pass = genPassword();
            $hash_default_salt = password_hash(
                $pass,
                PASSWORD_ARGON2I,
                ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]
            );

            $query = "INSERT INTO ctrlintelligence.users(userID, saltedPassword) VALUE ('$userID', '$hash_default_salt')";
            $result = mysqli_query($conn, $query);
            mysqli_close($conn);
            header("Location: newTicket2.php?userID={$_REQUEST['student']}&password='$pass'");
        }
    }
    ?>
</body>

</html>