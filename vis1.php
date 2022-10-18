<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current',{
                'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                <?php
                    require_once("config.php");
                    $num = 0;
                    $conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h2 style=\'color:red;\'>DATABASE ERROR: unable to validate your credentials!</h2>");
                    $query2 = "select distinct fname,lname, count(job.staff_id) AS Jobs from staff INNER JOIN job ON job.staff_id = staff.staff_id GROUP BY job.staff_id limit 5";
                    $visresult1 = mysqli_query($conn, $query2);
                    echo "var data = google.visualization.arrayToDataTable([";
                    echo "['status', 'count(status)'],";
                    while ($row = mysqli_fetch_array($visresult1))
                    {
                        $num++;
                        $name = $row['fname']." ".$row['lname'];
                        $count = $row['Jobs'];
                        if($num < mysqli_num_rows($visresult1))
                        {
                            echo "['$name','$count'],";
                        }else{
                            echo "['$name','$count']";
                        }
                    }
                    echo "]);";
                    ?>
                var options{
                    title: 'Bar graph'
                }
                var chart = new google.visualization.BarChart(document.getElementById("chart_div"));
                chart.draw(data,options);
            }
</script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vis1</title>
</head>
<body>
    <div id="chart_div" style="width: 900px; height: 600px;"></div>
</body>
