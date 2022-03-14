<?php
include 'header.php';
if(!isset($_SESSION['username']))
    header('Location: index.php');

$username = $_SESSION['username'];
 if(isset($_POST['saveChanges'])){
    $name = $_POST['name'];
    $password = $_POST['password'];

    $sql = "UPDATE user SET name='$name', password='$password' WHERE BINARY username='$username' ";

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
    $sql = "SELECT * FROM user WHERE BINARY username = '$username'";
    $data = mysqli_query($connDB,$sql);
    $user = mysqli_fetch_array($data);
    
    $name = $user['name'];
    $password = $user['password'];
}
?>
    <div class="container mt-5">
        <form class="myprofile col-md-6 mx-auto my-auto" action="myProfile.php" method="POST" autocomplete="off">
        <fieldset>
            <legend>My Profile</legend>
            <div class="form-row">
                <div class="col-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6 mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $username; ?>" required disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6 mb-3">
                    <label for="password">password</label>
                    <input type="text" class="form-control" id="password" name="password" value="<?= $password; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6 mb-3">
                <button class="btn btn-primary" type="submit" name="saveChanges">Save Changes</button>
                </div>
            </div>
            </fieldset>
        </form>
    </div>



