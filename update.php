<?php

//Update 2022/09/28 09.23 by Gosego Menwe -->


session_start();

if (isset($_SESSION['id']) && isset($_SESSION['userID'])) {
    require_once('config.php');
    $conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("NO");

       //if (isset($_REQUEST['submit'])){
            $partquan= $_SESSION['QUAN']- $_REQUEST['quantity'];
           
            if ($partquan < 0) {
                header("Location: Update_Tech.php?error=There are not enough parts, Please order more.");
                mysqli_close($conn);
                
            }else {
            $query2= "UPDATE parts SET quantity= $partquan  where part_id={$_SESSION['partID']} ";
            var_dump($query2);
            $result2=mysqli_query($conn,$query2) or die("Its me on line 162");

            mysqli_close($conn);

            echo "Yay Updated ";
            header("Location:Update_Tech.php");
            }
     // }

    }else{

        header("Location: login_staff.php?error=Session ended/ Does not exist");
        
        exit();
        
        }
    ?>