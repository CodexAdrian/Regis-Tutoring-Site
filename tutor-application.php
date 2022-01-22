<?php
    include "session.php";
    include "auth.php";
    include "nav.php";
?>
<b class="text-slate-400 text-xl">Tutor application form:</b>
<br>
<br>

<form action="tutor-application-action.php" method="post">

    <!-- We can omit all the user-inputted data and the userID by using session variables -->

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
    </select>


    <b>Please select a teacher as a reference: </b>
    <!-- Drop Down Menu -->
    <select name="refTeacherID">
        <?php
        // select the data needed to display the drop-down menu for possible teachers
        $sql1 = "SELECT * FROM users WHERE userTypeID = 2;";
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
    </select>

    <!-- From Ethan: We should include a separate field that allows users to give tutees the option to submit additional comments on why they're signing up. This will involve adding another column to the database.
    <b>Additional comments:</b><br>
    <textarea rows="5" cols="60" name="tuteeSignupComments" placeholder="Comments, concerns, area you'd like to focus on, etc."></textarea>
    -->

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
    </select>

    <b>Preferred Time: </b>
    <!-- Drop Down Menu -->
    <select name="prefTimeID">
        <?php
        //the drop-down menu for different days
        echo "<option value = 1 >Before School</option>";
        echo "<option value = 2 >Community Time</option>";
        echo "<option value = 3 >After School</option>";

        ?>
    </select>

    <button type="submit" name="tutorApplicaitonForm" value="Submit Application">
        Submit Application <i class="glyphicon glyphicon-ok"></i>
    </button>
</form>


</body>


</html>