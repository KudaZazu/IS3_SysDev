<?php
require_once("config.php");
$messegeID = $_REQUEST['id'];
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
$query = "DELETE FROM ctrlintelligence.messages WHERE idmessages = $messegeID";
$result = mysqli_query($conn, $query) or die("Cannot execute query");
header("Location: index_staff.php");