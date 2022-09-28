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
        <link rel="stylesheet" href="Start.css"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Customer Portal</title>
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
            <a href=# class="nav-item">Home</a>
            <a href="HowTo.html" class="nav-item">How To</a>
            <a href="Find_Us.html" class="nav-item">Find Us</a>
            <a href="#" class="nav-item">Book Consultation</a>
            <a href="logout.php" class="nav-item"><i class="fa-circle-question rounded-pill"></i></a>
        </nav>

        <?php
            require_once("config.php");
        $ID = $_SESSION['userID'];

            $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("<h1 style='color:red;'>Cannot connect to the database</h1>");
            $query = "SELECT customer.userID, job.status from customer inner join job on customer.customer_id = job.customer_id where  customer.userID = \"$ID\" ";
            $result = mysqli_query($conn, $query) or die("Cannot execute query");
           
            $r= 0;
            while ($row= mysqli_fetch_array($result)){
                if($row['status'] = "created") {
                    $r = 25;
                } elseif($row['status'] = "in progress"){
                    $r= 50;
                } elseif($row['status'] = "complete"){
                    $r= 100;
            }

            }

           mysqli_close($conn);
        ?>

        <section id="mainContainer">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-md-8 p-3">
                        <fieldset>
                            <p class="text-center display-5">Repair progress</p>
                            <div class="progress">
                                <div class="progress-bar bg-success progress-bar-animated" style="width:<?php echo $r +"%";?>"></div>
                            </div><br>
                        </fieldset>

                        <fieldset>
                            <legend>Book Consultation</legend>
                            <section id="userinf">
                                <p>Username:</p>
                                <p>Active repairs:</p>
                                <p>Ticket number:</p>
                                <p id="date">Date:</p>
                            </section>
                        </fieldset><br>

                        <fieldset>
                            <legend>Send a message to your tech</legend>
                            
                            <form action="techmessage.php" method="post">
                                <textarea class="form-control" id="techmessage" rows="6"></textarea>
                                <input type="submit" value="Send">
                            </form>
                            <a onclick="alert();">
                                <p>Who is repairing my device?</p>
                            </a>
                        </fieldset>

                    </div>
                    <div class="col-md-4 p-3">
                        <aside style="float: right;">
                        
                            <fieldset style="border:2px black ;">
                            <?php

                            echo "<legend>$ID</legend>";
                            ?>
                                <section id="notif">
                                    <button type="button"  class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#demo">My Messages</button>
                                    <div id="demo" class="collapse show">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </div>
                                </section><br>
                           

                                <section id="history">
                                    <button type="button"  class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#rhis">Repair History</button>
                                    <div id="rhis" class="collapse show">
                                       <p>
                                        Dates<br>
                                        Info about past jobs<br>
                                        Problem description<br>
                                        Ticket# 25154 18/06/2022<br><hr>
                                        
                                        Info about past jobs<br>
                                        Problem description<br>
                                        Ticket# 38634 26/01/2022
                                        
                                       </p> 
                                    </div>
                                </section>
                            </fieldset>
                        </aside>
                    </div>
                </div>
              </div>

    
        </section>
    </body>
    
    </html>
    <?php
        }else{

        header("Location: HowTo.html?error=Incorrect Login Details");

        exit();

        }

?>
