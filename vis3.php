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
                    $query4 = "SELECT description, count(description)  FROM job
                    group by description";
                    $visresult3 = mysqli_query($conn, $query4);
                    echo "var data = google.visualization.arrayToDataTable([";
                    echo "['status', 'frequency'],";
                    while ($row = mysqli_fetch_array($visresult3))
                    {
                        $num++;
                        $desc = $row['description'];
                        $count = $row['count(description)'];
                        if($num < mysqli_num_rows($visresult3))
                        {
                            echo "['$desc',$count],";
                        }else{
                            echo "['$desc',$count]";
                        }
                    }
                    echo "]);";
                    ?>
                var options = {
                    title: 'Common problems'
                };
                var chart = new google.visualization.PieChart(document.getElementById("chart_div"));
                chart.draw(data,options);
            }
</script>
