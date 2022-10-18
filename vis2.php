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
                    $query3 = "SELECT status, count(status)  FROM job
                    group by status";
                    $visresult2 = mysqli_query($conn, $query3);
                    echo "var data = google.visualization.arrayToDataTable([";
                    echo "['status', 'count(status)'],";
                    while ($row = mysqli_fetch_array($visresult2))
                    {
                        $num++;
                        $status = $row['status'];
                        $count = $row['count(status)'];
                        if($num < mysqli_num_rows($visresult2))
                        {
                            echo "['$status',$count],";
                        }else{
                            echo "['$status',$count]";
                        }
                    }
                    echo "]);";
                    ?>
                var options = {
                    title: 'Job Status'
                };
                var chart = new google.visualization.PieChart(document.getElementById("chart_div2"));;
                chart.draw(data,options);
            }
</script>
