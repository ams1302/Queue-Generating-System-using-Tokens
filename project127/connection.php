<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'appoinment';
$conn = new mysqli($servername,$username,$password);
$connDB;

if(mysqli_select_db($conn, $dbname)){
    $connDB = new mysqli($servername,$username,$password,$dbname);
}


function createTable($connDB){
    
    if(!mysqli_query($connDB,"DESCRIBE `user`")) {

        $sql = "CREATE TABLE user ( 
            name VARCHAR(50) NOT NULL,
            username VARCHAR(30) PRIMARY KEY,
            password VARCHAR(30) NOT NULL
            )";

        mysqli_query($connDB, $sql);

        $currUser = "SELECT * FROM user";
        $data = mysqli_query($connDB,$currUser);

        if(mysqli_num_rows($data) == 0){
            $default = "INSERT INTO user (name,username,password) VALUES ('Salekin','admin','admin')";
            mysqli_query($connDB, $default);
        }

     } 

    if(!mysqli_query($connDB,"DESCRIBE `doctor`")) {

        $sql = "CREATE TABLE doctor ( 
            id VARCHAR(50) PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL,
            contactNo VARCHAR(50) NOT NULL,
            qualification VARCHAR(50) NOT NULL,
            specialty VARCHAR(50) NOT NULL,
            startTime TIME,
            endTime TIME,
            FULLTEXT(name,email,qualification,specialty)
            )";

        mysqli_query($connDB, $sql);
     }    
     
     if(!mysqli_query($connDB,"DESCRIBE `booking`")) {

        $sql = "CREATE TABLE booking ( 
            id VARCHAR(50) PRIMARY KEY,
            serial INT,
            patientName VARCHAR(50) NOT NULL,
            patientNo VARCHAR(50) NOT NULL,
            patientEmail VARCHAR(50) NOT NULL,
            patientAddress VARCHAR(100) NOT NULL,
            patientGender VARCHAR(20) NOT NULL,
            patientAge VARCHAR(10) NOT NULL,
            doctorName VARCHAR(50) NOT NULL,
            doctorID VARCHAR(50) NOT NULL,
            reason VARCHAR(50),
            appointmentDate DATE
            )";

        mysqli_query($connDB, $sql);
     } 
}

if(mysqli_select_db($conn, $dbname)){
    createTable($connDB);
}
else{
    $sql = "CREATE DATABASE $dbname";
    mysqli_query($conn,$sql);
    $connDB = new mysqli($servername,$username,$password,$dbname);
    createTable($connDB);
}

?>