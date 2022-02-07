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
		($recipientID, " . $_SESSION['userID'] . ", $subjectID, $refTeacherID, $prefDayID, $prefTimeID, $isPrivate)";		

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
	
	#Emailing the teacher that a new application has come in
	$sql1 = "
		SELECT * 
		FROM users 
		WHERE userID = $recipientID
	";
	$rs1 = mysqli_query($dbc, $sql1);
	$row1 = mysqli_fetch_array($rs);
	$recipientFirstName = $row[2];
	$recipientLastName = $row[3];
	$recipientFirstInitial = substr($recipientFirstName, 0, 0);

	$sql2 = "
		SELECT *
		FROM users
		WHERE userID = $refTeacherID
	";
	$rs2 = mysqli_query($dbc, $sql2);
	$row2 = 

	$to = $recipientFirstInitial . $recipientLastName . "@regis.org";
	$subject = "New Tutor Application from: " . $_SESSION['firstName'] . " " . $_SESSION['lastName'];
	$message = $_SESSION['firstName'] . " " . $_SESSION['lastName'] . " has submitted a tutor application for your class, referencing " . $refTeacherFirstName . " " . $refTeacherLastName . ".";	
?>

<a href="homepage.php">Go to the Home Page</a>