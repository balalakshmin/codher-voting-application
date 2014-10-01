<?php
	include("php_includes/db_conx.php");
	if(isset($_POST["vote"]) && isset($_POST["id"])) {
		$vote = $_POST["vote"];
		$v = $_POST["id"];
		$one=1;
		$sql = "UPDATE mpconstituency_member SET vote_count=vote_count+1 WHERE cand_name='$vote'";
		$query = mysqli_query($db_conx, $sql);
		$sql = "UPDATE voter_mpconstituency SET voted='1' WHERE voter_id='$v'";
		$query = mysqli_query($db_conx, $sql);
		echo "success";	
	} else {
		echo "error";
	}
?>