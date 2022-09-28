<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How To</title>
    <link rel="stylesheet" href="SignUp.css">
    <link rel="stylesheet" href="Start.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <a href=# class="nav-item">Home</a>
                <a href="HowTo.html" class="nav-item">How To</a>
                <a href="Find_Us.html" class="nav-item">Find Us</a>
                <a href="#" class="nav-item">Book Consultation</a>
                <a href="#" class="nav-item"><i class="fa-circle-question rounded-pill"></i></a>
      </nav>

    <section class="HowToBody">

        <strong><h1>Before Coming In...</h1></strong><br>
        <p>Here are some tips on what to do before coming in to see us to make the process a little easier for you. And how to go about making a repair consultation with us.
        </p>
        <hr style="border: solid black 1px;">
    </section><br><br><br>

    <section class="Steps">
        <div class="One">
            <span>
                    <h2><strong>Step 1</strong></h2>
                    <i class="fa-solid fa-cloud-arrow-up"></i>&nbsp;Back up your device if you can
                    
                    <p><br>
                        Your device data will be deleted 
                        before the repair starts.
                         Back up your personal data in advance, and restore your device to factory settings.
                    </p>
                    
                </span>
            <span>
                    <h2><strong>Step 2</strong></h2>
                    <i class="fa-solid fa-calendar-check"></i>&nbsp;Book a consultation in advance
                   
                    <p><br>
                        Make an appointment in advance on the Cntl Solution official website.
                    </p>
                    
                </span>
            <span>
                    <h2><strong>Step 3</strong></h2>
                    <i class="fa-solid fa-house"></i>&nbsp;Go to the service center for repairs
                   
                    <p><br>
                        Confirm your appointment and
                         take your device to the service center on time
                    </p>
                    
                </span>
            <span>
                    <h2><strong>Step 4</strong></h2>
                    <i class="fa-solid fa-wrench"></i>&nbsp;Repair
                    
                    <p><br>
                        The service center provides you
                         with fast and high-quality repair service.
                    </p>
                    
                </span>
        </div>

    </section><br><br><br>

    <a onclick="openForm()"><button id="l" class="btn btn-info bg-info" class="button">Login</button></a>

    <div class="signup-popup" id="SignUp">
        <form action="HowTo.php" class="form-container" method="post">
            <h1>Login</h1>

            <label for="newUser"><b>Student Number</b></label>
            <input type="text" placeholder="g00a1234" name="uname" id="newUser" required>

            <label for="newPass"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" id="newPass" required>
<?php
           echo "<a href=\"index_cust.php?id={$row['userID']}\"><button type=\"submit\" class=\"btn\">Login</button>";
?>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>

</body>
<footer>

</footer>

<!--Sign-up pop up-->
<script>
    function openForm() {
        document.getElementById("SignUp").style.display = "block";
    }

    function closeForm() {
        document.getElementById("SignUp").style.display = "none";
    }
</script>

<?php
session_start();

require_once("config.php");

$uName = $_REQUEST['uname'];
$pwd = $_REQUEST['psw'];

$conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h2 style=\'color:red;\'>DATABASE ERROR: unable to validate your credentials!</h2>");

$query = "SELECT saltedPassword FROM users WHERE userID = \"$uName\"";
$result = mysqli_query($conn, $query); 
echo "$conn->error";//or die("<h2 style=\'color:red;\'>QUERY ERROR: unable to validate your credentials</h2>");

if (mysqli_num_rows($result)==1) {
    $row = mysqli_fetch_array($result);
    $hash = $row['saltedPassword'];

    // Use password_verify() function to
    // verify the password matches
    $salt = password_verify($pwd,
    $hash);

    if($salt)
    {
        $query2 = "SELECT * FROM Customer WHERE userID = \"$uName\"";
        $cust = mysqli_query($conn, $query2) or die("oops!!1");
        $query3 = "SELECT * FROM Staff WHERE role = \"Tech\" AND userID =\"$uName\"";
        $tech = mysqli_query($conn, $query3) or die("oops!!2");;
        $query4 = "SELECT * FROM Staff WHERE role = \"Admin\" ";
        $staff = mysqli_query($conn, $query4) or die("oops!!3");;

        //check whether staff or student
        if (mysqli_num_rows($cust) == 1) {
          $_SESSION['acesssCust'] = "yes";
          header("Location:index_cust.html");
      } elseif (mysqli_num_rows($staff)== 1) {
          $_SESSION['acesssStaff'] = "yes";
          header("Location:index_staff.html");
      } elseif (mysqli_num_rows($tech)== 1) {
          $_SESSION['acesssTech'] = "yes";
          header("Location:index_tech.html");
      } else {
          header("Location:index.html");
              echo "<p style ='color:red';>Incorrect login details</p>";
      }   
    } 
  }

  mysqli_close($conn);
?>

</html>