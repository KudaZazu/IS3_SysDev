
<?php

//Update 2022/09/28 09.23 by Gosego Menwe -->


session_start();

if (isset($_SESSION['id']) && isset($_SESSION['userID'])) {
require_once('config.php');



$conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("NO");

$query = "SELECT * from parts_stock where part_id={$_REQUEST['id']}";
$result= mysqli_query($conn,$query);

while ($row = mysqli_fetch_array($result)) {
    $name= $row['name'];
    $quanty= $row['quantity'];
    $_SESSION['Order']=$quanty;
}


mysqli_close($conn);

}else{

    header("Location: login_staff.php?error=Session ended/ Does not exist");
    
    exit();
    
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Ctrl Solution-Order Parts</title>
        <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>

      <!-- Modal Form -->
      <div class= "text-center" id="ModalForm" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Login Form -->
                <form action="order.php?id=<?php echo $_REQUEST['id'];?>" method="post">
                    <div class="modal-header">
                        <h5 class="text-center">How Many Parts Are you ordering?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                        <label for="partName">Part:<span class="text-danger">*</span></label>
        <input type="text"  name="partName" id="partName" placeholder="<?php  echo $name ?>" ><br><br>
                        </div>

                        <div class="mb-3">
                        <label for="newPass">Quantity:<span class="text-danger">*</span></label>
        <input type="number" id="quantity" min="0" size="2" name="quantity" placeholder="1" max="5" required ><br>
                        </div>
                        
                    </div>
                    <div class="modal-footer pt-4">
                        <button type="submit" class="btn btn-success mx-auto w-100">Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!--<div class="signup-popup" id="SignUp">
    <form action="order.php?id=<?php echo $_REQUEST['id'];?>" class="form-container" method="post">
        <h1>How Many Parts Are you ordering?</h1>

        <label for="partName"><b>Part:</b></label><br>
        <input type="text"  name="partName" id="partName" placeholder="<?php  echo $name ?>" ><br><br>

        <label for="newPass"><b>Quantity:</b></label><br>
        <input type="number" id="quantity" min="0" size="2" name="quantity" placeholder="1" max="5" required ><br>
<br>
      <button type="submit" class="btn btn-success" value="Update">Order</button>


    </form>
</div>-->
<div class="col-md-1"></div>
            </div>
            <?php require_once("footer.html"); ?>
        </div>
</html>

