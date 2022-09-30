<!-- Update 2022/09/28 09.23 by Gosego Menwe -->

<?php

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['userID'])) {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
    <link href="Start.css" type="text/css" rel="stylesheet">
    <link href="nav.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Ctrl Solution-Home</title>
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <a href="index_tech.php"><img src="images/CI.png" alt="Logo" style="width:40px;" class="rounded-pill"></a>
            </a>
        </div>
        <a href="<?php echo "index_tech.php?id=$ID";?>" class="nav-item">Home</a>
        <a href="newTicket.php" class="nav-item">New Ticket</a>
        <a href="Job_Staff.php" class="nav-item">Jobs</a>
        <a href="Update_Tech.php" class="nav-item">Update</a>
        <a href="Orders_Tech.php" class="nav-item">Orders</a>
        <a href="logout.php" class="nav-item"><i class="fa-circle-question rounded-pill"></i></a>
    </nav>

    <section id="mainContainer">
        <fieldset>
            <section>
                <aside style="float:right">
                    <fieldset>
                    <button type="button"  class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#demo">My Notifications</button>
                    <div id="demo" class="collapse show">
                        <p>Notif 1</p>
                        <p>Notif 2</p>
                        <p>Notif 3</p>
                    </div>
                    </fieldset>
                </aside>

                <fieldset style="width:80%;" class="text-center">
                    <legend class="display-5" >Queue</legend>
                    <table class="table">
                <thead>
                  <tr>
                    <th>Ticket</th>
                    <th>Type</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                            require_once("config.php");
                            $ID= $_SESSION['id'];
                                
                                $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                                $query = "SELECT * FROM job WHERE staff_id=$ID";
                                $result = mysqli_query($conn, $query) or die("Cannot execute query");
                        
                                while ($row= mysqli_fetch_array($result)){
                                    echo "<tr>";                                   
                                    echo "<td> " .$row['ticket_number']." " .$row['description']. "</td>";
                                    $_SESSION['status']= $row['status'];
                                    $_SESSION['ticketNum']= $row['ticket_number'];
                                    echo "<td><a href=\"statusUpdate.php\"> <input type=\"button\" class=\"btn btn-primary\" value=\"Complete\"></a> </td>";
                                    echo "</tr>";
                                }

                                mysqli_close($conn);
                                
                            ?>
                </tbody>
                    </table>
                </fieldset>
            </section>
            <section>
                <fieldset style="width:80%;" class="text-center">
                    <legend class="display-5">Messages</legend>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus tenetur doloremque molestiae illum impedit voluptatum laborum placeat aliquid? Magnam nihil odio saepe? Numquam assumenda cupiditate est quis, molestiae cum totam.</p>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ut tenetur labore qui sunt, commodi modi vel aliquam harum odit! Necessitatibus quia aut autem porro illo, eaque nemo ut non cum.</p>
                </fieldset>
            </section>
            <section>
                <fieldset style="width:80%;">
                    <br>
                    <input type="button" value="Quick Ticket" style="width:100%;">
                </fieldset>
            </section>
        </fieldset>
    </section>

    <div class="row">
        <div class="col-12"></div>
        <div class="col-12"></div>
    </div>


    <footer class="footer bg-dark" id="foot">
    <div class="container py-3">
      <span class="text-light">
    
    


    <div class="d-flex flex-row bg-secondary mb-3">
    <div class="p-2 "><a class="nav-link" href="index.html">Home</a></div>
    <div class="p-2 "><a class="nav-link" href="contact.html">Contact us</a></div>
    <div class="p-2 "><a class="nav-link" href="conditions.html">T&C'S</a></div>
        
    </div>
    <h3 >Ctrl Intelligence</h3>
        <p >Copyright &copy; 2022. South Africa</p>

    <!-- social media section -->
    <div class="d-flex flex-row bg-secondary mb-4">

    <div class="p-2 "><a target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></div>
    <div class="p-2 "><a target="_blank" href="https://www.instagram.com/?hl=en"><i class="fa fa-instagram"></i></a></div>
    <div class="p-2 "><a target="_blank" href="https://www.github.com/"><i class="fa fa-github"></i></a></div>
    <div class="p-2 "><a target="_blank" href="https://twitter.com/?lang=en"><i class="fa fa-twitter"></i></a></i></a></div>
              
        
    </div>
</nav>
      </span>
    </div>
</footer>
</body>
</html>

<?php

}else{

    header("Location: login_staff.php?error=Session ended/ Does not exist");

    exit();

}
?>