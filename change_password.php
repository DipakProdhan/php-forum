<?php
session_start();
include 'partials\_dbconnect.php'; 

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
    border: 0px solid #000;
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
    <div>
		<?php 
		$method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            $user = $_SESSION['useremail'];
            $get_user = "select * from users where user_email='$user'";
            $run_user = mysqli_query($conn, $get_user);
            $row = mysqli_fetch_array($run_user);
            
        }
		?>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="bg-dark text-light"><font face="modern">
			<center><h1 style="color: white;"><strong>AllinOne</strong></h1></center></font>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="main-content my-5">
		        <div class="header">
				<h3 style="text-align: center;"><strong>Change Your Password </strong></h3>
				<strong style="color: grean; "><i><?php echo $_SESSION['useremail']; ?></i></strong>
				<hr>
		        </div>
		        <div class="l-part">
		          <form  action="" method="POST">
		          	<div class="input-group">
					    <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> -->
					    <input id="password" type="password" maxlength="10" class="form-control" name="pass" placeholder="New Password" required="required">
					</div><br>
					<div class="input-group">
					
					    <input id="password" type="password" maxlength="10" class="form-control" name="pass1" placeholder="Re-enter Password" required="required">
					</div><br>
		            <center><button id="signup" class="btn btn-info btn-lg" name="change">Change Password</button></center>
		          </form>
		        </div>
	        </div>
		</div>
	</div><br><br><br><br>

    <?php include 'partials\_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>

<?php


if(isset($_POST['change'])){
    $pass = $_POST['pass'];
    $pass1 = $_POST['pass1'];
    $encpass = password_hash($pass, PASSWORD_DEFAULT);

        if ($pass == $pass1) {
            if (strlen($pass) >= 8 && strlen($pass) <= 10) {
                $update = "update users set user_password='$encpass' where user_email='$user'";

                $run = mysqli_query($conn,$update);
                echo "<script>alert('Your Password is changed a moment ago')</script>";
                echo "<script>window.open('login.php','_self')</script>";
                    
            }else{
                echo "<script>alert('Your Password should be greater than 8 words')</script>";
                }
            }else{
                echo "<script>alert('Your Passwords did not match')</script>";
                echo "<script>window.open('change_password.php','_self')</script>";
            }
}

?>