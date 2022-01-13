<!DOCTYPE html>

<?php
	#Connecting to database server
	$dbc = mysqli_connect("localhost","tutorDBWebUser","TutoringIsGreat","tutorDB")     //Webuser still has to be made
		or die("Error: Cannot connect to database server");
?>

<html>
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="output.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Tutoring Homepage</title>
        <!-- The rest of the necessary miscellaneous heading data, like author, description, etc will be typed here -->
    </head>

    <body>
        <?php
            $userID = $_POST['userID'];
            $sql = "SELECT * FROM users WHERE userID = $userID";
            $rs = mysqli_query($dbc, $sql);

            while ($row = mysqli_fetch_array($rs)) {
                $userID = $row['userID'];
                $userTypeID = $row['userTypeID'];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $picture = $row['picture'];
            }
        ?>
        <div class="sidenav">
            <!-- This sidebar will display all the user's data, like their name, picture, etc, using the local variables from the query -->
            <?php
                echo "<a href='tutor-application.php'>Sign up to become a tutor!</a>";
                if($userTypeID == 2) {
                    echo "<a href='teacher-homepage.php'>Teacher Homepage</a>";
                }
            ?>
        </div>
        
        <?php
            $sql = "SELECT * FROM subjects INNER JOIN users ON subjects.teacherID = users.userID";
            $rs = mysqli_query($dbc, $sql);

            while ($row = mysqli_fetch_array($rs)) {
                $subjectID = $row['subjectID'];
                $subjectName = $row['subjectName'];
                $teacherID = $row['teacherID'];

                //Ignoring formatting for now
                echo "<a href='calendar.php?subjectID=$subjectID'>$subjectName</a>";
                echo "<br>";
                echo $firstName . " " . $lastName;
        ?> 
        Tutors
        <ul>
            <!-- This unordered list will list all the tutors, with names linked to an email form that allows students to email tutors directly.
            Each link will pass in the tutor's student ID in a query string -->
        </ul>
        <?php
            }
        ?>
    </body>
</html>