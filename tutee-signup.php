<?php
	#Connecting to database server
	$dbc = mysqli_connect("localhost","tutorDBWebUser","TutoringIsGreat","tutorDB")     //Webuser still has to be made
		or die("Error: Cannot connect to database server");
?>

<html>
	<head>
	<title>Tutee Signup Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	
	<body>
        <form action="tutee-signup-action.php" method="post">

            <!-- Run $_GET to get the user ID from link -->
            <!-- Run $_POST get the subject from the calendar link -->
            <!-- Run $_POST to get time slot from the calendar link with prefDayID and prefTimeID -->

            <?php 
                $sql = "SELECT * FROM users WHERE userTypeID = 3 INNER JOIN userToTopics ON users.userID = usersToTopics.userID INNER JOIN topics ON usersToTopics.topicID = topics.topicID";
                $rs = mysqli_query($dbc, $sql);
                //The webpage should already take the userID, time, date, and subject from the calendar link, so all that the user has to input now is their tutor, additional comments, and uploaded files.
                while ($row = mysqli_fetch_array($rs)) {
                    $userID = $row['userID'];
                    $firstName = $row['firstName'];
                    $lastName = $row['lastName'];
                    $subjectID = $row['subjectID'];
                    $subjectName = $row['subjectName'];

                    echo "<b>Select a tutor:</b>";
                    echo "<br>";
                    //Echo out all the tutors and their respesctive subjects in a dropdown, storing the selected tutor to 
                }
                $signupDate = $_POST['signupDate'];
                $signupTime = $_POST['signupTime'];
            ?>

            <button type="submit" name="tuteeSignup" value="Sign up">
				Sign up <i class="glyphicon glyphicon-ok"></i>
			</button>
        </form>
    </body>
</html>