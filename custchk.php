<?php
    session_start();
    if(isset($_SESSION['nasa']))
    {
        require_once('config/connect.php');
        $type='misc';
        $query="SELECT * FROM `checklist` WHERE type='$type'";
        $result=mysqli_query($connection,$query);
        $userLoggedIn=$_SESSION['nasa'];
        $query2="SELECT * FROM `checklist` WHERE type='$userLoggedIn'";
        $result2=mysqli_query($connection,$query2);
        $query3="SELECT name from `users` WHERE email='$userLoggedIn'";
        $result3=mysqli_query($connection,$query3);
        if($result3==true)
        {
            $user=mysqli_fetch_array($result3);
        }
        if($result==true)
        {
            $chk=mysqli_fetch_array($result);
            $chk=explode(',',$chk['value']);
        }
        if($result2==true)
        {
            $chk2=mysqli_fetch_array($result2);
            $chk2=explode(',',$chk2['value']);
        }
    }
    else
    {
        header('location: homepage.php');
    }
    if(isset($_POST['add_button']) & !empty($_POST['add_button']))
    {
        $query = "SELECT * FROM `checklist` WHERE type='$userLoggedIn'";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);
        if($count > 0)
        {
            $res=mysqli_fetch_array($result);
            $value=$res['value'].",".$_POST['chk'];
            $query = "UPDATE `checklist` set value='$value' WHERE type='$userLoggedIn'";
            $result = mysqli_query($connection, $query);
            if($result)
            {
                echo '<script>window.location="custchk.php";</script>';
            }
        }
        else
        {
            $value=$_POST['chk'];
            $query = "INSERT INTO `checklist`(type,value) VALUES('$userLoggedIn','$value')";
            $result = mysqli_query($connection, $query);
            if($result)
            {
                echo '<script>window.location="custchk.php";</script>';
            }
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- jquery cdn-->
    <script src="jquery-3.3.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    
   <!-- Required meta tags -->
    
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS/CSS scripts -->
    
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- Icon -->
	<link rel="icon" type="image/gif" href="nasa.png" />
    <title>Home</title>
	<style>
	@font-face {
            font-family: 'myFont'; /*a name to be used later*/
            src: url('../fonts/BRLNSR.TTF'); /*URL to font*/
        }
        .font{
            font-family:myFont;
            font-size:18px;
        }
        .image{
            width: 40%;
            height:40%;
        }
        .center{
            margin-left:auto;
            margin-right:auto;
            display:block;
            
        }
    </style>
  </head>
  <body>
      <nav class="navbar navbar-default navbar-fixed-top" style="margin:-2px -2px;">
		  <div class="container-fluid">
			<div class="navbar-header">
			  
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			  </button>
			  
			  <a class="navbar-brand" href="index.php"><span><img src="nasa.png" class="img responsive" style="max-height:40px;max-width:40px;margin:-8px 0px;"/></span></a>
			
			</div>
			
			<div class="collapse navbar-collapse" id="myNavbar">
			  
			  <ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li class="active"><a href="custchk.php">Manage CheckList</a></li>
			  </ul>
		      <ul class="nav navbar-nav navbar-right">
    			 <li class="active"><a><span></span><?php echo $user['name'];?></a></li>
    			 
    			 <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    		</ul>
			</div>
		  </div>
		</nav>
		<br>
		<br>
		<br>
		<br>
		<div class="container">
		    <div class="row main">
		            <div class="col-md-10 col-sm-12 col-xs-12 col-lg-10">
		                <div class="panel panel-default">
		                    <div class="panel-heading">
		                        Your Check List
		                    </div>
		                    <div class="panel-body">
		                        <?php foreach($chk as $c){
		                        echo $c.'<br>';}?>
		                         <?php foreach($chk2 as $c){
		                        echo $c.'<br>';}?>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-10 col-sm-12 col-xs-12 col-lg-10">
		            <form action="custchk.php" method="post">
		                <div class="form-group">
		                    <input class="form-control" id="chk" name="chk" type="id" placeholder="Enter a Custom Option" required>
		                </div>
		                <input type="submit"  name="add_button" id="add_button" class="btn btn-primary btn-lg login-button" value="Add To Check List">
		            </form>
		            </div>
		        </div>
		    </div>
		    
		    </script>
		 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>