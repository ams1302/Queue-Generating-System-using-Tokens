<?php
include 'header.php';
if(!isset($_SESSION['username']))
    header('Location: index.php');
?>
       <link rel="stylesheet" href="css/adminPanel.css">

        <div class="boxes d-flex">
            <a href="addDoctor.php" class="box themed-grid-col">
                <img src="img/add.png" class="mx-auto d-block" alt="">
                <h6>Add a New Doctor</h6>
            </a>
            <a href="doctors.php" class="box themed-grid-col">
                <img src="img/update.png" class="mx-auto d-block" alt="">
                <h6>Doctor List</h6>
            </a>

            <a href="appointmentList.php" class="box themed-grid-col">
                <img src="img/list.png" class="mx-auto d-block" alt="">
                <h6>Appointment List</h6>
            </a>
            <a href="addAdmin.php" class="box themed-grid-col">
                <img src="img/admin.png" class="mx-auto d-block" alt="">
                <h6>Add another Admin</h6>
            </a>
        </div>

        <br>
