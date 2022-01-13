<<<<<<< Updated upstream
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
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            red: 'D61341'
                        }
                    }
                }
            }
        </script>
        <!-- The rest of the necessary miscellaneous heading data, like author, description, etc will be typed here -->
    </head>
<?php
	#Connecting to database server
    $dbc = "";
    include "auth.php";

?>
    <body class="m-0" style="background-color: #20182D">
        <?php
        /* commented out because it is causing page not to load
            $userID = $_GET['userID'];
            $sql = "SELECT * FROM users WHERE userID = $userID";
            $rs = mysqli_query($dbc, $sql);

            while ($row = mysqli_fetch_array($rs)) {
                $userID = $row['userID'];
                $userTypeID = $row['userTypeID'];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $picture = $row['picture'];
            }*/
        ?>
        <div class="flex flex-col w-max">
        <div class="flex flex-row m-2"><!-- Top Nav -->
            <div><span class="material-icons text-white text-3xl p-4">menu</span></div>
            <div class="rounded-3xl p-2 content-center justify-center mt-auto mb-auto ml-10 flex flex-row h-min" style="background-color: #575271"><span class="material-icons text-white ml-2">search</span><p class="text-white ml-3 mr-80">Search</p></div>
            <div class="rounded-3xl p-2 content-center justify-center mt-auto mb-auto ml-3 flex flex-row h-min" style="background-color: #D61341"><p class="text-white ml-3">Tutor Sign Up</p><span class="material-icons text-white ml-2 mr-3">school</span></div>
            <div class="w-max"></div>
            <div><p>Test</p></div>
        </div><!-- Top Nav -->
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
        <ul class="">
            <!-- This unordered list will list all the tutors, with names linked to an email form that allows students to email tutors directly.
            Each link will pass in the tutor's student ID in a query string -->
        </ul>
        <?php
            }
        ?>
    </body>
</html>