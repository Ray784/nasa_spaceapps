<?php
    session_start();
    require_once("config/connect.php");
    if(isset($_SESSION['nasa']))
    {
        $userLoggedIn=$_SESSION['nasa'];
        $user_details_query = mysqli_query($connection, "SELECT * FROM `users` WHERE email='$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
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
			  
			  <a class="navbar-brand" href="index.php"><span><img src="https://pbs.twimg.com/profile_images/920712346867306497/ZfNSm_3M_400x400.jpg" class="img responsive" style="max-height:40px;max-width:40px;margin:-8px 0px;"/></span></a>
			
			</div>
			<script>
			   var myLat=<?php echo $_GET['lat'];?>;
			   var myLong=<?php echo $_GET['long'];?>;
			</script>
			<div class="collapse navbar-collapse" id="myNavbar">
			  
			  <ul class="nav navbar-nav">
				<li class="active"><a href="index.php">Home</a></li>
			  </ul>
		      <ul class="nav navbar-nav navbar-right">
		          <?php if(isset($_SESSION['nasa'])){?>
    			 <li class="active"><a><span></span><?php echo $user['name'];?></a></li>
    			 <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li><?php }else{?>
    			 <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li><?php }?>
    			 
    		</ul>
			</div>
		  </div>
		</nav>
		<br>
		<br>
		<br>
		<br>
		<?php if(isset($_GET['count']) & $_GET['count']>0){?>
		<div class="container">
		    <div class="row">
		        <div class="col-md-10 col-xs-12 col-sm-12 col-lg-10">
		            <?php if($_GET['mag']<=3.5){?>
		            <div class="panel-default panel">
		                <div class="panel-heading">
		                   No serious Threat But please take necessary precautions!! Magnitude=<?php echo $_GET['mag'];?>!! Here's a check list for you to follow!!
		                </div>
		                <div class="panel-body">
		                    <!--Panel for check list -->
		                    <?php include'checklist.php';?>
		                </div>
		            </div>
		            <div class="panel-default panel">
		                <div class="panel-heading">
		                     7 ways to Survive Earthquakes!!
		                </div>
		                <div class="panel-body">
		                    <video width="50%" height="100%" controls>
                            <source src="videos/7Ways.mp4" type="video/mp4">
                            </video>
		                </div>
		            </div>
		            <?php }else{?><script>window.location.href="maps.php?lat="+myLat+"&long="+myLong;</script><?php }?>
		        </div>
		    </div>
		</div>
		<?php }?>
		 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
 </html>