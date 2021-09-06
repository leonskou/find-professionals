<?php
require_once('connect.php');
if(isset($_POST) & !empty($_POST)){
$username = $_POST['username'];
$password = $_POST['password'];

$loginStatus = checkUser($username,$password,$connection);
if($loginStatus == true){
   $res = setActive($username,$connection);
	header('Location: home.html');
   exit;
}
else{
	header('Location: login.html');
}
}

	function checkUser($username,$password,$connection){
		   $sqlCheckUser = "SELECT username FROM `users` where username = '$username' AND password = '$password'";
         $results = mysqli_query($connection,$sqlCheckUser);
         $count = mysqli_num_rows($results);
         if($count == 1){
         	return true;
         }
         else{
         	return false;
         }
	}

   function setActive($username,$connection){
      $sqlCheckUsername = "UPDATE `users` set active = true where username = '$username'";
      $results = mysqli_query($connection,$sqlCheckUsername);
      }

?>