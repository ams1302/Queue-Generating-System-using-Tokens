<?php
include 'header.php';
if(!isset($_SESSION['username']))
    header('Location: index.php');
?>
    <div class="container mt-5">
        <table class="table table-striped table-dark table-responsive-sm text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Patient Number</th>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Date</th>
                    <th scope="col">Details</th>

                </tr>
            </thead>
            <tbody>

<?php
$sql = "SELECT * FROM booking";
$result = mysqli_query($connDB,$sql);
while($row = $result->fetch_assoc()) {

?>
         
    <form action="myAppointment.php" method="POST">
    <tr>
        <input type="text" name="id" value="<?= $row['id']; ?>" hidden>
        <td><?= $row['id']; ?></td>
        <td><?= $row['patientName']; ?></td>
        <td><?= $row['patientNo']; ?></td>
        <td><?= $row['doctorName']; ?></td>
        <td><?= $row['reason']; ?></td>
        <td><?= $row['appointmentDate']; ?></td>
        <td>   
            <button type="submit" class="btn btn-outline-primary py-0 px-2 btn-sm" name="edit">
            View
            </button>
        </td> 
    </tr>
    </form>

<?php

}
?>
              
            </tbody>
        </table>
    </div>
