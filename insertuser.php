<?php
require_once("config.php");

//insert values from form here
$uName = "g20h1258";
$pwd= "Kendrick";
// Use password_hash() function to
// create a password hash
$hash_default_salt = password_hash($pwd,
        PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
  
$conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h2 style='color:red;'>DATABASE ERROR: unable to validate your credentials!</h2>");

$query = "INSERT INTO users(userID, saltedPassword) VALUES (\"$uName\", \"$hash_default_salt\")";
$result = mysqli_query($conn,$query);
mysqli_close($conn);

echo "Inserted $uName";

?>