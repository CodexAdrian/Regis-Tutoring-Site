<?php
    include "session.php";
    include "auth.php";
    include "nav.php";
    include "functions.php";
?>
<b class="text-slate-400 text-xl">Tutor application form:</b>
<br>
<br>

<form action="tutor-application-action.php" method="post">

    <!-- We can omit all the user-inputted data and the userID by using session variables -->

    <div>Subject: </div>
    <!-- Drop Down Menu -->
    <div>
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
    </div>


    <div>Please select a teacher as a reference: </div>
    <!-- Drop Down Menu -->
    <div>
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
    </div>

    <!-- From Ethan: We should include a separate field that allows users to give tutees the option to submit additional comments on why they're signing up. This will involve adding another column to the database.
    <b>Additional comments:</b><br>
    <textarea rows="5" cols="60" name="tuteeSignupComments" placeholder="Comments, concerns, area you'd like to focus on, etc."></textarea>
    -->

    <div>Preferred Day: </div>
    <!-- Drop Down Menu -->
    <div>
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
    </div>

    <div>Preferred Time: </div>
    <!-- Drop Down Menu -->
    <div>
        <select name="prefTimeID">
            <?php
                //the drop-down menu for different days
                //Need to fix with regards to new database
                echo "<option value = 1 >Before School</option>";
                echo "<option value = 2 >Community Time</option>";
                echo "<option value = 3 >After School</option>";

            ?>
        </select>
    </div>

    <div>Willing to work as one-on-one tutor: </div>
    <!-- checkbox for if the tutor is willing to work as one-on-one tutor -->
    <div>
        <select name="isPrivate">
            <?php 
                //checkbox for if the tutor is willing to work as 1-1 tutor
                echo "<input type=\"checkbox\" name=\"oneOnOne\" value=\"isPrivate\">";
            ?>
        </select>
    </div>

    <div>Why would you like to become a tutor?</div>
    <!-- textbox for tutors to explain reasoning for becoming a tutor -->
    <div>
        <select name="tutorReason">
            <textarea rows="5" cols="60" name="tuteeSignupComments" placeholder="Comments, concerns, area you'd like to focus on, etc."></textarea>
        </select>
    </div>


    <button type="submit" name="tutorApplicaitonForm" value="Submit Application">
        Submit Application <i class="glyphicon glyphicon-ok"></i>
    </button>
</form>


</body>


</html>