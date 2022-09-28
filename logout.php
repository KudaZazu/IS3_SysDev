<!-- Update 2022/09/28 09.23 by Gosego Menwe -->
<?php 

session_start();

session_unset();

session_destroy();

header("Location: index.php");
?>