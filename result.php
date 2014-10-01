<?php
include("php_includes/db_conx.php");

	$sql="SELECT * FROM mpconstituency_member";
	$query=mysqli_query($db_conx,$sql);
	$numrows=mysqli_num_rows($query);
	//echo $numrows;
	if($numrows<1){
		$memberslist="there are no contestants";
	}
	else{
		while($rows=mysqli_fetch_array($query,MYSQLI_ASSOC)){
			$mpconst=$rows["mpconstituency_name"];
			$candname=$rows["cand_name"];
			$partyname=$rows["party_name"];
			$votecount=$rows["vote_count"];
			$candsymbol='<img width="30px" height="30px" src="images/'.$candname.'.jpg"/>';
			$memberslist.= " 
			<tr class='gradeX'>
			<td>$mpconst</td>
			<td>$candsymbol</td> 
			<td>$candname</td> 
			<td>$partyname</td>
			<td>$votecount</td>
			</tr>";
		}
		
	}

?>
 


<html>
<head>
<style>
body{
background-image:url('images/dark-wood-texture.jpg');
}
</style>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/ajax.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
  
</head>
<body>
<h1 style="text-align:center";>Results</h1>
		 <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <section class="panel">
                  <div class="panel-body">
                        <div class="adv-table">
                            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered">
                                <thead>
                                <tr>
                                    <th>Mp Constituency</th>
                                    <th>Symbol</th>
                                    <th class="hidden-phone">Candidate Name</th>
                                    <th class="hidden-phone">Party</th>
                                    <th class="hidden-phone">Vote Count</th>
                                </tr>
                                </thead>
								<tbody>
								<?php echo $memberslist ?>
								</tbody>
                            </table>
						</div>
                  </div>
              </section>
              <!-- page end-->
          </section>
     </section>
</body>
</html>

