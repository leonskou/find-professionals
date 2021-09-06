<?php
require_once('connect.php');
if(isset($_POST) & !empty($_POST)){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    $region = $_POST['region'];
    $city = $_POST['city'];
    $profession = $_POST['profession'];
    $tel = $_POST['tel'];

    $usernameForTextBox;
    $emailForTextBox;
    $usernameExists;   
    $emailExists;
    $registerStatus;

if($passwordConfirm == $password)
{
        $usernameExists = checkUsernameAvailiability($username,$connection);
        $emailExists = checkEmailAvailiability($email,$connection);
        if($usernameExists == false & $emailExists == false){
           $registerStatus = registerUser($username,$email,$password,$region,$city,$profession,$tel,$connection);
           if($registerStatus == true){
            $successMessage = "User registration completed successfully, hit the Already have an account? Login now to proceed to login page";
           }
           else{
            $failureMessage = "User registration failed";
           }
        }
        elseif($usernameExists == true & $emailExists == true){
            $failureMessage = "This username and email already exists";
        }
        elseif ($usernameExists == true) {
            $failureMessage = "This username already exists";
        }
        else{
            $failureMessage = "This email already exists";
        }
}
else{
    $failureMessage = "Passwords dont match, user registration failed";
    $usernameForTextBox = $username;
    $emailForTextBox = $email;
    }
}

?>

<?php

        function checkUsernameAvailiability($usernameToBeChecked,$connection){
            $sqlCheckUsername = "SELECT * FROM `users` where username = '$usernameToBeChecked'";
            $results = mysqli_query($connection,$sqlCheckUsername);
            $count = mysqli_num_rows($results);
            if($count==0){
                return false;
            }
            else{
                return true;
            }
        }

        function checkEmailAvailiability($emailToBeChecked,$connection) {
           $sqlCheckEmail = "SELECT * FROM `users` where email = '$emailToBeChecked'";
           $results = mysqli_query($connection,$sqlCheckEmail);
           $count = mysqli_num_rows($results);
           if($count==0){
                return false;
            }
            else{
                return true;
            }
        } 

        function registerUser($username,$email,$password,$region,$city,$profession,$tel,$connection){
        $sql = "INSERT INTO `users` (username,email,password,region,city,profession,tel) VALUES ('$username','$email','$password','$region','$city','$profession','$tel')";
        $result = mysqli_query($connection,$sql);
            if($result){
                return true;
            }
            else
            {
                return false;
                $usernameForTextBox = $username;
                $emailForTextBox = $email;
            }
        }
?>


<html>
<body>
<head>
  <meta charset="UTF-8">
<title>Εγγραφή</title>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

<link rel="stylesheet" href="registerStyle.css" >

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<div class="container">
	  <?php if(isset($successMessage)){ ?> <div class="alert alert-success" role="alert"> <?php  echo $successMessage; ?> </div> <?php } ?>
      	  <?php if(isset($failureMessage)){ ?> <div class="alert alert-danger" role="alert"> <?php echo $failureMessage; ?> </div> <?php } ?>
      <form class="form-signin" action = "register.php" method="post">
       <!-- <h2 class="form-signin-heading">Please Register</h2> -->
        <div class="input-group">
	  <input type="text" name="username" class="form-control" placeholder="Username" 
      value="<?php if(isset($usernameForTextBox) & !empty($usernameForTextBox)){ echo $usernameForTextBox;} ?>" required>
	</div>
        <label for="inputEmail" class="sr-only">Email address</label>
       <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" 
        value="<?php if(isset($emailForTextBox) & !empty($emailForTextBox)){ echo $emailForTextBox ;}    ?>" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Κωδικός" required>
        <label for="inputPasswordConfirm" class="sr-only">Password</label>
        <input type="password" name="passwordConfirm" id="inputPasswordConfirm" class="form-control" placeholder="Επιβεβαίωση Κωδικού" require>
		    <input type="text" name="region" id="Region" class="form-control" placeholder="Νομός" required>
		    <input type="text" name="city" id="City" class="form-control" placeholder="Πόλη" required>
		    <input type="text" name="profession" id="Profession" class="form-control" placeholder="Eπάγγελμα" required>
		    <input type="text" name="tel" id="Tel" class="form-control" placeholder="Τηλέφωνο" required>
        <button class="btn btn-primary btn-block btn-large" id="registerBtn" type="submit">Εγγραφή</button>
        <A href="file:///C:/Users/leo/Desktop/v1/login.html"> <u> Έχετε λογαριασμό?  Είσοδος</u> </A>
      </form>
</div>
<a href="home.html"><span class='pulse-button'>Αρχικη</span> </a>
</body>
</html>
