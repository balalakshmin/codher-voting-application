<?php
session_start();
include_once("php_includes/db_conx.php");

if(isset($_GET["v"])){
	//echo "if";
	$memberslist="";
	$v=$_GET["v"];	

	if($_SESSION["voterid"] != $v ) {
		echo "invalid id";
		exit();
	}

	$sql="SELECT * FROM voter_mpconstituency WHERE voter_id='$v' AND voted='0'";
	$query=mysqli_query($db_conx,$sql);
	$numrows=mysqli_num_rows($query);
	//echo $numrows;
	$mpconst=9;
	if($numrows<1){
		echo $numrows;

		?>
	<!--	<script type="text/javascript">
			window.history.go(-1);
		</script> -->
		<?php
	}
	else{

		while($rows = mysqli_fetch_array($query , MYSQLI_ASSOC)){
			$mpconst=$rows["mp_constituency_id"];

		$voted = $rows["voted"];
		}
		if($voted == 1) {
			echo "already voted";
			exit();
		}
		

	}
	$sql="SELECT * FROM mpconstituency_member WHERE mpconstituency_id='$mpconst'";
	$query=mysqli_query($db_conx,$sql);
	$numrows=mysqli_num_rows($query);
	//echo $numrows;
	if($numrows<1){
		$memberslist="there are no contestants";
	}
	else{
		while($rows=mysqli_fetch_array($query,MYSQLI_ASSOC)){
			$candname=$rows["cand_name"];
			$partyname=$rows["party_name"];
			$candsymbol='<img width="30px" height="30px" src="images/'.$candname.'.jpg"/>';
			$option='<label class="label_check" for="sample-check"><input type="radio" name="vote" id="vote" value="'.$candname.'"/>';
			$memberslist.= "$option$candname$partyname $candsymbol</label><br/>";
			
		}
	}
} 
 else {
		echo "error";
	}

?>
<!DOCTYPE html>
<html>
	<head> <title>Cast Your Vote</title>

			<style>
		#inputArea{
			margin-left: 200px;
			position:relative;
			margin-top: 170px;
			}
			
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
			
			width:936px;
			background: url("images/votebg.jpg") ;
			height:900px;
			color:black;
			position:absolute;
		}
		 body{
			background-color: black;
		} 
		#wrapper{
			margin:0 auto;
			width:920px;
		}
		.voter{
			background-image: url('images/votebutton.jpg');
			border-radius: 50%;
		}
				

	</style>


		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/main.js" type="text/javascript"></script>
	<script src="js/ajax.js" type="text/javascript"></script>
	<script type="text/javascript">

	function castvote() {
		//alert("hi");
		var value = _("vote").checked;
		var vote = _("vote").value;
		var id = "<?php echo $v; ?>";
		//alert(id);
		if(value==false)
		{	
			_("status").innerHTML="You havent chosen any!";
		}
		else
		{
		//		alert("else part");
			_("status").innerHTML="please wait";
			var ajax=ajaxObj("POST","check.php");
			ajax.onreadystatechange = function(){
				if(ajaxReturn(ajax) == true){
					if(ajax.responseText!="success"){
						_('status').innerHTML=ajax.responseText;
						alert("not success");
					}
					else{
		//				alert("going to vote");
						window.location = "cam.php";
					}
				}
			}
			ajax.send("vote="+vote+"&id="+id);
			
		}
		return false;

	}   
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

		var overlayreturn=setInterval("overlay()",speed);

	</script> 
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div>
				<h1>Make Voting Corruption free</h1>
			</div>
		</div>
		<div id="nav"></div>
		<div id="body">
			<form id="inputArea">
			<div id="area"><?php echo $memberslist; ?>
			<br />
			<br />

			<input type="button" id="round" class="votebutton" value="Cast your vote" onmousedown='javascript: return castvote();' />
			<span id="status"></span>
			</div>
			</form>
		</div>
	</div>

</body>
</html>
