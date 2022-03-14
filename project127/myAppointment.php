<?php
include 'header.php';
if(!isset($_SESSION['username']) && !isset($_SESSION['bookingID']))
    header('Location: index.php');

$id = isset($_SESSION['bookingID']) ? $_SESSION['bookingID'] : $_POST['id'];
$sql = "SELECT * FROM booking WHERE BINARY id='$id'";

$data = mysqli_query($connDB,$sql);
if(mysqli_num_rows($data)>0)
    $data= $data->fetch_object();
else
    header('Location: index.php');

$serial = $data->serial;
$patientName = $data->patientName;
$patientNo = $data->patientNo;
$patientEmail = $data->patientEmail;
$patientAddress = $data->patientAddress;
$patientGender = $data->patientGender;
$patientAge = $data->patientAge;
$doctorName = $data->doctorName;
$doctorID = $data->doctorID;
$date = $data->appointmentDate;
$reason = $data->reason;
$gender = array();
array_push($gender,'male');
array_push($gender,'female');
array_push($gender,'others');

$startTime = '';
$endTime = '';
function formatTime($time){
        $date = new DateTime("2020-09-27 ".$time);
        return $date->format('h:ia') ;
    }
$sql = "SELECT * FROM doctor WHERE BINARY id='$doctorID'";
$data = mysqli_query($connDB,$sql);
if(mysqli_num_rows($data)>0)
{
    $data= $data->fetch_object();
    $startTime = formatTime($data->startTime);
    $endTime = formatTime($data->endTime);
}

if(isset($_POST['update'])){
    $patientName = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $date = $_POST['date'];

    $patientGender = empty($_POST['gender']) ? 'others' : $_POST['gender'];
    $reason = empty($_POST['reason']) ? $reason = '---' : $_POST['reason'];

    $sql = "UPDATE booking SET patientName='$patientName', patientEmail='$email', patientNo='$contact',patientAddress='$address', 
            patientGender='$patientGender',patientAge='$age',reason='$reason' WHERE BINARY id='$id' ";

    if(mysqli_query($connDB,$sql)){
        echo "<script>
        alert('Appointment has been updated.');
        window.location.href='myappointment.php';
        </script>";
    }
    else{
        $alertMsg = "<strong>Failed!</strong> Please provide valid information to update.";
        $alertType = "alert-danger";
    }
    include 'alert.php';
}
else if(isset($_POST['delete'])){
    
    $sql = "DELETE FROM booking WHERE id='$id'";

    if(mysqli_query($connDB,$sql)){
        if(isset($_SESSION['username'])){
            header('Location: appointmentList.php');
        }
        echo "<script>
        alert('Appointment has been deleted.');
        window.location.href='login.php';
        </script>";
    }
    else{
        $alertMsg = "<strong>Failed!</strong> Please try again later.";
        $alertType = "alert-danger";
        include 'alert.php';
    }
    
}
?>


<style>
.container h3{
    text-align: center;
    padding: 5px;
    color: #495057;
    text-decoration: underline;
}
</style>
<div class="container mt-3">
   <h3>Serial No. <?= $serial; ?></h3>
   <!--<h3><small><mark><?= $startTime.'-'.$endTime; ?></mark></small></h3>-->
    <form class="col-10 mx-auto mt-3" action="" method="POST">

    <input type="text" name="id" value="<?= $id; ?>" hidden>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="select">Doctor</label>
                <select id="select" class="form-control" name="doctorID">
                        <?php
                            echo "<option selected>".ucwords($doctorName)."</option>";
                        ?>
                    </select>
            </div>
            <div class="form-group col-md-6">
                <label for="select">Appointment Date</label>
                <select id="select" class="form-control" name="date">
                        <?php
                            echo  "<option selected>".$date."</option>";
                        ?>
                    </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Patient Name</label>
                <input type="text" class="form-control" id="name" value="<?= $patientName; ?>" name="name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="<?= $patientEmail; ?>" name="email" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="contact">Contact No.</label>
                <input type="text" class="form-control" id="contact" value="<?= $patientNo; ?>" name="contact" required>
            </div>
    
            <div class="form-group col-md-6">
                <label for="gender">Gender</label>
                <select id="gender" class="form-control" name="gender">
                <?php
                foreach($gender as $value){
                    if($value == $patientGender)
                        echo "<option value='$value' selected>".ucfirst($value)."</option>";
                    else
                        echo "<option value='$value'>".ucfirst($value)."</option>";
                }
                ?>
                    </select>
            </div>

        </div>

        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="age">Age</label>
                <input type="text" class="form-control" id="age" name="age" value="<?= $patientAge; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" value="<?= $patientAddress; ?>" name="address" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="reason">Reason For Appoinment</label>
                <input type="text" class="form-control" id="reason" name="reason"  value="<?= $reason; ?>">
            </div>
        </div>
        
       <div class="form-row">
       <button type="button" class="btn btn-danger col-md-3 mx-auto mb-1" data-toggle="modal" data-target="#modal">Delete</button>
        <input type="submit" class="btn btn-primary col-md-3 mx-auto" value="Update" name="update">
       </div>
       <div class="modal" id="modal" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title">Are You Sure to Cancel This Appointment?</p>
                            <button type="button" class="close" data-dismiss="modal" data-target="modal">&times;</button>
                        </div>

                        <div class="modal-footer">
                            <div class="confirm d-flex justify-content-end">
                                <button type="button" data-dismiss="modal" class="btn btn-outline-primary btn-sm">Cancel</button>
                                <button type="submit" name="delete" class="btn btn-outline-danger btn-sm ml-2">Yes</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div> 
    </form>
</div>
