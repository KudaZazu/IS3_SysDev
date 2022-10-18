<?php
    require_once("config.php");
    $conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<h2 style=\'color:red;\'>DATABASE ERROR: unable to validate your credentials!</h2>");
    $query5 = "SELECT (select fname from staff where staff.staff_id=job.staff_id) AS fname,
    (select lname from staff where staff.staff_id=job.staff_id) AS lname,
    job.ticket_number,job.status,job.description,
    job.status,(job.end - job.start)/3600 AS hours,
    name,
    (select (parts_stock.cost*parts.quantity) from parts_stock where parts_stock.part_id=parts.part_id) AS cost 
    FROM parts
    RIGHT OUTER JOIN job
    ON job.ticket_number = parts.ticket_number 
    where job.status != 'Not Allocated' and job.staff_id = \"$_GET['id']\" 
    ";
    $visresult4 = mysqli_query($conn, $query5);
    while ($row = mysqli_fetch_array($visresult4))
    {
        $techName = $row['fname']." ".$row['lname'];
        $status = $row['status'];
        $desc = $row['description'];
        echo "<tr>";
        echo  "<td>$techName</td>";
        echo "<td>$status</td>";
        echo "</tr>";
    }
