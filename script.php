<?php
require_once('connect.php');
$sqlCheckUser = "SELECT * FROM `users` where active = 'true'";
$results = mysqli_query($connection,$sqlCheckUser);
$count = mysqli_num_rows($results);
if($count != 0){
	showUserProfile($results);
	exit;	
}
else{
	header('Location: chooseLoginRegister.html');
	exit;
}

function showUserProfile($results){
	
	$row = mysqli_fetch_assoc($results);
	echo "<html><h3>Όνομα Χρήστη : ";
	echo $row['username'];
	echo "<br>e-mail : ";
	echo $row['email'];
	echo "<br>Νομός : ";
	echo $row['region'];
	echo "<br>Πόλη : ";
	echo $row['city'];
	echo "<br>Επάγγελμα : ";
	echo $row['profession'];
	echo "<br>Τηλέφωνο : ";
	echo $row['tel'];
	echo "<br><a href='home.html'>Αρχική </a>";
	echo "</html>";

}

?>
