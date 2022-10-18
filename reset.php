<?php
    session_start();

    require_once("config.php");

    function validate($data){

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;

    }

    $usr = validate($_REQUEST['usr']);
    $lname = validate($_REQUEST['lname']);
    $mail = validate($_REQUEST['mail']);

    if(empty($usr) || empty($lname) || empty($mail))
    {
        header("Location: resetpwd.html");
        exit();
    }else{//find user
        $conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h2 style=\'color:red;\'>DATABASE ERROR: unable to validate your credentials!</h2>");
        $query = "SELECT * FROM users,staff WHERE staff.userID=\"$usr\" AND users.userID=\"$usr\" AND staff.lname=\"$lname\" ";
        $result = mysqli_query($conn, $query) or die("<h2 style=\'color:red;\'>QUERY ERROR: unable to validate your credentials</h2>");

        if (mysqli_num_rows($result)==1)//user found 
        {
            //reset password
            $pwd = password_hash($usr,
            PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
            $query2 ="UPDATE users SET saltedPassword = \"$pwd\" WHERE (userID = \"$usr\")";
            $result2 = mysqli_query($conn,$query2);
            mysqli_close($conn);
            header("Location: success.html");
            exit();
        }else{//user does not exist
            
            mysqli_close($conn);
            header("refresh:5; url=resetpwd.html");
            echo "Reset failed, try again!";
            exit();
        }

    }

?>
