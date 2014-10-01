<?php
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["n"])){
	// CONNECT TO THE DATABASE
	include_once("php_includes/db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$n = mysqli_real_escape_string($db_conx, $_POST['n']);
	$p = base64_encode($_POST['p']);
	// FORM DATA ERROR HANDLING
	if($n == "" || $p == ""){
		echo "login_failed";
        exit();
	} else {
	// END FORM DATA ERROR HANDLING
		$sql = "SELECT password FROM members WHERE name='$n' LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
		$db_pass_str = $row[0];
        if($p != $db_pass_str){
			echo "password_wrong";
            exit();
		}
	}
	exit();
}
?>
	
<html>
<head>
<title>member login</title>
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
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script>
function login(){
	
	var n = _("name").value;
	var p = _("pass").value;
	if(n == "" || p == ""){
		_("status").innerHTML = "Fill out all of the form data";
	
	} else {
	
		_("submit").style.display = "none";
		_("status").innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "login.php");
		ajax.onreadystatechange = function() {
		    if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText == "login_failed"){
					_("status").innerHTML = "Login unsuccessful, please try again.";
					_("submit").style.display = "block";
				}
				else if(ajax.responseText == "password_wrong"){
					_("status").innerHTML = "Wrong password entered";
					_("submit").style.display = "block";
				}
				else {
					window.location = "complaints.php";
				}
	        }
        }
        ajax.send("n="+n+"&p="+p);
	}
}
</script>
<link href="css/loginstyle.css" rel="stylesheet">
<style>
body{
background-image:url('images/dark-wood-texture.jpg');
}
h1{
	padding-top: 80px;
	color:white;
	font-family: 'Lucida Console',monospace;
	text-align:center;
}
</style>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div>
				<h1>Member of Election Commission<h1>
			</div>
		</div>
	
	
	<div class="container">
	<section id="content">
		<form action="">
			<h1>Login Form</h1>
			<div>
				<input type="text" placeholder="Username" required="" id="name" />
			</div>
			<div>
				<input type="password" placeholder="Password" required="" id="pass" />
			</div>
			<div>
				<input id="submit" type="button" onclick="login()" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<p id="status"></p>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</div>
</body>
</html>