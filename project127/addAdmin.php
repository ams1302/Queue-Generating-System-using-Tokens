<?php
include 'header.php';
if(!isset($_SESSION['username']))
    header('Location: index.php');

if(isset($_POST['addAdmin'])){
    $name=$_POST['name'];
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql = "INSERT INTO user (name,username,password) VALUES ('$name','$username','$password')";
    
    $alertMsg = "<strong>Failed!</strong> Admin already exists with given Username.";
    $alertType = "alert-danger";

    if(mysqli_query($connDB,$sql)){
    $alertMsg = "<strong>Success!</strong> New Admin has been added.";
    $alertType = "alert-success";
    }
        
        include 'alert.php';
}   
?>        
        
        <div class="sign-up mt-5 mx-auto p-5 col-md-6 border-info">
            <form action="" method="POST" autocomplete="off">
            <fieldset>
            <legend>Add Admin</legend>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" minlength="4" placeholder="Minimum 6 characters" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                    <input class="btn btn-primary" name="addAdmin" type="submit" value="Add"/>
                    </div>
                </div>
            </fieldset>
            </form>
        </div>