<!-- functions######################################### -->
<?php

include 'partials\_dbconnect.php';


if(isset($_POST['submit'])){
    

    $user = $_POST["loginEmail"];
    $pass = $_POST["loginPassword"]; 
    
    // $sql = "Select * from users where username='$username' AND password='$password'";
    $sql = "Select * from users where user_email='$user'";
    $result = mysqli_query($conn, $sql);

    $numRows = mysqli_num_rows($result);
    if ($numRows > 0){
        $row= mysqli_fetch_assoc($result);
        $verify = password_verify($pass, $row['user_password']);
        if ($verify == 1){ 
            
            session_start();
                    
            $_SESSION['loggedin'] = true;
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['useremail'] =  $row['user_email'];
            echo "<script>window.open('index.php', '_self')</script>";
                    
        } 
        else{
            echo"<script>alert('Your Password is incorrect')</script>";
        }
    }       
    else{
            echo"<script>alert('Please go signin button first')</script>";
    }
     
}
   

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="partials\_style.css">

    <title>AllinOne</title>
</head>

<style>
.main-content {
    width: 40%;
    height: 85%;
    margin: 10px auto;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 15px;
    padding: 80px 60px;
}

.header {
    border: 0px solid #000;
    margin-bottom: 5px;
}

#login {
    width: 50%;
    border-radius: 30px;
    background-color: #32CD32;
}
.overlap-text{
	position: relative;
}
.overlap-text a{
	position: absolute;
	top: 8px;
	right: 10px;
	font-size: 14px;
	text-decoration: none;
	font-family: 'Overpass Mono', monospace;
	letter-spacing: -1px;

}
</style>

<body>
    
    <?php include 'C:\xampp\htdocs\NEW\Project - Forum\partials\_header.php'; ?>

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <div class="header">
                        <h3 style="text-align: center; color:black;"><strong>Login to AllinOne</strong></h3>
                    </div><br>

                    <form action="" method="POST">
                       
                            <div class="mb-3">
                                <input type="email" class="form-control" name="loginEmail" placeholder="Email" required="required">
                            </div><br>
                            <div class="overlap-text mb-3">
                                <input type="password" class="form-control" name="loginPassword" placeholder="Password" required="required">
                                <a style="text-decoration:none;float: right;color: #187FAB;" data-toggle="tooltip" title="Reset Password" href="forgot_password.php">Forgot?</a>
                            </div>
                            <!-- <a style="text-decoration: none;float: right;color: #00CCFF;" data-toggle="tooltip"
                                title="Create Account!" href="/NEW/Project - Forum/signup.php">Don't have
                                an account?</a><br><br> -->

                            <center><button type="submit" id="login" name="submit" class="btn btn-info btn-lg">Login</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div><br>

    <?php include 'C:\xampp\htdocs\NEW\Project - Forum\partials\_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>
