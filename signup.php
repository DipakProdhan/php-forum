<!-- functions######################################### -->
<?php

include 'partials\_dbconnect.php';

if(isset($_POST['sign_up'])){
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_email = $_POST['signupEmail'];
    $password = $_POST['signupPassword'];
    $cpassword = $_POST['signupcPassword'];
    $recoveryaccount = $_POST['recovery_account'];
    // $enpass = md5($password);
    $encpass = password_hash($password, PASSWORD_DEFAULT);
    

    $username = ucfirst($first_name . " ". $last_name);
    $check_username = "SELECT user_name FROM users WHERE user_email = '$user_email'";
    $result_username = mysqli_query($conn, $check_username);

    if(strlen($password)<8){
        echo"<script>alert('Password should be minimum 8 characters!')</script>";
        echo "<script>window.open('signup.php', '_self')</script>";
        exit();
    }
    elseif($password != $cpassword){
        echo "<script>alert('Password does not match!')</script>";
        echo "<script>window.open('signup.php', '_self')</script>";
		exit();
    }

    $existSql = "SELECT * FROM users WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);

    if($numRows == 1){
        echo "<script>alert('Email already exist, Please try using another email')</script>";
		echo "<script>window.open('signup.php', '_self')</script>";
		exit();
    }
   
    $sql = "INSERT INTO users(f_name, l_name, user_name, user_email, user_password, recovery_account, tstamp) VALUES('$first_name','$last_name','$username','$user_email','$encpass','$recoveryaccount',current_timestamp())";
    $insert_result = mysqli_query($conn, $sql);

    if($insert_result){
        echo "<script>window.open('login.php', '_self')</script>";
    }
    else{
        echo "<script>alert('Registration failed, please try again!')</script>";
    	echo "<script>window.open('signup.php', '_self')</script>";                   
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
    height: 95%;
    margin: 10px auto;
    background-color: rgba(0, 0, 0, 0.5);
    border: 2px solid #e6e6e6;
    border-radius: 20px;
    padding: 40px 50px;
}

.header {
    border: 0px solid #000;
    margin-bottom: 5px;
}

#sign_up {
    width: 50%;
    border-radius: 30px;
    background-color: #32CD32;
}
</style>

<body>
    
   
    <?php include 'C:\xampp\htdocs\NEW\Project - Forum\partials\_header.php'; ?>
   

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <div class="header">
                        <h3 style="text-align: center;"><strong>Create a new account</strong></h3>
                        <hr>
                    </div>
                    <div class="l-part">
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span> -->
                                    <input type="text" required="required" class="form-control" id="first_name"
                                        name="first_name" placeholder="First Name">
                                </div>
                                <div class="mb-3">
                                    <input type="text" required="required" class="form-control" id="last_name"
                                        name="last_name" placeholder="Last Name">
                                </div>
                                <div class="mb-3">
                                    <input type="email" required="required" class="form-control" id="signupEmail"
                                        name="signupEmail" placeholder="Email" aria-describedby="emailHelp">
                                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                </div> -->
                                </div>
                                <div class="mb-3">
                                    <input type="password" maxlength="10" required="required" class="form-control" id="signupPassword"
                                        name="signupPassword" placeholder="Password">
                                </div>
                                <div class="mb-3">
                                    <input type="password" maxlength="10" required="required" class="form-control" id="signupcPassword"
                                        name="signupcPassword" placeholder="Confirm Password">
                                </div>
                                <div class="mb-3">
                                    <input type="text" required="required" class="form-control" id="recovery_account"
                                        name="recovery_account" placeholder="recovery_account">
                                </div>
                                <!-- <a style="text-decoration: none;float: right;color: #00CCFF;" data-toggle="tooltip" title="Signin" href="\NEW\Project - Forum\login.php">Already have an account?</a><br><br> -->
                                <center>
                                    <button type="submit" id="sign_up" name="sign_up"
                                        class="btn btn-primary">Signup</button>
                                </center>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'C:\xampp\htdocs\NEW\Project - Forum\partials\_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>

