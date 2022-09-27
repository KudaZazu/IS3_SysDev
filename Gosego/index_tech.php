<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
    <link href="Start.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Ctrl Solution-Home</title>
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/CI.png" alt="Logo" style="width:40px;" class="rounded-pill">
            </a>
        </div>
        <a href="index_tech.php" class="nav-item">Home</a>
        <a href="newTicket.php" class="nav-item">New Ticket</a>
        <a href="#" class="nav-item">Jobs</a>
        <a href="Allocate.php" class="nav-item">Allocate</a>
        <a href="#" class="nav-item">Reports</a>
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

                <fieldset style="width:80%;">
                    <legend>Queue</legend>
                    <?php
                            require_once("config.php");
                                $ID= $_REQUEST['id'];
                    
                                $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                                $query = "SELECT * FROM job INNER JOIN staff on job.staff_id= staff.staff_id INNER JOIN devices on job.device_id=devices.device_id  WHERE staff.userID=\"$ID\" ";
                                $result = mysqli_query($conn, $query) or die("Cannot execute query");
                               
                                while ($row= mysqli_fetch_array($result)){
                                    echo "<p>" .$row['ticket_number']." " .$row['description']. "<input type=\"button\" value=\"Complete\"></p>";
                                }

                                mysqli_close($conn);
                                
                            ?>
                </fieldset>
            </section>
            <section>
                <fieldset style="width:80%;">
                    <legend>Messages</legend>
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
</body>

</html>