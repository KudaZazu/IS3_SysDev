<?php

//Update 2022/09/28 09.23 by Gosego Menwe -->


session_start();

if (isset($_SESSION['id']) && isset($_SESSION['ticketNum'])) {
    require_once('config.php');
    $conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("NO");

       //if (isset($_REQUEST['submit'])){
           if ($_SESSION['status']== "In Process"){
           
            $query2= "UPDATE job SET status= \"Completed\"  where ticket_number={$_SESSION['ticketNum']} ";
         
            $result2=mysqli_query($conn,$query2) or die("Its me on line 162");

            mysqli_close($conn);

    
            header("Location:index_tech.php");
        }
     // }

    }else{

        header("Location: login_staff.php?error=Session ended/ Does not exist");
        
        exit();
        
        }
    ?>