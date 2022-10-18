<?php

session_start();
//if (isset($_SESSION['acesssStaff'])) {

    echo "
    <head>
        <meta charset=\"UTF-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <script src=\"https://kit.fontawesome.com/e92da86d17.js\" crossorigin=\"anonymous\"></script>
        <link href=\"Start.css\" type=\"text/css\" rel=\"stylesheet\">
        <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js\"></script>
        <title>Ctrl Solution - Reports</title>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            
            td,
            th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            
            tr:nth-child(even) {
                background-color: #dbdada91;
            }
        </style>
    </head>

    <body>

        <nav class=\"navbar navbar-expand-sm bg-dark navbar-dark\">

            <a class=\"navbar-brand\" href=\"#\">
                <img src=\"images/CI.png\" alt=\"Logo\" style=\"width:40px;\" class=\"rounded-pill\">
            </a>
            <a href=\"#\" class=\"nav-item\">Home</a>
            <a href=\"newTicket.php\" class=\"nav-item\">New Ticket</a>
            <a href=\"Job_Staff.php\" class=\"nav-item\">Jobs</a>
            <a href=\"Allocate.php\" class=\"nav-item\">Allocate</a>
            <a href=\"reports1.php\" class=\"nav-item\">Reports</a>
            <a href=\"logout.php\" class=\"nav-item\"><i class=\"fa-question rounded-pill\"></i></a>
        </nav>
        <br><br>";
        echo "<h2>The Department At A Glance:</h2>";
        echo "<div style=\"float: left;\">";
        require_once("vis3.php");
        echo "<div id=\"chart_div\" style=\"width: 900px; height: 600px;\"></div>";
        echo "</div>";
    
        echo "<div style=\"float: right;\">";
            require_once("vis2.php");
            echo "<div id=\"chart_div2\" style=\"width: 900px; height: 600px;\"></div>";
        echo "</div>";

        echo"
            <h2>Jobs:</h2>
            <table>
                <tr>
                    <th>Technician</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Progress</th>
                    <th>Parts Used</th>
                    <th>Cost (Parts)</th>
                    <th>Labour (R66 per hour)</th> 
                </tr>
        ";

    require_once("config.php");
    $conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h2 style=\'color:red;\'>DATABASE ERROR: unable to validate your credentials!</h2>");
    $query1 = "
    SELECT (select fname from staff where staff.staff_id=job.staff_id) AS fname,
    (select lname from staff where staff.staff_id=job.staff_id) AS lname,
    job.ticket_number,job.status,job.description,
    job.status,
    name,
    (select (parts_stock.cost*parts.quantity) from parts_stock where parts_stock.part_id=parts.part_id) AS cost 
    FROM parts
    RIGHT OUTER JOIN job
    ON job.ticket_number = parts.ticket_number 
    where job.status != 'Not Allocated'
    ";
    $result = mysqli_query($conn, $query1);
    echo"$conn->error";


    $query4 = "SELECT description, count(distinct description)  FROM job
    group by description";
    $visresult3 = mysqli_query($conn, $query4);

    $query5 ="SELECT device_id, count(device_id)  FROM job
    group by device_id";
    $visresult4 = mysqli_query($conn, $query5);
    
    while ($row = mysqli_fetch_array($result)){

        $techName = $row['fname']." ".$row['lname'];
        $status = $row['status'];
        $desc = $row['description'];
        echo "<tr>";
        echo  "<td>$techName</td>";
        echo "<td>$status</td>";
        echo "<td>$desc</td>";

        if($status == "Completed")
        {
            echo "<td>
            <div class=\"progress\">
                <div class=\"progress-bar bg-success\" role=\"progressbar\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:100%\">
                    100% Complete (success)
            </div>
            </div>
            </td>";

        }

        if($status == "In Process")
        {
            echo "<td>
            <div class=\"progress\">
                <div class=\"progress-bar progress-bar-striped bg-warning progress-bar-animated\" role=\"progressbar\" aria-valuenow=\"50\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:50%\">
                    50% Complete (in progress)
            </div>
            </div>
            </td>";
        }

        if($row['name'] == "")
        {
            echo "<td></td>";
        }else{
            echo "<td>". $row['name'] ."</td>";
        }

        if($row['cost'] == "")
        {
            echo "<td></td>";
        }else{
            $cost = "R ".$row['cost'];
            echo "<td>$cost</td>";
        }

        echo "</tr>";
    }

    echo "</table>";

    echo "<br><br>";
    echo "<h2>Parts on hand:</h2>";
    echo"
    <table>
    <tr>
        <th>Name (Part)</th>
        <th>Quantity</th>
        <th>Employee</th>
        <th>Cost (Parts)</th>
        <th>Total Cost</th>
    </tr>";

    require_once("config.php");
    $conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h2 style=\'color:red;\'>DATABASE ERROR: unable to validate your credentials!</h2>");
    $query = "SELECT * FROM parts_stock";
    $result = mysqli_query($conn, $query);
    $tsum = 0; 
    while ($row = mysqli_fetch_array($result)){

    $sname = $row['name'];
    $qty = $row['quantity'];
    $employee = $row['employee'];
    $cost = $row['cost'];
    $tcost = $qty * $cost;
    $tsum = $tsum + $tcost;

    echo "<tr>";
    echo  "<td>$sname</td>";
    echo "<td>$qty</td>";
    echo "<td>$employee</td>";
    echo "<td>R $cost</td>";
    echo "<td>R $tcost</td>";
    echo "</tr>";
    }

    echo "<td></td><td></td><td></td><td></td><td>Total: R $tsum</td>";
    echo "</table>";

    echo "<div style=\"width: 50%;\">";
    require_once("vis3.php");
    echo "<div id=\"chart_div\" style=\"width: 900px; height: 600px;\"></div>";
    echo "</div>";

    echo "<div style=\"width: 50%;\">";
        require_once("vis2.php");
        echo "<div id=\"chart_div2\" style=\"width: 900px; height: 600px;\"></div>";
    echo "</div>";

    echo "<a href=\"generateReports.html\">Generate Reports</a>";
    echo "</body>";
//}
?>