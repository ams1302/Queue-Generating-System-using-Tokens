
<?php
include 'header.php';


$days = array();
for($i=0;$i<3;$i++){
    array_push($days,date('Y-m-d', strtotime(' +'.$i.' day')));
}

$departments = array();
$doctors = array();
$sql = "SELECT * FROM doctor";
$result = mysqli_query($connDB,$sql);
while($row = $result->fetch_assoc()) {

    $specialty = $row['specialty'];
    $name = $row['name'];
    $id = $row['id'];

    $doctors[$id] = $name;
    if(strpos($specialty,','))
    {
        $arr = explode(',',$specialty);
        $departments = array_merge($departments,$arr);
    }
    else{
        array_push($departments,$specialty);
    }
    $departments = array_unique($departments);
}

if(isset($_POST['book'])){
    $patientName = $_POST['name'];
    $email = $_POST['email'];
    $patientNo = $_POST['contact'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $date = $_POST['date'];
    $doctorID = $_POST['doctorID'];
    $bookingID = uniqid('ap');

    $gender = isset($_POST['gender']) ? $_POST['gender'] : 'unknown';

    if(empty($_POST['reason']))
    {
        $reason = '---';
    }
    else
    {
        $reason = $_POST['reason'];
    }

    $sql = "SELECT * FROM booking WHERE BINARY doctorID='$doctorID' AND appointmentDate='$date'";
    $data = mysqli_query($connDB,$sql);
    $serial = mysqli_num_rows($data) + 1;
    $sql = "SELECT name FROM doctor WHERE BINARY id='$doctorID'";
    $doctorName = mysqli_query($connDB,$sql)->fetch_object()->name;

    $sql = "INSERT INTO booking 
        (id,serial,patientName,patientNo,patientEmail,patientAddress,patientGender,patientAge,doctorName,doctorID,reason,appointmentDate) VALUES 
        ('$bookingID','$serial','$patientName','$patientNo','$email','$address','$gender','$age','$doctorName','$doctorID','$reason','$date')";

    if(mysqli_query($connDB,$sql) ){
        echo "<script>alert('Appointment Successful. Please remember your booking id ($bookingID) for further modification.')</script>";
        echo "<h4 class='booking-id'>Booking ID: ".$bookingID."</h4>";
    }
    else{
        echo "<script>alert('Appointment Failed! Please try again later.');</script>";
    }
}
else if(isset($_POST['fixedDoctor'])){
    $id = $_POST['id'];
    $sql = "SELECT * FROM doctor WHERE BINARY id='$id'";

    $data = mysqli_query($connDB,$sql);
    if(mysqli_num_rows($data)>0)
        $data= $data->fetch_object();
    else
        echo "<script>alert('Doctor Not Found!');
        window.location.href='index.php';
        </script>";

    $doctorName = $data->name;
}
?>
<html>
<body>

<div class="container mt-4">
    <form class="col-lg-10 mx-auto" action="" method="POST">
    <fieldset>
            <legend>New Appointment</legend>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="department">Department</label>
                <select id="department" class="form-control" name="department">
                        <option selected disabled>Choose...</option>
                        <?php
                        if(!isset($_POST['fixedDoctor'])){
                            foreach($departments as $val){
                               echo  "<option value='$val'>".ucwords($val)."</option>";
                                }
                        }
                        ?>
                    </select>
            </div>
            <div class="form-group col-md-6">
                <label for="doctor">Doctor</label>
                <select id="doctor" class="form-control" name="doctorID">
                        <option selected disabled>Choose...</option>
                        <?php
                        if(isset($_POST['fixedDoctor'])){
                            echo "<option value='$id' selected>".ucwords($doctorName)."</option>";
                        }
                        else{
                            foreach($doctors as $id => $name){
                                echo "<option value='$id'>".ucwords($name)."</option>";
                            }
                        }
                        ?>
                    </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="contact">Contact No.</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
            </div>
            <div class="form-group col-md-6">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="select">Gender</label>
                <select id="select" class="form-control" name="gender" required>
                        <option value="unknown" selected disabled>Choose...</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </select>
            </div>
            <div class="form-group col-md-6">
                <label for="age">Age</label>
                <input type="text" class="form-control" id="age" name="age" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="select">Pick a Suitable Date</label>
            <!--
                <select id="select" class="form-control" name="date" required>
                        <option selected disabled>Choose...</option>
                        <?php
                        /*
                        foreach($days as $day){
                        echo "<option value='$day'>$day (".date_format(new DateTime($day),'D').")</option>";
                        }
                            */
                        ?>
                    </select>
        -->      
                
                    <!--<input type="date" name="date" id="datepicker">
                    <script>
                            $(function () {
                            $("#datepicker").datepicker();            
                            });
                    </script>-->
                    <input type="text" id="datetimepicker" name =date value="<?php echo date('Y-m-d h:i'); ?>">
<script type="text/javascript">		
$(function(){
    $('#datetimepicker').appendDtpicker();		
});	</script>
                          
                    

            </div>

            <div class="form-group col-md-8">
                <label for="reason">Reason For Appoinment</label>
                <input type="text" class="form-control" id="reason" name="reason">
            </div>
        </div>
        <div class="form-row">
       <input type="submit" class="btn btn-primary col-md-3 col-sm-2 mx-auto mb-1" value="Submit" name="book">
       </div>
       </fieldset>
    </form>
</div>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="src/jquery.simple-dtpicker.js"></script>
    <link type="text/css" href="src/jquery.simple-dtpicker.css" rel="stylesheet" />
<script src="js/appointment.js"></script>
