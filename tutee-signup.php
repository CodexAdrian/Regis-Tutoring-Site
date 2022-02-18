<?php
include "session.php";
if (isset($_SESSION['userID'])) {
    include "auth.php";
    include "nav.php";
    include "functions.php";
    include "api/user-api.php"
?>
    <b class="text-slate-400 text-xl">Tutee signup form:</b>
    <br>
    <br>

    <form action="tutee-signup-action.php" method="post">
        <select class ='bg-gray-700' name="tutorID">

            <?php

            $sql1 = "
            SELECT tutorInfo.userID, users.firstName, users.lastName, topics.topicID, topicName, subjectName, timeBlockName 
                FROM tutorInfo
    
                    INNER JOIN users ON  tutorInfo.userID = users.userID
                    INNER JOIN topics ON tutorInfo.topicID = topics.topicID
                    INNER JOIN subjects ON topics.subjectID = subjects.subjectID
                    INNER JOIN days ON tutorInfo.dayID = days.dayID
                    INNER JOIN timeBlocks ON tutorInfo.timeBlockID = timeBlocks.timeBlockID
    
                    WHERE userTypeID = 2
                    ORDER BY topics.topicID;  
            ";


            $rs = mysqli_query($dbc, $sql1);     //Need to rewrite the query
            //2/15/22 The person signing up will need to select the tutor, the day, the topic and the timeperiod at a minimum
            //2/15/22 Will also have to pass in the person's ID and the path to extra material if they want

            //for now, each tutor is linked to only one topic. So by passing the tutorID, we know what topic they are tutoring. (Need a many to many to do more topics down the road)
            while ($row = mysqli_fetch_array($rs)) {
                $tutorID = $row['userID'];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $topicID = $row['topicID'];
                $topicName = $row['topicName'];
                $subjectName = $row['subjectName'];
                $timeBlockName = $row['timeBlockName'];

                echo "<option class ='bg-gray-700' value='$tutorID'>$firstName $lastName, $topicName, $timeBlockName </option>";

                //Echo out all the tutors and their respespective subjects in a dropdown, storing the selected tutor's ID to 
            }

            ?>
        </select>

        <select class ='bg-gray-700' name="periodID">
        <?php

        $sql2 = "
                SELECT periodID, startTime, endTime, timeBlockName
                FROM periods
                INNER JOIN timeBlocks ON periods.timeBlockID = timeBlocks.timeBlockID;  
            ";


        $rs = mysqli_query($dbc, $sql2);     //Need to rewrite the query
        //2/15/22 The person signing up will need to select the tutor, the day, the topic and the timeperiod at a minimum
        //2/15/22 Will also have to pass in the person's ID and the path to extra material if they want

        //for now, each tutor is linked to only one topic. So by passing the tutorID, we know what topic they are tutoring. (Need a many to many to do more topics down the road)
        while ($row = mysqli_fetch_array($rs)) {
            $periodID = $row['periodID'];
            $startTime = $row['startTime'];
            $endTime = $row['endTime'];
            $timeBlockName = $row['timeBlockName'];

            echo "<option class ='bg-gray-700' value ='$periodID'>$startTime-$endTime,  $timeBlockName </option>";

        }

        ?>
        </select>


        <select class ='bg-gray-700' name="eventDate">
        <?php

        $sql3 = "
            SELECT * 
                FROM dateDesc 
                WHERE dateDesc.schoolDate > DATE(SYSDATE())
                ORDER BY schoolDate;  
            ";


        $rs = mysqli_query($dbc, $sql3);     
        //2/15/22 The person signing up will need to select the tutor, the day, the topic and the timeperiod at a minimum
        //2/15/22 Will also have to pass in the person's ID and the path to extra material if they want

        //for now, each tutor is linked to only one topic. So by passing the tutorID, we know what topic they are tutoring. (Need a many to many to do more topics down the road)
        $index = 0;
        while ($row = mysqli_fetch_array($rs)) {
            $index++;
            $schoolDate = $row['schoolDate'];
            $letterDay = $row['letterDay'];

            echo "<option class ='bg-gray-700' value ='$schoolDate'>$schoolDate, $letterDay</option>";
            
            if ($index >= 5){
                break;
            }
        }

        ?>
        </select>
    
    

</form> 

            <button type=" submit" name="tuteeSignup" value="Sign up">
            Sign up <i class="glyphicon glyphicon-ok"></i>
            </button>
    </form>
    </body>

    </html>
<?php
} #Redirects users back to the index page if session times out.
else {
    echo "Your session has expired. Redirecting...";
    header("Location: cs.regis.org/tutor");
    exit();
}
?>