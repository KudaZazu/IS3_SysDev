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
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-5">
                <h3>Job Information:</h3>
            </div>
            <div class="col-sm-5"></div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form action="newTicket.php" method="post" enctype="multipart/form-data">
                    <div id="center">
                        <div class="mb-1 mt-1">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            Ticket Number
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Link 1</a></li>
                            <li><a class="dropdown-item" href="#">Link 2</a></li>
                            <li><a class="dropdown-item" href="#">Link 3</a></li>
                            </ul>
                        </div>
                        </div>
                        <div class="mb-1">
                            <label for="Lnameid" class="form-label">Device name:</label>
                            <input type="text" id="Lnameid" name="Lname" class="form-control">
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
                <div class="mb-1 mt-1">
                    <label for="devicenameid" class="form-label">Device Name:</label>
                    <input type="text" id="devicenameid" name="devicename" class="form-control">
                </div>
                <div class="mb-1">
                    <label class="form-label" for="devicenumberid">Number of Devices:</label><br>
                    <select class="form-select" name="devicenumber" id="devicenumberid" size="1">
                        <option value="One">1</option>
                        <option value="Two">2</option>
                        <option value="Three">3</option>
                    </select>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="typeid">Device Type:</label>
                    <select class="form-select" name="type" id="typeid" size="1">
                        <option value="Laptop">Laptop</option>
                        <option value="Desktop">Desktop</option>
                        <option value="Smartphone">Smartphone</option>
                    </select>
                </div>
                <div class="mt-1">
                    <label for="descrptionid" class="form-label">Fault Descrption:</label>
                    <textarea name="descrption" id="descrptionid" rows="5" class="form-control"></textarea>
                </div>
                <div class="input-group">
                    <input class="form-control" type="file" id="faultimage" name="faultimage"><br>
                </div>
                <div class="mb-1 mt-1">
                    <label for="mouseid" class="form-label">Extras:</label>
                    <div class="form-check">
                        <input type="checkbox" id="mouseid" name="mouse" value="mouse" class="form-check-input">
                        <label for="mouseid" class="form-check-label">Mouse</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="bagid" name="bag" value="bag" class="form-check-input">
                        <label for="bagid" class="form-check-label">Bag</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="chargerid" name="charger" value="charger" class="form-check-input">
                        <label for="chargerid" class="form-check-label">Charger</label>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <input type="Submit" name="submit" value="Submit Repair" class="btn btn-success">
            </div>
            <div class="col-sm-3"></div>
        </div>


        </form>
        </div>

    </body>
</html>

