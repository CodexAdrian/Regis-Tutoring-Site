<?php
	include "auth.php";
	include "session.php";
	include "functions.php";

	# Write form post variables into local variables
    $recipientID = $_POST['recipientID'];
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
    $fileName = uniqid('', true);

	$sql0 = "
		SELECT * FROM users
			INNER JOIN subjects ON users.deptID = subjects.subjectID
			WHERE userTypeID = 3 AND isDeptHead = 1 AND userID = '$recipientID' ;
	";

	$rs0 = mysqli_query($dbc, $sql0);
	$row0 = mysqli_fetch_array($rs0);
	$subjectID = $row0['subjectID'];

	//echo "$subjectID";

	// echo ; 
	// exit;
	//Need to fileIO the reasoning 

	$sql = "
		INSERT INTO tutorApplications
		(recipientID, senderID, subjectID, refTeacherID, prefDayID, prefTimeBlockID, reasoningFile, oneOnOne) 
		VALUES 
		($recipientID,". $_SESSION['userID'].", $subjectID, $refTeacherID, $prefDayID, $prefTimeBlockID, '$fileName', $oneOnOne)
	";

	//echo "$sql";
	
	#Inserting the row into the table
	$rs = mysqli_query($dbc, $sql);
	
	if ($rs) {
		//echo "Record Successfully Inserted!";
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
	//$myfile = fopen("tutor-applications/$fileName.txt", "w") or die("Unable to generate file!");		//Double check that this file declaration works
	//fwrite($myfile, $fileContents);
	

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
		//echo "Your application has successfully been submitted.";
	}
	else{
		echo "Something went wrong.";
	}

	//fclose($myfile);
    header("Location: homepage.php?userID=".$_SESSION['userID']);
?>
