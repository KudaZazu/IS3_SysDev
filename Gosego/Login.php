<!DOCTYPE html>
<html>

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