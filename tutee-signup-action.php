<?php
	# Write form post variables into local variables
	$lastName = $_POST['lastName'];
	$firstName = $_POST['firstName'];
	$prefDayID = $_POST['prefDayID'];
	$prefTimeID = $_POST['prefTimeID'];
	// $senderID = $_GET['userID'] // also need the userID through a get variable in order to run the insert statement. This GET variable will not work right now. 
	
	// echo ; 
	// exit;
	

	#Connecting to database server
	$dbc = mysqli_connect("localhost","tutorDBWebUser","TutoringIsGreat","tutorDB")     //Webuser still has to be made
		or die("Error: Cannot connect to database server");

		
	$sql = "INSERT INTO tutorApplications
		(recipientID, senderID, subjectID, refTeacherID, prefDayID, prefTimeID) 
		VALUES 
		(recipientID, senderID, subjectID, refTeacherID, prefDayID, prefTimeID)";		

	// will not execute, need to get the senderID first
	//echo $sql . "<br>";
	
	// insert the row into the table
	$rs = mysqli_query($dbc, $sql);
	
	if ($rs) {
		echo "Record Successfully Inserted!";
	}
	else {
		echo "Record Insertion Failed!";	
	}
	
?>

<a href="index.php">Go to the Home Page</a>