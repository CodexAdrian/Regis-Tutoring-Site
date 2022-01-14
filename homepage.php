<?php
	#Connecting to database server
    $dbc = "";
    include "auth.php";
    include "nav.php";
?>
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
        <!-- Top Nav -->
            <!-- This sidebar will display all the user's data, like their name, picture, etc, using the local variables from the query -->
            <?php
                echo "<a href='tutor-application.php'>Sign up to become a tutor!</a>";
                if($userTypeID == 2) {
                    echo "<a href='teacher-homepage.php'>Teacher Homepage</a>";
                }
            ?>

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