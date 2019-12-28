<?php
session_start();
require('config/connect.php');
?>
<?php
if (isset($_POST['login_button']) and !empty($_POST['login_button'])){
  $id = mysqli_real_escape_string($connection, $_POST['log_id']);
  $password = md5(mysqli_real_escape_string($connection, $_POST['log_password']));
  $query = "SELECT * FROM `users` WHERE email='$id'";
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  $count = mysqli_num_rows($result);
  if($count == 0)
  {
      $fmsg = "User Doesn't Exist \n".mysqli_error($connection);
  }
  else
  {
      $query = "SELECT * FROM `users` WHERE email='$id' and password='$password'";
      $result = mysqli_query($connection, $query);
      $count = mysqli_num_rows($result);
      if ($count == 1){
        $_SESSION['nasa'] = $id;
          echo '<script>window.location="index.php"</script>';
          exit();
      }else{
        $fmsg = "Invalid Login Credentials.";
      }
  }
}
?>
<?php
if (isset($_POST['register_button']) and !empty($_POST['register_button'])){
  $id = mysqli_real_escape_string($connection, $_POST['reg_id']);
  $name = mysqli_real_escape_string($connection, $_POST['reg_fname']);
  $age= mysqli_real_escape_string($connection, $_POST['reg_age']);
  
  $password = md5(mysqli_real_escape_string($connection, $_POST['reg_password']));
  $query = "SELECT * FROM `users` WHERE email='$id'";
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  $count = mysqli_num_rows($result);
  if($count > 0)
  {
      $fmsg = "User Already Exists";
  }
  else
  {
      $query = "INSERT into `users`(email,name,password,age) VALUES('$id','$name','$password','$age')";
        $result = mysqli_query($connection, $query);
      if ($result){
          $smsg="Registration Successful\n Go Ahead and Login";
      }else{
        $fmsg = "Registration Unsuccessful\n ".mysqli_error($connection);
      }
  }
}
?>
<?php
    if(isset($_SESSION['nasa']) & !empty($_SESSION['nasa']))
    {
        echo '<script>window.location="index.php"</script>';
    }
?>

<!DOCTYPE html>
<!--Abhay-->
<html>
<head>
  <title>
     Login
  </title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/register.css">
    <script src="js/register.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="Customstyle.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
	.login {
	    background-color: #d3d3d3;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .clogin{
        background-color: #fff;
        border-radius:2%;
        padding: 3%;
    }
    @media (max-width: 978px) {
        .clogin{
        background-color: #fff;
        border-radius:2%;
        padding: 6%;
    }
   
</style>
	<body class="login">
    <br>
    <br>
    <br>
        <div class="container" >
            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="col-md-4 col-xs-1 col-sm-1 col-lg-4">
                    
                </div>
                <div class="col-md-4 col-xs-10 col-sm-10 col-lg-4 clogin">
        <div style="align-content:center;">
            <img src="nasa.png" style="width:80%; display:block; margin-left:auto; margin-right:auto;">
        </div>
        <div class="main-login main-center">
            <br>
            <div id="first">
				<form action="login.php" method="POST">
				    <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
				    <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
				    <div class="form-group">
					<input class="form-control" type="email" id="log_id" name="log_id" placeholder="Email Id" required>
					</div>
					<div class="form-group">
					<input class="form-control" type="password" id="log_password" name="log_password" placeholder="Password">
					</div>
					<input type="submit"  name="login_button" id="login_button" class="btn btn-primary btn-block btn-lg login-button" value="Login">
					<br>
					<a href="#" id="signup" class="signup">Need and account? Register here!</a>

				</form>

			</div>
        </div>
        <div class="main-login main-center">
            <div id="second">

				<form action="login.php" method="POST">
					
                    <div class="form-group">
					<input type="text" class="form-control" name="reg_fname" placeholder="Your Name" required>
					</div>
					
					<div class="form-group">
					<input type="email" class="form-control" name="reg_id" placeholder="Id" required>
					</div>
					
					<div class="form-group">
					<input type="number" min="5" class="form-control" name="reg_age" placeholder="Age" required>
					</div>
					
					<div class="form-group">
					<input type="password" class="form-control" name="reg_password" placeholder="Password" required>
                    </div>

					<input type="submit"  name="register_button" id="register_button" class="btn btn-primary btn-block btn-lg login-button" value="Register">
					<br>

					<a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
				</form>
			</div>
        </div>
      </div>
      </div>
      <div class="col-md-4 col-xs-1 col-sm-1 col-lg-4">
          
      </div>
      </div>
      
    </div> 
  </body>
</html>