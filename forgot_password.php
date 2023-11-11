<?php
session_start();
include 'partials\_dbconnect.php'; 

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $recovery_account = $_POST['recovery_account'];

    $select_user = "select * from users where user_email='$email' AND recovery_account='$recovery_account'";

    $query = mysqli_query($conn,$select_user);

    $check_user = mysqli_num_rows($query);

    if($check_user==1){

        $_SESSION['useremail']=$email;

        echo "<script>window.open('change_password.php','_self')</script>";

    }
    else {
        echo "<script>alert('Your Email or your Bestfriend name is Incorrect')</script>";
        echo "<script>window.open('forgot_password.php','_self')</script>";
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
    

    <title>AllinOne</title>
</head>
<style>
body {
    overflow-x: hidden;
}

.main-content {
    width: 50%;
    height: 70%;
    margin: 10px auto;
    background-color: gray;
    border: 2px solid #e6e6e6;
    border-radius: 20px;
    padding: 40px 50px;
}

.header {
    border: 0px solid #0000;
    margin-bottom: 5px;
}

/* .well{
background-color: black;
} */
#signup {
    width: 50%;
    border-radius: 30px;
    background-color: #32CD32;
}
</style>

<body>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-dark text-light">
                <font face="modern">
                    <center>
                        <h1 style="color: white;"><strong>AllinOne</strong></h1>
                    </center>
                </font>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="main-content my-5">
                <div class="header">
                    <h3 style="text-align: center;"><strong>Forgot Password.</strong></h3>
                    <hr>
                </div>
                <div class="l-part">
                    <form action="" method="post">
                        <div class="input-group">
                            <input id="email" type="text" class="form-control" name="email"
                                placeholder="Enter Your Email" required="required">
                        </div><br>
                        <hr>
                        <pre class="text">Enter your BestFriend name down below</pre>
                        <div class="input-group">
                            <input id="msg" type="text" class="form-control" placeholder="Someone"
                                name="recovery_account" required="required">
                        </div><br>
                        <a style="text-decoration:none;float: right; color:black;" data-toggle="tooltip" title="Login"
                            href="login.php">Back to Signin?</a><br><br>
                        <center><button id="signup" class="btn btn-info btn-lg" name="submit">Submit</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'partials\_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>