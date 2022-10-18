<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current',{
                'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart1);

            function drawChart1()
            {
                <?php
                    require_once("config.php");
                    $num = 0;
                    $conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h2 style=\'color:red;\'>DATABASE ERROR: unable to validate your credentials!</h2>");
                    $query5 = "SELECT device_id, count(device_id)  FROM job
                    group by device_id";
                    $visresult4 = mysqli_query($conn, $query5);
                    echo "var data = google.visualization.arrayToDataTable([";
                    echo "['device_id', 'Times Repaired'],";
                    while ($row = mysqli_fetch_array($visresult4))
                    {
                        $num++;
                        $id = $row['device_id'];
                        $count = $row['count(device_id)'];
                        if($num < mysqli_num_rows($visresult2))
                        {
                            echo "['$id',$count],";
                        }else{
                            echo "['$id',$count]";
                        }
                    }
                    echo "]);";
                    ?>
                var options = {
                    title: 'Device repair frequency'
                };
                var chart = new google.visualization.PieChart(document.getElementById("chart_div2"));;
                chart.draw(data,options);
            }
</script>

<body>
    <div id="chart_div2" style="width: 900px; height: 600px;"></div>
</body>
