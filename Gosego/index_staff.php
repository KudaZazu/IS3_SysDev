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
    <title>Ctrl Solution-Index</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/CI.png" alt="Logo" style="width:40px;" class="rounded-pill">
            </a>
        </div>
        <a href="#" class="nav-item">Home</a>
        <a href="newTicket.php" class="nav-item">New Ticket</a>
        <a href="Jobs_Staff" class="nav-item">Jobs</a>
        <a href="Allocate.php" class="nav-item">Allocate</a>
        <a href="#" class="nav-item">Reports</a>
    </nav>

    <section id="mainContainer">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-8 p-3">
                    <section id="newJobs">
                        <fieldset >
                            <legend>New Jobs</legend>
                            <?php
                            require_once("config.php");
                    
                                $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                                $query = "SELECT * FROM job WHERE job.status= \"Not allocated\" ";
                                $result = mysqli_query($conn, $query) or die("Cannot execute query");
                               
                                while ($row= mysqli_fetch_array($result)){
                                    echo "<p>" .$row['ticket_number']." " .$row['description']. "      <input type=\"button\" value=\"Allocate\"></p>";
                                }
                    
                            ?>
                        </fieldset>
                    </section><br>

                    <section id="jobHistory">
                        <fieldset>
                            <legend>Job History</legend>
                                
                            <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Ticket</th>
                                        <th>Device</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $ID= $_REQUEST['id'];
                                    //Im gonna have to join this damn shit again
                                    
                                        $query2 ="SELECT * FROM job INNER JOIN staff ON job.staff_id=staff.staff_id INNER JOIN devices ON job.device_id= devices.device_id where staff.userID=\"$ID\" ";
                                        $result = mysqli_query($conn, $query2);
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tr>";
                                            echo "<td>" . $row['ticket_number']. "</td>";
                                            echo "<td>" . $row['name']. "  " .$row['devices.type']. "</td>";
                                            echo "<td>" . $row['description']. "</td>";
                                            echo "<td>" . $row['status']. "</td>";
                                            echo "</tr>";
                                        }
                                        mysqli_close($conn);
                                    ?>
                                    </tbody>
                                </table>
                        </fieldset>
                    </section>
                    <br>
                    <input type="button" name="submitt" value="Create New Ticket" class="btn btn-success" width="100%" onclick="newTicket.php">
                </div>

                <div class="col-md-4 p-3">
                    <fieldset>
                            <section id="notifs">
                                <button type="button"  class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#demo">My Notifications</button>
                                <div id="demo" class="collapse show">
                                    <!-- Remember to do the messages-->
                                    <p>hdujfvvvvndnnndndsndsndndmmcds</p>   
                                </div>
                                <div id="date">
                                    <script>
                                        document.getElementById("current_date").innerHTML = Date();
                                    </script>
                                </div>
                            </section>
                    </fieldset>
                </div>
            </div>
        </div>
        
    </section>
</body>

</html>