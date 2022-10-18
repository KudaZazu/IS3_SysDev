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
        <br><br>
        <table>
            <tr>
                <th>Name (Part)</th>
                <th>Quantity</th>
                <th>Employee</th>
                <th>Cost (Parts)</th>
                <th>Total Cost</th>
            </tr>
        ";

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
    echo "</body>";
//}
?>