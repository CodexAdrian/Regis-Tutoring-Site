<?php
include "session.php";
#Checks if the session is still maintained
if ($_SESSION['userID']) {
    include "auth.php";
    include "nav.php";
    include "functions.php";
    $userID = $_SESSION['userID'];
?>
<div class = "m-5">
    <p class="text-white text-2xl">Search the Tutor Database</p>
    <br>
    <br>



<form action = "search.php" method = "post">
    <input name = "searchString" size = "20" placeholder = "Search the database">
    <button type="submit" name="search" value="searchDatabase">
</form>


<?php
    if(isset($_POST['searchString'])) {
        $searchString = $_POST['searchString'];
        
        echo "<p class=\"text-white text-2xl mb-2 font-bold\">Data Results</p>";
        echo "<br>";

        #Searching teachers
        $sql = "
            SELECT *
            FROM users
            WHERE userTypeID = 3
            && (firstName LIKE '%$searchString%' OR lastName LIKE '%$searchString%')
        ";
        $rs = mysqli_query($dbc, $sql);		
		$rows = mysqli_num_rows($rs);

        if($rows > 0) {
            echo "<p class=\"text-white text-xl\">Teachers ($rows results)</p>";

            echo "<ul>";
            while ($row = mysqli_fetch_array($rs)) {
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                echo "<div class=\"text-white\">Teacher: $firstName $lastName</div>";
            }
            echo "</ul><br>";
        }

        #Searching tutors
        $sq2 = "
            SELECT firstName, lastName, topicName, subjectName, dayName, timeBlockName 
                FROM tutorInfo
                    INNER JOIN users ON  tutorInfo.userID = users.userID
                    INNER JOIN topics ON tutorInfo.topicID = topics.topicID
                    INNER JOIN subjects ON topics.subjectID = subjects.subjectID
                    INNER JOIN days ON tutorInfo.dayID = days.dayID
                    INNER JOIN timeBlocks ON tutorInfo.timeBlockID = timeBlocks.timeBlockID
            
                    WHERE userTypeID = 2 && (firstName LIKE '%$searchString%' OR lastName LIKE '%$searchString%' OR topicName LIKE '%$searchString%' OR subjectName LIKE '%$searchString%'
                    OR dayName LIKE '%$searchString%' OR timeBlockName LIKE '%$searchString%');
        ";
        $rs = mysqli_query($dbc, $sq2);		
		$rows = mysqli_num_rows($rs);

        if($rows > 0) {
            echo "<p class=\"text-white text-xl\">Tutors ($rows results)</p>";

            echo "<ul>";
            while ($row = mysqli_fetch_array($rs)) {
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $topicName = $row['topicName'];
                $subjectName = $row['subjectName'];
                $dayName = $row['dayName'];
                $timeBlockName = $row['timeBlockName'];

                echo "<div class=\"text-white\">Tutor: $firstName $lastName, $subjectName: $topicName, On $dayName during $timeBlockName </div>";
            }
            echo "</ul><br>";
        }


        #Searching topics
        $sq3 = "
            SELECT *
            FROM topics            
            INNER JOIN subjects ON topics.subjectID = subjects.subjectID
            WHERE topicName LIKE '%$searchString%' OR subjectName LIKE '%$searchString%'
        ";
        $rs = mysqli_query($dbc, $sq3);
		$rows = mysqli_num_rows($rs);

        if($rows > 0) {
            echo "<p class=\"text-white text-xl\">Topics ($rows results)</p>";

            echo "<ul>";
            while ($row = mysqli_fetch_array($rs)) {
                $subjectName = $row['subjectName'];
                $topicName = $row['topicName'];
                echo "<div class=\"text-white\">$subjectName: $topicName</div>";
            }
            echo "</ul><br>";
        }

       
    }
}
else {
    header("Location: index.php");
    exit();
}
?>
<a href = "homepage.php?userID=<?php echo $userID; ?>">Return to the Homepage<span class="material-icons text-white text-3xl pb-10">home</span></a>