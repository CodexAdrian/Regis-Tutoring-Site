<?php
include "session.php";
if(isset($_SESSION['userID'])){
        include "auth.php";
        include "nav.php";
        include "api/user-api.php";
?>
<div class = "m-5">
<p class="text-white text-2xl">Tutor application form:</p>
<br>
<br>

<form action="tutor-application-action.php" method="post">

    <!-- We can omit all the user-inputted data and the userID by using session variables -->

    <div>Subject: </div>
    <!-- Drop Down Menu -->
    <div>
        <select class ='bg-gray-700' name="recipientID">
            <?php
                // select the data needed to display the drop-down menu for subjects
                $sql1 = "SELECT * FROM users
                INNER JOIN subjects ON users.deptID = subjects.subjectID
                WHERE userTypeID = ". UserType::Teacher ." && isDeptHead = 1 && subjectID < 7;";
                //echo $sql;
                $rs = mysqli_query($dbc, $sql1);

                while ($row = mysqli_fetch_array($rs)) {
                    $teacherID =  $row['userID'];
                    $userName =  $row['userName'];
                    $subjectID =  $row['subjectID'];
                    $subjectName =  $row['subjectName'];

                    // echo an option value into the select field
                    echo "<option class ='bg-gray-700' value = '$teacherID'>$subjectName</option>";

                } //end of while loop
            ?>
        </select>
    </div>


    <div>Please select a teacher as a reference: </div>
    <!-- Drop Down Menu -->
    <div>
        <select class ='bg-gray-700' name="refTeacherID">
            <?php
                // select the data needed to display the drop-down menu for possible teachers
                $sql2 = "SELECT * FROM users WHERE userTypeID = " . UserType::Teacher . ";";
                //echo $sql;
                $rs = mysqli_query($dbc, $sql2);

                while ($row = mysqli_fetch_array($rs)) {
                    $refTeacherID = $row['userID'];
                    $refTeacherFirstName = $row['firstName'];
                    $refTeacherLastName = $row['lastName'];

                    // echo an option value into the select field
                    echo "<option class ='bg-gray-700' value = $refTeacherID>$refTeacherLastName, $refTeacherFirstName</option>";

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
        <select class ='bg-gray-700' name="prefDayID">
            <?php
                //the drop-down menu for different days
                echo "<option class ='bg-gray-700' value = 1 >Monday</option>";
                echo "<option class ='bg-gray-700' value = 2 >Tuesday</option>";
                echo "<option class ='bg-gray-700' value = 3 >Wednesday</option>";
                echo "<option class ='bg-gray-700' value = 4 >Thursday</option>";
                echo "<option class ='bg-gray-700' value = 5 >Friday</option>";

            ?>
        </select>
    </div>

    <div>Preferred Time: </div>
    <!-- Drop Down Menu -->
    <div>
        <select class ='bg-gray-700' name="prefTimeBlockID">
            <?php
                //the drop-down menu for different days
                //Need to fix with regards to new database
                echo "<option class ='bg-gray-700' value = 1 >Before School</option>";
                echo "<option class ='bg-gray-700' value = 2 >Community Time</option>";
                echo "<option class ='bg-gray-700' value = 3 >After School</option>";

            ?>
        </select>
    </div>

    <div>Willing to work as one-on-one tutor: </div>
    <!-- checkbox for if the tutor is willing to work as one-on-one tutor -->
    <div>
            <?php 
                //checkbox for if the tutor is willing to work as 1-1 tutor
                echo "<input type=\"checkbox\" name=\"oneOnOne\" value=\"oneOnOne\">";
            ?>
    </div>

    <div>Why would you like to become a tutor?</div>
    <!-- textbox for tutors to explain reasoning for becoming a tutor -->
    <div>
            <textarea class ='bg-gray-700 text-white' rows="5" cols="60" name="tutorReason" placeholder="Comments, concerns, area you'd like to focus on, etc."></textarea>
    </div>


    <button type="submit" name="tutorApplicationForm" value="Submit Application">
        Submit Application <i class ='bg-gray-700' class="glyphicon glyphicon-ok"></i>
    </button>
</form>
            </div>

</body>


</html>
<?php 
}
#Redirects users back to the index page if session times out.
else {
    echo "Your session has expired. Redirecting...";
    header("Location: index.php");
    exit();
}
?>