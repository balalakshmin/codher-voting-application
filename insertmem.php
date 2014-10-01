<?php
include_once("php_includes/db_conx.php");
$cryptpass = base64_encode("123456");
$tbl_users = "INSERT INTO members (name, password) VALUES('Ram Kumar','$cryptpass')";
$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
	echo "<h3> OK :) </h3>"; 
} else {
	echo "<h3> NOT ok:( </h3>"; 
}

$cryptpass = base64_encode("123456");
$tbl_users = "INSERT INTO members (name, password) VALUES('Narayanan','$cryptpass')";
$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
	echo "<h3> OK :) </h3>"; 
} else {
	echo "<h3> NOT ok:( </h3>"; 
}
$cryptpass = base64_encode("123456");
$tbl_users = "INSERT INTO members (name, password) VALUES('Krishnan','$cryptpass')";
$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
	echo "<h3> OK :) </h3>"; 
} else {
	echo "<h3> NOT ok:( </h3>"; 
}
$cryptpass = base64_encode("123456");
$tbl_users = "INSERT INTO members (name, password) VALUES('Shakunthala','$cryptpass')";
$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
	echo "<h3> OK :) </h3>"; 
} else {
	echo "<h3> NOT ok:( </h3>"; 
}
$cryptpass = base64_encode("123456");
$tbl_users = "INSERT INTO members (name, password) VALUES('Parvathy','$cryptpass')";
$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
	echo "<h3> OK :) </h3>"; 
} else {
	echo "<h3> NOT ok:( </h3>"; 
}
$cryptpass = base64_encode("123456");
$tbl_users = "INSERT INTO members (name, password) VALUES('Geetha','$cryptpass')";
$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
	echo "<h3> OK :) </h3>"; 
} else {
	echo "<h3> NOT ok:( </h3>"; 
}
?>