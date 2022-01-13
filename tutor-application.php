<?php
	#Connecting to database server
	$dbc = mysqli_connect("localhost","tutorDBWebUser","TutoringIsGreat","tutorDB")     //Webuser still has to be made
		or die("Error: Cannot connect to database server");
?>

<html>
	<head>
	<title>Tutor Application Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	
	<body>
		<b>This is the tutor application form</b>
		<br>
		<br>
		
		<form action="tutor-application-action.php" method="post">
			
			<!-- need to run a GET variable with the userID -->
			
			<b>Last Name: </b><input name="lastName" size="20"><br>
			<b>First Name: </b><input name="firstName" size="20"><br>	<!-- From Ethan: Do we really need this if we already have ths uer ID? -->
			
			<b>Subject: </b> 
			<!-- Drop Down Menu -->
			<select name="recipientID">
			<?php
				// select the data needed to display the drop-down menu for subjects
				$sql1 = "SELECT * FROM subjects;";
				//echo $sql;
				$rs = mysqli_query($dbc, $sql1);
				
				while ($row = mysqli_fetch_array($rs)) {
					$subjectID = $row['subjectID'];
					$subjectName = $row['subjectName'];
					$teacherID = $row['teacherID'];
					
					// echo an option value into the select field
					echo "<option value = '$teacherID'>$subjectName</option>";
					
				} //end of while loop
			?>
			</select >
			
			
			<b>Please select a teacher as a  reference: </b> 
			<!-- Drop Down Menu -->
			<select name="refTeacherID">
			<?php
				// select the data needed to display the drop-down menu for possible teachers
				$sql1 = "SELECT * FROM users 
							WHERE userTypeID = 2;";
				//echo $sql;
				$rs = mysqli_query($dbc, $sql1);
				
				while ($row = mysqli_fetch_array($rs)) {
					$userID = $row['userID'];
					$firstName = $row['firstName'];
					$lastName = $row['lastname'];
					$picture = $row['picture'];
					
					// echo an option value into the select field
					echo "<option value = '$userID'>$lastName</option>";
					
				} //end of while loop
			?>
			</select >			
			
			<b>Preferred Day: </b>
			<!-- Drop Down Menu -->
			<select name="prefDayID">
			<?php
				//the drop-down menu for different days
				echo "<option value = 1 >Monday</option>";
				echo "<option value = 2 >Tuesday</option>";
				echo "<option value = 3 >Wednesday</option>";
				echo "<option value = 4 >Thursday</option>";
				echo "<option value = 5 >Friday</option>";
				
			?>
			</select >
						
			<b>Preferred Time: </b>
			<!-- Drop Down Menu -->
			<select name="prefTimeID">
			<?php
				//the drop-down menu for different days
				echo "<option value = 1 >Before School</option>";
				echo "<option value = 2 >Community Time</option>";
				echo "<option value = 3 >After School</option>";
				
			?>
			</select >
			
			<button type="submit" name="tutorApplicaitonForm" value="Submit Application">
				Submit Application <i class="glyphicon glyphicon-ok"></i>
			</button>
		</form>
	
			
	</body>


</html>