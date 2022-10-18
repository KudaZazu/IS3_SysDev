<!-- Update 2022/09/28 09.23 by Gosego Menwe -->

<!DOCTYPE html>
<html>

<?php
session_start();

require_once("config.php");

function validate($data){

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    return $data;

 }

    $uName = validate($_REQUEST['uname']);
    $pwd = validate($_REQUEST['psw']);

    if (empty($uName)) {

        header("Location: Start.html");

        exit();

    }elseif(empty($pwd)){

        header("Location:Start.html");

        exit();

    }


$conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h2 style=\'color:red;\'>DATABASE ERROR: unable to validate your credentials!</h2>");

$query = "SELECT saltedPassword FROM users WHERE userID = \"$uName\"";
$result = mysqli_query($conn, $query) or die("<h2 style=\'color:red;\'>QUERY ERROR: unable to validate your credentials</h2>");

if (mysqli_num_rows($result)==1)
{
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
        $query4 = "SELECT * FROM Staff WHERE role = \"Admin\" and userID=\"$uName\"";
        $staff = mysqli_query($conn, $query4) or die("oops!!3");
        $query4 = "SELECT * FROM Staff WHERE role = \"HOD\" and userID=\"$uName\"";
        $HOD = mysqli_query($conn, $query4) or die("oops!!4");

        //check whether staff or student
    
        
        if (mysqli_num_rows($cust)==1){
            $_SESSION['acesssCust'] = "yes";
            $row = mysqli_fetch_assoc($cust);

            if ($row['userID'] === $uName) {

                echo "Logged in!";

                $_SESSION['userID'] = $row['userID'];

                $_SESSION['name'] = $row['fname'];

                $_SESSION['id'] = $row['customer_id'];
                header("Location:index_cust.php");
                exit();
            } 
        } elseif(mysqli_num_rows($staff)==1){
            $_SESSION['acesssStaff'] = "yes"; 

            $row = mysqli_fetch_array($staff); {
                 if($row['userID'] === $uName) {

                echo "Logged in!";

                $_SESSION['userID'] = $row['userID'];

                $_SESSION['name'] = $row['fname'];

                $_SESSION['id'] = $row['staff_id'];
                header("Location:index_staff.php");
                exit();
                }
            }

        } elseif(mysqli_num_rows($tech)==1){
            $_SESSION['acesssTech'] = "yes";
            $row = mysqli_fetch_assoc($tech); {
                if ($row['userID'] === $uName) {

                echo "Logged in!";

                $_SESSION['userID'] = $row['userID'];

                $_SESSION['name'] = $row['fname'];

                $_SESSION['id'] = $row['staff_id'];
                header("Location:index_tech.php");
                exit();
                }
                
        }  
      }elseif(mysqli_num_rows($HOD)==1){
        $_SESSION['acesssHOD'] = "yes"; 

        $row = mysqli_fetch_array($HOD); {
             if($row['userID'] === $uName) {

            echo "Logged in!";

            $_SESSION['userID'] = $row['userID'];

            $_SESSION['name'] = $row['fname'];

            $_SESSION['id'] = $row['staff_id'];
            header("Location:HOD.php");
            exit();
            }
        }
    }  else {
          header("Location:Start.html");
            exit();
      }   
    }else{

        header("Location:Start.html");

        exit();

    } 
}else{

    header("Location: Start.html");

    exit();
}

  mysqli_close($conn);

?>

</html>