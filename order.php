<!-- Update 2022/09/30 12:35 by Gosego Menwe -->


<?php

session_start();

if (isset($_SESSION['id'])) {
    require_once("config.php");
    $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
    $query = "SELECT * from parts_stock where part_id={$_GET['id']}";
   
$result= mysqli_query($conn,$query) or die("Nope");

while ($row = mysqli_fetch_array($result)) {
    $name= $row['name'];
    $quanty= $row['quantity'];
    $sname= $row['supplier']; 
    $_SESSION['Order']=$quanty;
}
    $res= $_SESSION['Order'] + $_REQUEST['quantity'];
           
            $query= $query2= "UPDATE parts_stock SET quantity= {$res}  where part_id={$_GET['id']} ";
            $result = mysqli_query($conn, $query) or die("Its me");

mysqli_close($conn);

header("Location: Orders_Tech.php?conf = Part Successfully Ordered");
exit();
} else{
    header("Location: Orders_Tech.php?error=Session ended/ Does not exist");
        
    exit();
    
}
?>


