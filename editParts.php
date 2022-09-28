

<?php

//Update 2022/09/28 09.23 by Gosego Menwe -->


session_start();

if (isset($_SESSION['id']) && isset($_SESSION['userID'])) {
require_once('config.php');

$partID= $_SESSION["partID"];

$conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("NO");

$query = "SELECT name, quantity from parts where part_id=$partID";
$result= mysqli_query($conn,$query);

while ($row = mysqli_fetch_array($result)) {
    $name= $row['name'];
    $quanty= $row['quantity'];
    $_SESSION['QUAN']=$quanty;
}


mysqli_close($conn);

}else{

    header("Location: login_staff.php?error=Session ended/ Does not exist");
    
    exit();
    
    }
?>




<div class="signup-popup" id="SignUp">
    <form action="update.php" class="form-container" method="post">
        <h1>How Many Parts Used?</h1>

        <label for="partName"><b>Part:</b></label><br>
        <input type="text"  name="partName" id="partName" placeholder="<?php  echo $name?>" ><br>

        <label for="id"><b>ID:</b></label><br>
        <input type="text"  name="id" id="id" value="<?php  echo $partID?>" ><br>

        <label for="newPass"><b>Quantity:</b></label><br>
        <input type="number" id="quantity" min="0" size="2" name="quantity" placeholder="1" max="5" required >
<br>
      <button type="submit" class="btn" value="Update">Update</button>


    </form>
          

       

    