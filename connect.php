<?php

$connection = mysqli_connect("localhost","root","");
if(!$connection){
	echo "Failed to connect to database" . die(mysqli_error($connection));
}

$selectdb = mysqli_select_db($connection,"findPro2");
if(!$selectdb){
	echo "Failed to select database" . die(mysqli_error($connection));
}



?>
