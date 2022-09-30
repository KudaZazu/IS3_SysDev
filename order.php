<!-- Update 2022/09/30 12:35 by Gosego Menwe -->
<?php

session_start();

if (isset($_SESSION['id'])) {
    
            require_once("config.php");
            $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
            $query= $query2= "UPDATE parts SET quantity= {$_REQUEST['quantity']}  where part_id={$_SESSION['part_id']} ";
            $result = mysqli_query($conn, $query) or die("Its me");

mysqli_close($conn);

header("Location: Orders_Tech.php?conf = Part Successfully Ordered");
exit();
} else{
    header("Location: Orders_Tech.php?error=Session ended/ Does not exist");
        
    exit();
    
}
?>


