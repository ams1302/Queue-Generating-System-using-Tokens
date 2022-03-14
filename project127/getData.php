<?php
include('connection.php');

$doctors=array();
$sql = "SELECT * FROM doctor";
$result = mysqli_query($connDB,$sql);

function formatTime($time){
    $date = new DateTime("2020-09-27 ".$time);
    return $date->format('h:ia') ;
}

while($row = $result->fetch_assoc()) {
    $startTime = formatTime($row['startTime']);
    $endTime = formatTime($row['endTime']);
    $doctor = array(
        "id" => $row['id'],
        "name" => $row['name'],
        "email" => $row['email'],
        "qualification" => $row['qualification'],
        "specialty" => $row['specialty'],
        "startTime" => $startTime,
        "endTime" => $endTime
    );
    array_push($doctors,$doctor);
}
echo json_encode($doctors);

?>
