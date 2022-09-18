<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Start.css"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Ctrl Solution-Staff-Jobs</title>
        <script src="https://kit.fontawesome.com/e92da86d17.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="images/CI.png" alt="Logo" style="width:40px;" class="rounded-pill">
                </a>
            </div>
            <a href="index.html" class="nav-item">Home</a>
            <a href="HowTo.html" class="nav-item">New Ticket</a>
            <a href="#" class="nav-item">Jobs</a>
            <a href="#" class="nav-item">Allocate</a>
            <a href="#" class="nav-item"><i class="fa-circle-question rounded-pill"></i></a>
        </nav>

        
        <section id="mainSection">
            <h1 class="Display-2 text-center">Current Jobs</h1><br>

            <table class="table">
                <thead>
                  <tr>
                    <th>Device Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Peripherals</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
            <?php
                require_once("config.php");

                $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
                $query= "SELECT * FROM job, devices WHERE job.device_id = devices.device_id and  status =\"In Proress\" ";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['devices.name']. "</td>";
                    echo "<td>" . $row['devices.type']. "</td>";
                    echo "<td>" . $row['job.description']. "</td>";
                    echo "<td>" . $row['job.status']. "</td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
            ?>

          
                  
                </tbody>
              </table>

        </section>
    </body>
    </html>