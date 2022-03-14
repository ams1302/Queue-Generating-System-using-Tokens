<?php
    include 'header.php';
    if(!isset($_SESSION['username']))
        header('Location: index.php');

    function getProfile($id,$connDB){
        $sql = "SELECT * FROM doctor WHERE BINARY id = '$id'";
        $data = mysqli_query($connDB,$sql);

        $doctor = mysqli_fetch_array($data);
        
        $name = $doctor['name'];
        $email = $doctor['email'];
        $contactNo = $doctor['contactNo'];
        $qualification = $doctor['qualification'];
        $specialty = $doctor['specialty'];
        $startTime=$doctor['startTime'];
        $endTime=$doctor['endTime'];
    }

    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $sql = "SELECT * FROM doctor WHERE BINARY id = '$id'";
        $data = mysqli_query($connDB,$sql);
        $doctor = mysqli_fetch_array($data);
        
        $name = $doctor['name'];
        $email = $doctor['email'];
        $contactNo = $doctor['contactNo'];
        $qualification = $doctor['qualification'];
        $specialty = $doctor['specialty'];
        $specialty = preg_replace('/\s*,\s*/', ',', $specialty);
        $startTime=$doctor['startTime'];
        $endTime=$doctor['endTime'];
    }
    else if(isset($_POST['delete'])){
        $id = $_POST['id'];
        
        $sql = "DELETE FROM doctor WHERE id='$id'";

        if(mysqli_query($connDB,$sql)){
            echo "<script>
            alert('Profile has been deleted.');
            window.location.href='doctors.php';
            </script>";
        }
        else{
            $alertMsg = "<strong>Failed!</strong> Please try again later.";
            $alertType = "alert-danger";
            include 'alert.php';
        } 
        
    }
    else if(isset($_POST['saveChanges'])){
        $id = $_POST['id'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $contactNo=$_POST['contactNo'];
        $qualification=$_POST['qualification'];
        $specialty=$_POST['specialty'];
        $startTime=$_POST['startTime'];
        $endTime=$_POST['endTime'];

        $sql = "UPDATE doctor SET name='$name', email='$email', contactNo='$contactNo', qualification='$qualification', specialty='$specialty' WHERE id='$id' ";

        if(mysqli_query($connDB,$sql)){
            $alertMsg = "<strong>Success!</strong> Profile has been updated.";
            $alertType = "alert-success";
        }
        else{
            $alertMsg = "<strong>Failed!</strong> Please provide valid information to update.";
            $alertType = "alert-danger";
        }
        
        include 'alert.php';
    }
    else{
        header('Location: doctors.php');
    }
?>
    <div class="container mt-4">
        <form class="mx-auto col-md-8" action="docProfile.php" method="POST" autocomplete="off">
        <fieldset>
            <legend>Doctor Profile</legend>
            <div class="form-row d-none">
                <div class="col-md-8">
                    <label for="id">Id</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?= $id; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-8">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="col-md-4">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="contactNo">Contact No.</label>
                    <input type="text" class="form-control" id="contactNo" name="contactNo" value="<?= $contactNo; ?>" required>
                   
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-8">
                    <label for="qualification">Qualification</label>
                    <input type="text" class="form-control" id="qualification" name="qualification" value="<?= $qualification; ?>" required>
                   
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-8">
                    <label for="specialty">Specialty</label>
                    <input type="text" class="form-control" id="specialty" name="specialty" value="<?= $specialty; ?>" required>
                   
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4">
                    <label for="specialty">Visiting Hour(Start)</label>
                    <input type="time" class="form-control" id="specialty" name="startTime" value="<?= $startTime; ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="specialty">Visiting Hour(End)</label>
                    <input type="time" class="form-control" id="specialty" name="endTime" value="<?= $endTime; ?>" required>
                </div>
            </div>
            <div class="form-row justify-content-center mt-2">
                <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#modal">Delete Profile</button>
                <button class="btn btn-primary" type="submit" name="saveChanges">Save Changes</button>
            </div>
            

            <div class="modal" id="modal" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title">Are You Sure to Remove <strong><?= $name; ?></strong> From the List?</p>
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
</fieldset>
        </form>
    </div>