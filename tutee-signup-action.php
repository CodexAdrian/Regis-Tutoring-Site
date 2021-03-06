<?php
include "auth.php";
include "session.php";
include "functions.php";

# Write form post variables into local variables
$tutorID = $_POST['tutorID'];
$eventDate = $_POST['eventDate'];
$periodID = $_POST['periodID'];
$additionalComments = $_POST['additionalComments'];	//Make sure this name matches what we expect from signup
$fileName = uniqid('', true);

#Pulling the topicID from the database

$sql0 = "
	SELECT topics.topicID 
	FROM tutorInfo

	INNER JOIN users ON  tutorInfo.userID = users.userID
	INNER JOIN topics ON tutorInfo.topicID = topics.topicID
	INNER JOIN subjects ON topics.subjectID = subjects.subjectID
	INNER JOIN days ON tutorInfo.dayID = days.dayID
	INNER JOIN timeBlocks ON tutorInfo.timeBlockID = timeBlocks.timeBlockID

	WHERE users.userID = '$tutorID';  
";

#writing topicID into a variable

$rs0 = mysqli_query($dbc, $sql0);
$row0 = mysqli_fetch_array($rs0);
$topicID = $row0['topicID'];

//" . $_SESSION['userID'] . "
//echo "test2  ";

#Inserting the entry into the table
$sqlInsert = "
	INSERT INTO calendarEvents
	(tutorID, studentID, eventDate, topicID, periodID, extraMaterial) 
	VALUES 
	('$tutorID', '{$_SESSION['userID']}', '$eventDate', '$topicID', '$periodID', '$fileName')
";

//echo "$sqlInsert";

$rs = mysqli_query($dbc, $sqlInsert);

if ($rs) {
	//echo "Record Successfully Inserted!";
} else {
	echo "Record Insertion Failed!";
}


#Querying for recipient information
$sql1 = "
	SELECT * 
	FROM users 
	WHERE userID = '$tutorID'
";
$rs1 = mysqli_query($dbc, $sql1);
$row1 = mysqli_fetch_array($rs1);
$recipientFirstName = $row1['firstName'];
$recipientLastName = $row1['lastName'];
$recipientFullName = $recipientFirstName . " " . $recipientLastName;
$recipientUsername = $row1['userName'];

#Querying for topicName
$sqli2 = "
	SELECT *
	FROM topics
	WHERE topicID = $topicID
";
$rs2 = mysqli_query($dbc, $sqli2);
$row2 = mysqli_fetch_array($rs2);
$topicName = $row2['topicName'];

#Querying for the start and end times
$sqli3 = "
	SELECT *
	FROM periods
	WHERE periodID = $periodID
";
$rs3 = mysqli_query($dbc, $sqli3);
$row3 = mysqli_fetch_array($rs3);
$startTime = $row3['startTime'];
$endTime = $row3['endTime'];

$userFirstInitial = substr($_SESSION['firstName'], 0, 0);

#Establishing time of request
$fullDate = getdate();
$date = $fullDate['mon'] . "/" . $fullDate['mday'] . "/" . $fullDate['year'];
$time = $fullDate['hours'] . ":" . $fullDate['minutes'] . ":" . $fullDate['seconds'];

#Creating file contents
$fileContents =
	"From: " . $_SESSION['fullname'] . "at $date $time" . "\r\n" .
	"To: $recipientFullName, signing up for tutoring for $topicName from $startTime to $endTime" . "\r\n" .
	$additionalComments
;
/*
$myfile = fopen("tutee-signups/$fileName.txt", "w") or die("Unable to generate file!");		//Double check that this file declaration works
fwrite($myfile, $fileContents);

fclose($myfile);
*/
$to = $recipientUsername . "@regis.org";		//Can be replaced by getEmail function eventually
$subject = "New Tutee Signup from " . $_SESSION['fullname'];
$message =
	"Dear $recipientFullName: \r\n" .
	$_SESSION['fullname'] . " has signed up for tutoring in $topicName, from $startTime to $endTime" . $refTeacherFullName . "." . "\r\n" .
	"Here is their reasoning: $additionalComments" . "\r\n" .
	"Don't be late!"
;
$headers =
	"From: " . $_SESSION['fullname'] . '<' . $_SESSION['username'] . '@regis.org>' . "\r\n" .
	"CC: " . $_SESSION['fullname'] . '@regis.org';

	//"From: " . $_SESSION['fullname'] . " <" . $_SESSION['username'] . "@regis.org>" . "\r\n" .


if (mail($to, $subject, $message, $headers)) {
	//echo "Your application has successfully been submitted.";
} else {
	echo "Something went wrong.";
}

header("Location: homepage.php?userID=".$_SESSION['userID']);

?>
