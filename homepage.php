<?php include'head.php';?>
    <head>
        <title>Welcome</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <style>
        <?php include'css/load.css'?>
        .image{
            width:50%;
        }
        .container {
            height: 100%;
            text-align: center;  
            font: 0/0 a;
        }

        .container:before {   
            content: ' ';
            display: inline-block;
            vertical-align: middle;
            height: 100%;
        }

        #element {
            display: inline-block;
            vertical-align: middle;  
            font: 16px/1 Arial sans-serif; 
        }
    </style>
    <body>
        <div class="pageLoad">
            <div class="inner">
            	<div></div>
              <div></div> 
              <div></div>
              <div></div>
            </div> 
            </div>
            
            <div class="container">
                <div id="element">
                    <img src="nasa.png" class="image"> 
                </div>
            </div>
            
    </body>
    <script>
        setTimeout(function() {
              $('.inner div').addClass('done'); 
              setTimeout(function() {
                  window.location='login.php';
              },1499);
              setTimeout(function() {
                $('.inner div').addClass('page'); 
                
                setTimeout(function() {
                	$('.pageLoad').addClass('off'); 
                  
                  $('body, html').addClass('on'); 
                  
                  
              	}, 500)
              }, 500)
            }, 1500)
    </script>
</html>