<?php
include "session.php";
#Checks if the session is still maintained
if ($_SESSION['userID']) {
    include "auth.php";
    include "nav.php";
    include "functions.php";
?>

<form action = "search.php" method = "post">
    <input name = "searchString" size = "20" placeholder = "Search the database">
</form>

<?php
    if(isset($_POST['searchString'])) {
        $searchString = $_POST['searchString'];
        
        echo "<p class=\"text-slate-400 text-2xl mb-2 font-bold\">Search the database</p>";
        echo "<br>";

        #Searching tutors
        $sql = "
            SELECT *
            FROM users
            WHERE userTypeID > 1
            && (firstName LIKE '%$searchString%' || lastName LIKE '%$searchString%')
        ";
        $rs = mysqli_query($dbc, $sql);		
		$rows = mysqli_num_rows($rs);

        if($rows > 0) {
            echo "<p class=\"text-white text-xl\">Users ($rows results)</p>";

            echo "<ul>";
            while ($row = mysqli_fetch_array($rs)) {
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                echo "<div class=\"text-white\">$firstName $lastName</div>";
            }
            echo "</ul><br>";
        }

        #Searching topics
        $sql = "
            SELECT *
            FROM topics            
            INNER JOIN subjects ON topics.subjectID = subjects.subjectID
            WHERE topicName LIKE '%$searchString%'
        ";
        $rs = mysqli_query($dbc, $sql);
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