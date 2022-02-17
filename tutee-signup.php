<?php
    include "session.php";
    include "auth.php";
    include "nav.php";
    include "functions.php";
?>
<b class="text-slate-400 text-xl">Tutee signup form:</b>
<br>
<br>

<form action="tutee-signup-action.php" method="post">

    <!-- Run $_SESSION to get the userID -->
    <!-- Run $_POST get the subject from the calendar link -->
    <!-- Run $_POST to get time slot from the calendar link with prefDayID and prefTimeID -->

    <?php
        $sql = "SELECT * FROM users WHERE userTypeID = 3 INNER JOIN userToTopics ON users.userID = usersToTopics.userID INNER JOIN topics ON usersToTopics.topicID = topics.topicID";   //Still have to create a third user type, tutor, to differentiate between teachers and tutors
        $rs = mysqli_query($dbc, $sql);
        //2/15/22 The person signing up will need to select the tutor, the day, the topic and the timeperiod at a minimum
        ///2/15/22 Will also have to pass in the person's ID and the path to extra material if they want
        //The webpage should already take the time, date, and subject from the calendar link, so all that the user has to input now is their tutor, additional comments, and uploaded files.
        while ($row = mysqli_fetch_array($rs)) {
            $userID = $row['userID'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $subjectID = $row['subjectID'];
            $subjectName = $row['subjectName'];

            echo "<b>Select a tutor:</b>";
            echo "<br>";
            //Echo out all the tutors and their respespective subjects in a dropdown, storing the selected tutor's ID to $selectedTutorID
        }
        $signupDate = $_POST['signupDate'];
        $signupTime = $_POST['signupTime'];
    ?>

    <!-- From Ethan: We should include a separate field that allows users to give tutees the option to submit additional comments on why they're signing up. This will involve adding another column to the database.
    <b>Additional comments:</b><br>
    <textarea rows="5" cols="60" name="tuteeSignupComments" placeholder="Comments, concerns, area you'd like to focus on, etc."></textarea>
    -->

    <button type="submit" name="tuteeSignup" value="Sign up">
        Sign up <i class="glyphicon glyphicon-ok"></i>
    </button>
</form>
</body>
</html>