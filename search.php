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

        #Searching tutors
        $sql = "
            SELECT *
            FROM users
            WHERE typeID > 1
            && (firstName LIKE '%$searchString%' || lastName LIKE '%$searchString%')
        ";
        $rs = mysqli_query($dbc, $sql);		
		$rows = mysqli_num_rows($rs);

        echo "<div>Search results for $searchString:</div>";

        if($rows > 0) {
            echo "<div>Users ($rows results)</div>";

            echo "<ul>";
            while ($row = mysqli_fetch_array($rs)) {
                echo "$firstName $lastName";
            }
        }
    }
}
else {
    header("Location: index.php");
    exit();
}
?>