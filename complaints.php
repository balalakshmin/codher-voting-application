<html>
<head>
<title>Complaints</title>
<style>
		#header{
			height:200px;
			background: #000 url('images/background.jpg') repeat-y
				scroll left top;
			text-align: center;
		}
		#header div{
			height:300px;
			width:930px;
			background: transparent url('images/overlay.png') no-repeat
				scroll left top;

		}
		#header h1{
			padding-top: 100px;
			color:white;
			font-family: 'Lucida Console',monospace;

		}
		#nav{
			height:30px;
		}
		body{
		background-color:black;
		}
		#body{
			background-color: #e74c3c;
			width:936px;
			height:500px;
		}
		form{
			padding-left:20%;
			padding-top:20%;
			background-color: green;
			center-align;
			width:300px;
			height:300px;
		}
		#name{
		text-align:left;
		font-size:20px;
		color:white;
		}
		#title{
		text-align:left;
		font-size:30px;
		color:white;
		}
		#post{
		font-size:20px;
		color:white;
		}
		#time{
		text-align:right;
		font-size:10px;
		color:white;
		}
		body{
			background-color: black;
		}
		#wrapper{
			margin:0 auto;
			width:920px;
			background-color:black;
		}
		

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" 
		type="text/javascript" charset="utf-8"></script>
	<script>
	$(document).ready(function(){
    $("input, textarea").addClass("idle");
        $("input, textarea").focus(function(){
            $(this).addClass("activeField").removeClass("idle");
    }).blur(function(){
            $(this).removeClass("activeField").addClass("idle");
    });
	});
	</script>
	<script>
		var speed=70;
		var current=0;
		var step=1;
		var headerheight=300;
		var imageheight=4300;
		var start= -(imageheight-headerheight);
		function overlay(){
			current-=step;
			if(current==start)
				current=0;
			$('#header').css("background-position","0 "+current+"px");

		}
		var overlayreturn=setInterval("overlay()",speed)
	</script>
	<link rel="shortcut icon" href="img/favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/gritter/css/jquery.gritter.css" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
  
</head>
<body>

<div id="wrapper">
		<div id="header">
			<div>
			<h1>User Complaints</h1>
			</div>
		</div>
              <div class="col-lg-6">
                      <!--notification start-->
                      <section class="panel">
                          <div class="panel-body">	
<?php 
		include_once("php_includes/db_conx.php");
          $sql = "SELECT * FROM complaints";
          $exe = mysqli_query($db_conx, $sql);
          while($comp = mysqli_fetch_array($exe,MYSQLI_ASSOC)) {
          $title = $comp["comp_title"];
		  $post = $comp["comp_body"];
          $time = $comp["date_time"];
          $name = $comp["post_author"];
		  
		  $title = base64_decode($title);
		  //$title = base64_decode($title);
		  $post = base64_decode($post);
		  //$post = base64_decode($post);
          
		  
          echo "<div class='alert-success'>
                             <strong> $name: </strong> <br/> <strong> <p style='font-size:20px;'> $title </p> $post </br> <p style='text-align:right'>$time</p></div>";



    }
  ?>
  </div>
  </section>
  </div>

  
  </div>
</body>
</html>