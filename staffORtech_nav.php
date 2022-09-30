<!-- Update 2022/09/28 13:33 by Kenneth Chieza 
functionality to switch navbar depending on if staff/tech is logged in
-->
<?php
if (isset($_SESSION['acesssTech'])) {
    echo
    "
            <a class=\"nav-item\" href=\"index_tech.php\">Home</a>
            <a class=\"nav-item\" href=\"NewTicket.php\">New Ticket</a>
            <a class=\"nav-item\" href=\"Job_Staff.php\">Jobs</a>
            <a class=\"nav-item\" href=\"Update_Tech.php\">Update</a>
            <a class=\"nav-item\" href=\"Orders_Tech.php\">Order</a>
            <a class=\"nav-item\" href=\"logout.php\" class=\"nav-item\"><i class=\"fa-circle-question rounded-pill\"></i></a>
            ";
} elseif (isset($_SESSION['acesssStaff'])) {
    echo
    "
            <a class=\"nav-item\" href=\"index_staff.php\" >Home</a>
            <a class=\"nav-item\" href=\"NewTicket.php\">New Ticket</a>
            <a class=\"nav-item\" href=\"Job_Staff.php\">Jobs</a>
            <a class=\"nav-item\" href=\"Allocate.php\">Allocate</a>
            <a class=\"nav-item\" href=\"#\" class=\"nav-item\">Reports</a>
            <a class=\"nav-item\" href=\"logout.php\" class=\"nav-item\"><i class=\"fa-circle-question rounded-pill\"></i></a>
            ";
}