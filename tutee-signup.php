<?php
    $dbc = "";
    include "auth.php";
    include "nav.php";
	
?>
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