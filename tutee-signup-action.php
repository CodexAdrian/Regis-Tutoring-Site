<?php
	include "auth.php";
	include "session.php";
	include "functions.php";
	
	# Write form post variables into local variables
	$eventID = $_POST[''];
	$tutorID = $_POST[''];
	$eventDate = $_POST[''];
	$topicID = $_POST[''];
	$periodID = $_POST[''];
	$fileContents = $_POST[''];
	$filename = random_bytes(20);
	

	#Connecting to database server
	$dbc = mysqli_connect("localhost","tutorDBWebUser","TutoringIsGreat","tutorDB")     //Webuser still has to be made
		or die("Error: Cannot connect to database server");

		
	$sql = "
		INSERT INTO calendarEvents
		(eventID, tutorID, studentID, eventDate, topicID, periodID, extraMaterial) 
		VALUES 
		($eventID, $tutorID, $_SESSION['userID'], $eventDate, $topicID, $periodID, $fileName)
	";	
	
	// insert the row into the table
	$rs = mysqli_query($dbc, $sql);
	
	if ($rs) {
		echo "Record Successfully Inserted!";
	}
	else {
		echo "Record Insertion Failed!";	
	}

	#Emailing the tutor that a new tutee has signed up
	$sql1 = "
		SELECT * 
		FROM users 
		WHERE userID = $recipientID
	";
	$rs1 = mysqli_query($dbc, $sql1);
	$row1 = mysqli_fetch_array($rs1);
	$recipientFirstName = $row1['firstName'];
	$recipientLastName = $row1['lastName'];
	$recipientFullName = $recipientFirstName . " " . $recipientLastName;
	$recipientUsername = $row1['userName'];

	$userFirstInitial = substr($_SESSION['firstName'], 0, 0);

	$fullDate = getdate();
	$date = $fullDate['mon'] . "/" . $fullDate['mday'] . "/" . $fullDate['year'];
	$time = $fullDate['hours'] . ":" . $fullDate['minutes'] . ":" . $fullDate['seconds'];
	$fileContents = 
		"From: " . $_SESSION['fullname'] . "at $date $time" . "\r\n" .
		"To: $recipientFullName, signing up for tutoring." . "\r\n" . 
		$tutorReason
	;

	$myfile = fopen("tutee-signups/$filename.txt", "w") or die("Unable to generate file!");		//Double check that this file declaration works
	fwrite($myfile, $fileContents);
	

	$to = $recipientUsername . "@regis.org";		//Can be replaced by getEmail function eventually
	$subject = "New Tutor Application from: " . $_SESSION['fullName'];
	$message =
		"Dear $recipientFullName: \r\n" . 
		$_SESSION['fullName'] . " has signed up for tutoring in ___, referencing " . $refTeacherFullName . "." . "\r\n" .
		"Here is their reasoning: $tutor"
	;	//2/17: Need to pull the subject
	$header = 
		"From: " . $_SESSION['fullName'] . " <" . $_SESSION['username'] . "@regis.org>" . "\r\n" . 
		"CC: " . $refTeacherFullName . "@regis.org"
	;
	
	if (mail($to,$subject,$message,$headers)) {
		echo "Your application has successfully been submitted.";
	}
	else{
		echo "Something went wrong.";
	}

	fclose($myfile);
?>

<a href="homepage.php">Go back to the Home Page</a>
	
?>

<a href="index.php">Go to the Home Page</a>