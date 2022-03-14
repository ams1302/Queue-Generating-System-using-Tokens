<?php
include 'header.php';
if(isset($_POST['adminLogin'])){
    
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    $sql = "SELECT * FROM user WHERE BINARY username = '$username' AND BINARY password = '$password'";
    $data = mysqli_query($connDB,$sql);
    
    if(mysqli_num_rows($data)>0){ 
        $_SESSION['username'] = $username;
        header('Location: index.php');
    }
    else{
        $alertMsg = "<strong>Failed!</strong> Invalid Username or Password.";
        $alertType = "alert-danger";
        include 'alert.php';
    }
    
    
}
else if(isset($_POST['patientLogin'])){
    
    $bookingID=$_POST['bookingID'];
    
    $sql = "SELECT * FROM booking WHERE BINARY id = '$bookingID'";
    $data = mysqli_query($connDB,$sql);
    
    if(mysqli_num_rows($data)>0){
        $_SESSION['bookingID'] = $bookingID;
        header('Location: index.php');
    }
    else{
        $alertMsg = "<strong>Failed!</strong> Invalid Booking ID.";
        $alertType = "alert-danger";
        include 'alert.php';
    }
    
    
}
else if(isset($_SESSION['username']) || isset($_SESSION['bookingID'])){
    session_unset();
    session_destroy();
    header('Location: login.php');
}
?>
        <div class="login-form">
            <div class="d-flex justify-content-center mb-5">
                <button class="btn btn-outline-success col-md-4" id="login">Admin Login</button>
            </div>
            <div class="admin" >
                <form action="login.php" method="POST" autocomplete="off"  class="login">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter admin username" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter admin password" required>
                        </div>
                    </div>
                    <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary" name="adminLogin">Login</button>
                            </div>
                        </div>
                </form>
            </div>
                <div class="patient">
                    <form action="login.php" method="POST" autocomplete="off" class="login">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                            <label for="bookingID">Booking ID</label>
                                <input type="text" class="form-control" name="bookingID" id="bookingID" placeholder="Enter your booking id">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary" name="patientLogin">Login</button>
                            </div>
                        </div>
                    </form> 
                </div>      
        </div>
    <script src="js/login.js"></script>