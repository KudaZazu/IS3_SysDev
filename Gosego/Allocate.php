<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Start.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="nav.css">
    <title>Staff_Allocate</title>
    </head>

    <body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/CI.png" alt="Logo" style="width:40px;" class="rounded-pill">
            </a>
        </div>
        <a href=# class="nav-item">Home</a>
                <a href="HowTo.html" class="nav-item">How To</a>
                <a href="Find_Us.html" class="nav-item">Find Us</a>
                <a href="#" class="nav-item">Book Consultation</a>
                <a href="#" class="nav-item"><i class="fa-circle-question rounded-pill"></i></a>
      </nav>
    <div class="container-fluid">

        <div class="m-5">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <h1 class="display-5">Allocate Technician</h1>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-sm-2"></div>
            <div class="col-sm-5">
                <h3>Job Information:</h3>
            </div>
            <div class="col-sm-5"></div>
        </div>
        <div class="row">
            <div class="col">
                <form action="edit.php" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                        <div class="mb-1 mt-1">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            Ticket Number
                            </button>
                            <ul class="dropdown-menu">
                            <?php
                            require_once("config.php");

                            $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                    
                            $query1= "SELECT * from job where status =\"Not allocated\" ";
                            $result1= mysqli_query($conn, $query1);
                    
                            while($row= mysqli_fetch_array($result1)){
                             echo "<button type=\submit\" name=\"ticket\"><li>".$row['ticket_number']."</li></button>";
                            }

                            $row = mysqli_fetch_array($result1);
                            $dName= $row['ticket_number'];
                            ?>
                            </ul>
                        </div>
                        <div class="col-sm-2"></div>
                        </div>
                        <div class="mb-1">
                            <label for="Lnameid" class="form-label">Device name:</label>
                            <input type="text" id="Lnameid" name="Lname" class="form-control" value="<?php echo $_REQUEST['ticket'] ?>">
                        </div>
                        <div class="mb-1">
                            <label for="studentid" class="form-label">Device Type:</label>
                            <input type="text" id="studentid" name="student" class="form-control">
                        </div>
                    </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <hr>
            </div>
            <div class="c0l-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-5">
                <h3>Technician:</h3>
            </div>
            <div class="col-sm-5"></div>
        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col">
            <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Jobs</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
            <?php
                $query= "SELECT staff_id, count(staff_id) as 'jobs', status, ticket_number FROM job group by staff_id having count(staff_id) <= 4 /*and (status = \"Completed\" or )*/";
                $result = mysqli_query($conn, $query) or die("<h1 style='color:red;'>Could not execute the query</h1>");
                
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td><a href=\"edit.php?id={$row['staff_id']}\">" . $row['staff_id']. "</td>";
                    echo "<td>" . $row['jobs']. "</td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
            ?>

                </tbody>
              </table>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <input type="Submit" name="submit" value="Allocate" class="btn btn-info">
            </div>
            
        </div>
        </form>
        </div>

    </body>
</html>

