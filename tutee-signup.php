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
            <!-- Run $_GET to get the subject from the calendar -->

            <?php 
                $sql = "SELECT * FROM users WHERE userID = 2 INNER JOIN userToTopics ON users.userID = usersToTopics.userID INNER JOIN topics ON usersToTopics.topicID = topics.topicID";
                $rs = mysqli_query($dbc, $sql);

                while ($row = mysqli_fetch_array($rs)) {
                    $userID = $row['userID'];
                    $firstName = $row['firstName'];
                    $lastName = $row['lastName'];
                    $subjectID = $row['subjectID'];
                    $subjectName = $row['subjectName'];

                    //Echo out all the tutors and their respesctive subjects in a dropdown
                }
            ?>

            <button type="submit" name="tuteeSignup" value="Sign up">
				Sign up <i class="glyphicon glyphicon-ok"></i>
			</button>
        </form>
    </body>
</html>