<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<div class="signup-popup" id="SignUp">
    <form action="order.php" class="form-container" method="post">
        <h1>How Many Parts Are you ordering?</h1>

        <label for="partName"><b>Part:</b></label><br>
        <input type="text"  name="partName" id="partName" placeholder="<?php  echo $_SESSION['pName'] ?>" ><br>

        <label for="id"><b>Supplier:</b></label><br>
        <input type="text"  name="id" id="id" value="<?php  echo $_SESSION['sName']?>" ><br>
        

        <label for="newPass"><b>Quantity:</b></label><br>
        <input type="number" id="quantity" min="0" size="2" name="quantity" placeholder="1" max="5" required >
<br>
      <button type="submit" class="btn" value="Update">Order</button>


    </form>
</div>
</html>

<?php