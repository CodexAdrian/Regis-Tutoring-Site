<?php
	include "auth.php";
	include "session.php";
	include "functions.php";

	# Write form post variables into local variables
	$lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $recipientID = $_POST['recipientID'];
    $subjectID = $_POST['subjectID'];
    $refTeacherID = $_POST['refTeacherID'];
    $prefDayID = $_POST['prefDayID'];
    $prefTimeBlockID = $_POST['prefTimeBlockID'];
	if(isset($oneOnOne)) {
		$oneOnOne = 1;
	}
	else {
		$oneOnOne = 0;
	}
	$tutorReason = $_POST['tutorReason'];
    $fileName = random_bytes(20);

	// $senderID = $_GET['userID'] // also need the userID through a get variable in order to run the insert statement. This GET variable will not work right now. 
	
	// echo ; 
	// exit;
	//Need to fileIO the reasoning

	$sql = "
		INSERT INTO tutorApplications
		(recipientID, senderID, subjectID, refTeacherID, prefDayID, prefTimeBlockID, reasoningFile, oneOnOne) 
		VALUES 
		($recipientID,". $_SESSION['userID'].", $subjectID, $refTeacherID, $prefDayID, $prefTimeBlockID, $fileName, $oneOnOne)
	";		
	//Why doesn't this userID work?

	#Inserting the row into the table
	$rs = mysqli_query($dbc, $sql);
	
	if ($rs) {
		echo "Record Successfully Inserted!";
	}
	else {
		echo "Record Insertion Failed!";	
	}
	
	#Emailing the head of tutoring that a new application has come in
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

	$sql2 = "
		SELECT *
		FROM users
		WHERE userID = $refTeacherID
	";
	$rs2 = mysqli_query($dbc, $sql2);
	$row2 = mysqli_fetch_array($rs2);
	$refTeacherFirstName = $row2['firstName'];
	$refTeacherLastName	= $row2['lastName']; 
	$refTeacherFullName = $refTeacherFirstName . " " . $refTeacherLastName;
	$refTeacherUsername = $row2['userName'];

	$userFirstInitial = substr($_SESSION['firstName'], 0, 0);

	$fullDate = getdate();
	$date = $fullDate['mon'] . "/" . $fullDate['mday'] . "/" . $fullDate['year'];
	$time = $fullDate['hours'] . ":" . $fullDate['minutes'] . ":" . $fullDate['seconds'];
	$fileContents = 
		"From: " . $_SESSION['fullname'] . "at $date $time" . "\r\n" .
		"To: $recipientFullName, referencing $refTeacherFullName" . "\r\n" . 
		$tutorReason
	;
	$myfile = fopen("tutor-applications/$filename.txt", "w") or die("Unable to generate file!");		//Double check that this file declaration works
	fwrite($myfile, $fileContents);
	

	$to = $recipientUsername . "@regis.org";		//Can be replaced by getEmail function eventually
	$subject = "New Tutor Application from: " . $_SESSION['fullName'];
	$message =
		"Dear $recipientFullName: \r\n" . 
		$_SESSION['fullName'] . " has submitted a tutor application for your subject, referencing " . $refTeacherFullName . "." . "\r\n" .
		"Here is their reasoning: $tutor"
	;
	$header = 
		"From: " . $_SESSION['fullName'] . " <" . $_SESSION['username'] . "@regis.org>" . "\r\n" . 
		"CC: " . $refTeacherUsername . "@regis.org"
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