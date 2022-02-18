
<?php
include "session.php";
#Checks if the session is still maintained
if ($_SESSION['userID']) {
    include "auth.php";
    include "nav.php";
    include "functions.php";
    include "api/user-api.php";
	
    $eventID = $_GET['eventID'];

	$sql = "DELETE FROM calendarEvents WHERE eventID= '$eventID'";	

	//echo $sql . "<br>";
	

	// delete the row from the table
	$rs = mysqli_query($dbc, $sql);

	if ($rs) {
		echo "Record Successfully Deleted!";
	}
	else {
		echo "Record Deletion Failed!";	
	}


?>

<a href="index.php">Return to the homepage</a>