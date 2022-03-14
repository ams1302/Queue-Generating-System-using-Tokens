<?php

include 'header.php';
if(!isset($_SESSION['username']))
    header('Location: index.php');

?>
<style>
    .table-responsive{
        display: table;
        display: block;
    }
    
</style>
<div class="container mt-5">
        <table class="table table-dark table-responsive-sm text-center">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contuct Number</th>
                    <th>Qualification</th>
                    <th>Specialty</th>
                    <th>Edit/Remove</th>

                </tr>
            </thead>
            <tbody>

<?php
$sql = "SELECT * FROM doctor";
$result = mysqli_query($connDB,$sql);
while($row = $result->fetch_assoc()) {

?> <tr>
    <form action="docProfile.php" method="POST">
   
        <input type="text" name="id" value="<?= $row['id']; ?>" hidden>
        <td><?= $row['name']; ?></td>
        <td><?= $row['email']; ?></td>
        <td><?= $row['contactNo']; ?></td>
        <td><?= $row['qualification']; ?></td>
        <td><?= $row['specialty']; ?></td>
        <td>   
            <button type="submit" class="btn p-0" name="edit">
            <img src="img/editProfile.png" class="icon" alt="menu">
            </button>
        </td> 
    </form>
    </tr>

<?php

}
?>
              
            </tbody>
        </table>
    </div>
    </div>