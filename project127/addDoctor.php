<?php
include 'header.php';
if(!isset($_SESSION['username']))
    header('Location: index.php');

if(isset($_POST['addDoctor'])){
   $id = uniqid('doc');
   $name=$_POST['name'];
   $email=$_POST['email'];
   $contactNo=$_POST['contactNo'];
   $qualification=$_POST['qualification'];
   $specialty=$_POST['specialty'];
   $startTime=$_POST['startTime'];
   $endTime=$_POST['endTime'];
   $specialty = preg_replace('/\s*,\s*/', ',', $specialty);
   
   $sql = "SELECT * FROM doctor WHERE BINARY email = '$email' OR BINARY contactNo = '$contactNo'";
   $data = mysqli_query($connDB,$sql);
   
   $rows = mysqli_num_rows($data);

   $sql = "INSERT INTO doctor (id,name,email,contactNo,qualification,specialty,startTime,endTime) VALUES ('$id','$name','$email','$contactNo','$qualification','$specialty','$startTime','$endTime')";
   
   $alertMsg = "<strong>Failed!</strong> Doctor already exists with given information.";
   $alertType = "alert-danger";

   if($rows == 0){
       if(mysqli_query($connDB,$sql)){
       $alertMsg = "<strong>Success!</strong> New doctor profile has been added.";
       $alertType = "alert-success";
       }
   }
       
       include 'alert.php';
      
}
?>

</style>
<div class="container mt-4">
        <form method="POST" action="" class="col-md-8 mx-auto" autocomplete="off">
        <fieldset>
            <legend>Add Doctor</legend>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email id" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="contact">Contact No.</label>
                    <input type="text" class="form-control" id="contact" name="contactNo" placeholder="Enter contact no." required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="qualification">Qualification</label>
                    <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Enter qualification" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="specialty">Specialty</label>
                    <input type="text" class="form-control" id="specialty" name="specialty" placeholder="Which disease specialist? (Use comma for multiple entries)" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="specialty">Visiting Hour(Start)</label>
                    <input type="time" class="form-control" id="specialty" name="startTime" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="specialty">Visiting Hour(End)</label>
                    <input type="time" class="form-control" id="specialty" name="endTime" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                <input class="btn btn-success mt-2 pl-3 pr-3" type="submit" name="addDoctor" value="Add"/>
                </div>
            </div>
            </fieldset>
        </form>

</div>