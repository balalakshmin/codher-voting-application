<?php
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["c"])){
	// CONNECT TO THE DATABASE
	include_once("php_includes/db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$c = mysqli_real_escape_string($db_conx, $_POST['c']);
	$ct = mysqli_real_escape_string($db_conx, $_POST['ct']);
	$n = mysqli_real_escape_string($db_conx, $_POST['n']);
	// FORM DATA ERROR HANDLING
	if($n==""){
		$n="Anonymous";
	}
	if($c == "" || $ct == ""){
		echo "post_failed";
        exit();
	} else {
	$cryptcomp=base64_encode($c);
	$cryptcomptit=base64_encode($ct);
	
	// END FORM DATA ERROR HANDLING
		$sql = "INSERT INTO complaints(post_author, date_time,comp_title,comp_body) VALUES('$n',now(),'$cryptcomptit', '$cryptcomp')";
        $query = mysqli_query($db_conx, $sql);
    }
	exit();
}
?>
<html>
<head>
<style>
		#header{
			height:300px;
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
			padding-top: 125px;
			color:white;
			font-family: 'Lucida Console',monospace;

		}
		#nav{
			height:30px;
		}
		
		#body{
			background-color: #d6e5f4;
			width:936px;
			height:900px;
		}
		body{
			background-color: black;
		}
		#wrapper{
			margin:0 auto;
			width:920px;
		}
		#inputArea
		{
    font-family: Arial, Sans-Serif;
    font-size: 13px;
    background-color: #d6e5f4;
    padding: 10px;
	width: 500px;
	height:500px;
	
	}
		#inputArea input, #inputArea textarea
		{
    font-family: Arial, Sans-Serif;
    font-size: 13px;
    margin-bottom: 5px;
    display: block;
    padding: 4px;
	
    	}
		.activeField
		{
        background-image: none;
        background-color: #ffffff;
        border: solid 1px #33677F;
		}
		.idle
		{
    border: solid 1px #85b1de;
    background-image: url( 'blue_bg.png' );
    background-repeat: repeat-x;
    background-position: top;
		}

	</style>
	<script src="js/main.js"></script>
	<script src="js/ajax.js"></script>

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
<script>
function postcomp(){
	var n = _("name").value;
	var c = _("comp").value;
	var ct = _("compt").value;
	if(c == "" || ct == ""){
		_("status").innerHTML = "Fill out all of the form data";
	} else {
		
		_("submit").style.display = "none";
		_("status").innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "entercom.php");
		ajax.onreadystatechange = function() {
		    if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText == "post_failed"){
					_("status").innerHTML = "Post unsuccessful, please try again.";
					_("submit").style.display = "block";
				}
				else {
					_("status").innerHTML = "Successfully posted your complaint";
					_("comp").value="";
					_("compt").value="";
				}
	        }
        }
        ajax.send("ct="+ct+"&c="+c+"&n="+n);
	}
}


	</script>
<title>Complaints</title>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div>
				<h1>Post your complaints<h1>
			</div>
		</div>
		<div id="nav">
		
		</div>
		<div id="body">
		<h2>We assuse you are safe</h2>
			<form id="inputArea" method="post" action="entercom.php">
				<div class="form group">
				<input type="text" id="name" placeholder="Enter name(optional)" onfocus="emptyElement('status')">
				<input type="text" id="compt" placeholder="Enter title" onfocus="emptyElement('status')">
				<input type="text" id="comp" placeholder="Enter complaint" onfocus="emptyElement('status')">
				<input id="submit" type="button" onclick="postcomp()" value="post complaint">
				</div>
				<p id="status"></p>
			</form>
		</div>
	</div>
</body>
</html>