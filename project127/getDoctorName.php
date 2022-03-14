<?php
include('connection.php');

$department = json_decode($_POST['department']);
$doctors = array();
$sql = "SELECT * FROM doctor WHERE specialty LIKE '%$department%'";
$result = mysqli_query($connDB,$sql);
while ($row = $result->fetch_assoc()) {
    $doctor = array(
        "id" => $row['id'],
        "name" => $row['name']
    );
   array_push($doctors,$doctor);
}
echo json_encode($doctors);

?>

