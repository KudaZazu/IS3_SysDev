<?php
    //device values
    $devicename = $_REQUEST['devicename'];
    $devicenumber = $_REQUEST['devicenumber'];
    $type = $_REQUEST['type'];
    $descrption = $_REQUEST['descrption'];
    if (isset($_FILES['faultimage']['name'])) {
        $faultimage = time() . $_FILES['faultimage']['name'];
        $dest = "Fault_Images/" . $faultimage;
        move_uploaded_file($_FILES['faultimage']['tmp_name'], $dest);
    }



    $query = "SELECT customer_id FROM ctrlintelligence.customer 
                     WHERE userID = '$userID'";
    $result = mysqli_query($conn, $query)
        or die("<h1 style=color:red;> Could not execute query! </h1>");
    $row = mysqli_fetch_array($result);
    $cust_id = $row['customer_id'];

    $query = "INSERT INTO devices(customer_id, name, type)
         VALUE('$cust_id','$devicename','$type')";
    $result = mysqli_query($conn, $query)
        or die("<h1 style=color:red;> Could not execute query! </h1>");

    $query = "SELECT device_id FROM ctrlintelligence.devices 
             WHERE customer_id = '$cust_id'";
    $result = mysqli_query($conn, $query)
        or die("<h1 style=color:red;> Could not execute query! </h1>");
    $row = mysqli_fetch_array($result);
    $dev_id = $row['device_id'];

    if (isset($_REQUEST['mouse'])) {
        $query = "INSERT INTO peripherals(device_id, peripheral_name)
             VALUE('$dev_id','{$_REQUEST['mouse']}')";
        $result = mysqli_query($conn, $query)
            or die("<h1 style=color:red;> Could not execute query! </h1>");
    }
    if (isset($_REQUEST['bag'])) {
        $query = "INSERT INTO peripherals(device_id, peripheral_name)
             VALUE('$dev_id','{$_REQUEST['bag']}')";
        $result = mysqli_query($conn, $query)
            or die("<h1 style=color:red;> Could not execute query! </h1>");
    }
    if (isset($_REQUEST['charger'])) {
        $query = "INSERT INTO peripherals(device_id, peripheral_name)
             VALUE('$dev_id','{$_REQUEST['charger']}')";
        $result = mysqli_query($conn, $query)
            or die("<h1 style=color:red;> Could not execute query! </h1>");
    }



    $date = date("Y-m-d H:i:s");
    if ($_FILES['faultimage']['name']) {
        $query = "INSERT INTO ctrlintelligence.job(customer_id, device_id, status, start, description, fault_image)
                VALUE('$cust_id','$dev_id','Not allocated','$date', '$descrption', '$faultimage')";
        $result = mysqli_query($conn, $query)
            or die("<h1 style=color:red;> Could not execute query! </h1>" . mysqli_error($conn));
    } else {
        $query = "INSERT INTO ctrlintelligence.job(customer_id, device_id, status, start, description)
                VALUE('$cust_id','$dev_id','Not allocated','$date', '$descrption')";
        $result = mysqli_query($conn, $query)
            or die("<h1 style=color:red;> Could not execute query! </h1>" . mysqli_error($conn));
    }


    mysqli_close($conn);

    header("Location: newTicket.php");