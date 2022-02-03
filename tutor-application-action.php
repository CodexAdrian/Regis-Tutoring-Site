<?php
	include "auth.php";
	include "session.php";

	# Write form post variables into local variables
	$recipientID = $_POST['recipientID'];
	$refTeacherID = $_POST['refTeacherID'];
	$prefDayID = $_POST['prefDayID'];
	$prefTimeID = $_POST['prefTimeID'];
	if(isset($isPrivate)) {
		$isPrivate = 1;
	}
	else {
		$isPrivate = 0;
	}
	$tutorReason = $_POST['tutorReason'];
	// $senderID = $_GET['userID'] // also need the userID through a get variable in order to run the insert statement. This GET variable will not work right now. 
	
	// echo ; 
	// exit;
	//Need to fileIO the reasoning
	
	#Connecting to database server
	$dbc = mysqli_connect("localhost","tutorDBWebUser","TutoringIsGreat","tutorDB")     //Webuser still has to be made
		or die("Error: Cannot connect to database server");

		
	$sql = "INSERT INTO tutorApplications
		(recipientID, senderID, subjectID, refTeacherID, prefDayID, prefTimeID, isPrivate) 
		VALUES 
		($recipientID, $_SESSION['userID'], $subjectID, $refTeacherID, $prefDayID, $prefTimeID, $isPrivate)";		

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

<a href="homepage.php">Go to the Home Page</a>