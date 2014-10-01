<?php
session_start();
	include("php_includes/db_conx.php");

if(isset($_POST["v"]) && isset($_POST["n"])){
	$one=1;
	$sql="SELECT * FROM voter_mpconstituency WHERE voter_id='$v' and voted='$one' and voter_name='$n' LIMIT 1";
	$query = mysqli_query($db_conx , $sql);
	$voter = mysqli_num_rows($query);
	if($voter>0){
		echo "you have already voted";
		exit();
	}
	else{
		unset($_SESSION["voterid"]);
		$_SESSION['voterid'] = $_POST["v"];
		echo "success";
		exit();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<script src="js/main.js"></script>
	<script src="js/ajax.js"></script>
	<script>
	/*function gotovote(){
		alert("gone to gotovote");
		var v = _("voter_id").value;
		alert(v);
		var ajax=ajaxObj("POST","vote.php");
		ajax.onreadystatechange = function() {
            //if(ajaxReturn(ajax) == true) {
            	window.location.href="vote.php";
            //}
        }
         ajax.send("v="+v);
    
	}*/
	function gotovotepage(){
		
		var v = _("voter_id").value;
		var n =_("voter_id").value;
		//alert(v);
		if(v=="" || n=="")
		{	
			_("status").innerHTML="Sorry!Fill up your voter id and name!";
		}
		else
		{
				//alert("else part");
			_("status").innerHTML="please wait";
			var ajax=ajaxObj("POST","index.php");
			ajax.onreadystatechange = function(){
				if(ajaxReturn(ajax) == true){
					if(ajax.responseText!="success"){
						_('status').innerHTML=ajax.responseText;
						alert("not success");
					}
					else{
						window.location = "vote.php?v="+v;
						//gotovote();
							//window.scrollTo(0,0);


					}
				}
			}
			ajax.send("v="+v+"&n="+n);
			/*if(ajax.responseText=="success"){
				var ajax2=ajaxObj("POST","vote.php");
						ajax2.onreadystatechange=function(){
							if(ajaxReturn(ajax2)==true){

							}
						}
						ajax2.send("v="+v)
			}*/
		}

	}    
	</script>
	<style>
	
	#homepagepic{
		 width:40% ;
		 height:50%;
		 margin-right: 20px;
		 margin-left: 450px;
		 margin-top: 50px;

		 
			vertical-align: middle;
	}
	body{
		background-image:url('images/dark-wood-texture.jpg');

	}
	.submitbutton{
		background: url("images/submit button.jpg") no-repeat;
		width:230px;
		height:70px;
		display:block;
		margin-top: 10px;
		margin-left: 650px;
		border:none;
	}
	.submitbutton:hover{
		background: url("images/submit button.jpg") no-repeat;
		width:225px;
		height:65px;
		display:block;
		margin-top: 10px;
		margin-left: 650px;
		border:none;

		
	}
	#p{
		font-size: 30px;
		display:inline-block;
		margin-left:500px;
	}
	#voter_id{
		margin-top: 20px;
		height:50px;
		width: 200px;	
		display:inline-block;
		border-radius: 50%;
		text-align: center;
		font-size: 20px;
		margin-left: 550px;
		color:black;
		border:none;
	}
	#voter_name{
		height:50px;
		width:200px;
		font-size: 20px;
		text-align: center;	
		display:inline-block;
		border-radius: 50%;
		color:black;
		border:none;
	}
	
	
	</style>
<body>
	<?php include('pagetop.php');?>
	<img src="images/homepagepic.jpg" id="homepagepic">
	<form>
		
		<input type="text" id="voter_id" placeholder="voter id" value="" class="inputArea"/>
		<input type="text" id="voter_name" placeholder="name" value="" class="inputArea"/>
		<input type="button" class="submitbutton"  onclick="javascript:gotovotepage()"/>
		<span id="status" color="white"></span>
		<a style="font-size:30px; color:white;" href="entercom.php">Have any complaints?</a><br/>
		<a style="font-size:30px; color:white;" href="result.php">Vote Result</a>
</body>
</html>
