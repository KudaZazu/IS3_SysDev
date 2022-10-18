<!-- Update 2022/09/28 13:33 by Kenneth Chieza 
functionality to switch navbar depending on if staff/tech is logged in
-->
<?php
if (isset($_SESSION['acesssTech'])) {
    echo
    "
    <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark mb-4 py-4\">

        <div class=\"container-fluid\">
            <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#collapsibleNavbar\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>
            <div class=\"collapse navbar-collapse justify-content-center\" id=\"collapsibleNavbar\">

                <ul class=\"navbar-nav text-uppercase \">
                    <li class=\"nav-item px-5\">
                        <a class=\"nav-link \" href=\"index_tech.php\">Home</a>
                    </li>
                    <li class=\"nav-item px-5\">
                        <a class=\"nav-link \" href=\"newTicket.php\">New Ticket</a>
                    </li>
                    <li class=\"nav-item px-5\">
                        <a class=\"nav-link active\" href=\"Job_Staff.php\">Jobs</a>
                    </li>
                   
                    <li class=\"nav-item px-5\">
                        <a class=\"nav-link\" href=\"Orders_Tech.php\">Orders</a>
                    </li>
                    <li class=\"nav-item px-5\">
                        <a href=\"logout.php\" class=\"nav-link\"><i class=\"fa-solid fa-right-from-bracket\"> Logout</i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>";
} elseif (isset($_SESSION['acesssStaff'])) {
    echo
    "
    <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark mb-4 py-4\">

        <div class=\"container-fluid\">
            <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#collapsibleNavbar\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>
            <div class=\"collapse navbar-collapse justify-content-center\" id=\"collapsibleNavbar\">

                <ul class=\"navbar-nav text-uppercase \">
                    <li class=\"nav-item px-5\">
                        <a class=\"nav-link \" href=\"index_staff.php\">Home</a>
                    </li>
                    <li class=\"nav-item px-5\">
                        <a class=\"nav-link \" href=\"newTicket.php\">New Ticket</a>
                    </li>
                    <li class=\"nav-item px-5\">
                        <a class=\"nav-link active\" href=\"Job_Staff.php\">Jobs</a>
                    </li>
                    
                    <li class=\"nav-item px-5\">
                        <a href=\"logout.php\" class=\"nav-link\"><i class=\"fa-solid fa-right-from-bracket\"> Logout</i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>";
}