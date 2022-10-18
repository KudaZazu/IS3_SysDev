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
    <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<body>


    <?php require_once("staffORtech_nav.php"); ?>

    <div class="container-fluid">

        <div class="m-5">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <fieldset>
                        <div class="card px-5 py-5 border-none">
                            <p class="text-center display-4">New Repair Job</p>
                            <form action="newTicket.php" method="post" enctype="multipart/form-data"  >

                                <div id="center">
                                    <div class="mb-4 mt-4">
                                        <label for="studentid" class="form-label">Student Number:</label>
                                        <input type="text" id="studentid" placeholder="g00a1234" name="student" class="form-control" maxlength="8" size="8" pattern="[g]{1}[0-9]{2}[a-z]{1}[0-9]{4}">
                                    </div>
                                </div>
                                <input type="Submit" name="submit" value="Submit" class="btn btn-success w-100">
                            </form>
                        </div>
                    </fieldset>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>

    </div>

    <?php
    if(isset($_REQUEST['result']))
    {
        $result = $_REQUEST['result'];
        echo $result;
    }

    if (isset($_REQUEST['submit'])) {
        require_once("configK.php");
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h2 style='color:red;'>DATABASE ERROR: unable to validate your credentials!</h2>");

        //insert values from form here
        $userID = $_REQUEST['student'];

        $query = "SELECT userID FROM ctrlintelligence.users
            WHERE userID = '$userID'";
        $result = mysqli_query($conn, $query)
            or die("<h1 style=color:red;> Could not execute query! </h1>");

        if (mysqli_num_rows($result)==1) {//student has used system before
            header("Location: newTicket1.php?userID={$_REQUEST['student']}&result=\"Ticket successfully created!\"");
        } else {//first time user
            $pwd = password_hash($userID,
            PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
            $query = "INSERT INTO ctrlintelligence.users(userID, saltedPassword) VALUE ('$userID', '$pwd')";
            $result = mysqli_query($conn, $query);
            mysqli_close($conn);
            header("Location: newTicket2.php?userID={$_REQUEST['student']}&password='$userID'&result=\"Ticket successfully created!\"");
        }
    }
    ?>

    <?php require_once("footer.html"); ?>

</body>

</html>