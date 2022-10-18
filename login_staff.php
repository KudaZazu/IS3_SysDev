<!-- Update 2022/09/28 09.23 by Gosego Menwe -->

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="SignUp.css">
<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <h2>Ctrl Solution</h2>
    <a onclick="openForm()"><i class="fa fa-user icon"></i></a>

<div class="signup-popup" id="SignUp">
  <form action="/action_page.php" class="form-container">
    <h1>Sign-Up</h1>

    <label for="newUser"><b>Student Number</b></label>
    <input type="text" placeholder="Enter Username" name="newUser" id="newUser" required>

    <label for="newEmail"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="newEmail" id="newEmail" required>

    <label for="newPass"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="newPass" id="newPass" required>

    <label for="Cpsw"><b>Confirm Password</b></label>
    <input type="password" placeholder="Confirm Password" name="Cpsw" id="Cpsw" required>

    <button type="submit" class="btn">Sign-Up</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>

</div>

<form action="Login.php" method="post">
  <div class="imgcontainer">
    <img src="images/CI.jpg" alt="Avatar" class="avatar">
  </div>
  <?php if (isset($_GET['error'])) { ?>

    <p class="error"><?php echo $_GET['error']; ?></p>

  <?php } ?>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw"><a href="resetpwd.html">Forgot password?</a></span>
  </div>
</form>

<!--Sign-up pop up-->
<script>
  function openForm() {
    document.getElementById("SignUp").style.display = "block";
  }

  function closeForm() {
  document.getElementById("SignUp").style.display = "none";
}
</script>  

</body>
</html>