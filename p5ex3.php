<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart(){
            <?php
                //database credentials
                require_once("config.php");
                //connection to database
                $conn = mysqli_connect(SERVERNAME,USERNAME, PASSWORD, DATABASE)
                or die("<h1 style=color:red;> Could not connect to database! </h1>");

                //issue query instructions
                $query = "SELECT customerName, sum(amount)
                FROM payments
                INNER JOIN customers
                ON payments.customerNumber = customers.customerNumber
                GROUP BY payments.customerNumber, customers.customerNumber
                ORDER BY sum(amount) DESC
                LIMIT 5";

                $result = mysqli_query($conn,$query)
                or die("<h1 style=color:red;> Could not execute query! </h1>");

                echo "var data = google.visualization.arrayToDataTable([ ";
                echo "['Customers', 'Amount'],";
                while ($row = mysqli_fetch_array($result)) {
                    echo "['{$row['customerName']}', {$row['sum(amount)']}],";
                }
                echo "]);";

                //close connection
                mysqli_close($conn);

                
            ?> 
            var options = {
                title: "Amount Spent by Top 5 customers",
                width: 1300,
                height: 700,
                bar: {groupWidth: "50%"},
                legend: { position: "right" },
                hAxis: {
                    title: 'Customers'
                },
                vAxis: {
                    title: 'Rands'
                },
            };

            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart.draw(data, options);
        }

        
    </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="columnchart_values" style="width: 100%; height: 100%;"></div>
</body>
</html>