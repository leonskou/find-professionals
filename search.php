<?php
require_once('connect.php');
if(isset($_POST) & !empty($_POST)){
	$region = $_POST['region'];
	$city = $_POST['city'];
	$profession = $_POST['profession'];
	performsearch($region,$city,$profession,$connection);
}



 function performsearch($region,$city,$profession,$connection){
            $sqlQuery = "SELECT * FROM `users` where region = '$region' AND city = '$city' AND profession = '$profession'";
            $results = mysqli_query($connection,$sqlQuery);
            $count = mysqli_num_rows($results) + 1;
                       echo "<html> <body> <table>
            <head>
  			<meta charset='UTF-8'>
   			<link rel='stylesheet' href='results.css'>
			<link rel='stylesheet' href='results1.css'>
			</head>
			<div class='table-users'>
  			<div class='header'>Αποτελέσματα</div>
   			<table cellspacing='0'>
      		<tr>
         	<th> <b> Όνομα Χρήστη</th>
         	<th> <b> Νομός</th>
		 	<th> <b> Πόλη</th>
		 	<th> <b> Eπάγγελμα</th>
         	<th align = 'left' > <b> Τηλέφωνο</th>
      		</tr>";

	    if($count==1){
	    	echo "<tr><td>";
	    		    	echo "<td>";
	    		    	echo "<td> <b> No Results found according to your preferences </b>";
	    		    		    	echo "<td>";
	    		    		    		    	echo "<td>";
			echo "</table> </body> </html>";
		}
			else{

            for($i = 1; $i <$count; $i++){
			$row = mysqli_fetch_assoc($results);        	
			echo "<tr> <td>";
			echo $row['username'];
			echo "<td>";
			echo $row['region'];
			echo "<td>";
			echo $row['city'];
			echo "<td>";
			echo $row['profession'];
			echo "<td>";
			echo $row['tel'];
			echo "</tr>";
            }
			echo "</table> </body> </html>";
		}
	}

