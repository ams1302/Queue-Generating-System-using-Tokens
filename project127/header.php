<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Appointment</title>
    <link rel="icon" href="img/icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!--
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    script>
                                            $(function () {
                                            $("#datepicker").datepicker();            
                                            });
                                            </script>
                                            -->



</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <a class="navbar-brand ml-lg-5" href="#">
            <img src="img/doctor.png" alt="logo"> e-Care Doctor Appointment
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">         
                <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="appointment.php">New Appointment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Search</a>
                </li>
            <?php
            session_start();
            if(isset($_SESSION['username'])){
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="img/user.png" alt="">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="adminPanel.php">Admin Panel</a>
                    <a class="dropdown-item" href="myProfile.php">My Profile</a>
                    <a class="dropdown-item" href="login.php">Logout</a>
                    </div>
                </li>
                <?php
            }
            else if(isset($_SESSION['bookingID'])){
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="img/appointment.png" alt="">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="myAppointment.php">My Appointment</a>
                    <a class="dropdown-item" href="login.php">Logout</a>
                    </div>
                </li>
                <?php
            }
            else{
                ?>
                <li class="nav-item login">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <?php
            }
            ?>
            </ul>
            
        </div>
    </nav>

    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>