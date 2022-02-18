
<?php
include "session.php";
#Checks if the session is still maintained
$userID = $_SESSION['userID'];
if ($userID) {
    include "auth.php";
    include "nav.php";
    include "functions.php";
    include "api/user-api.php";

    $eventID = $_GET['eventID'];

    $sql = "DELETE FROM calendarEvents WHERE eventID= '$eventID'";

    //echo $sql . "<br>";


    // delete the row from the table
    $rs = mysqli_query($dbc, $sql);

    header("Location: homepage.php?userID=$userID");
}
?>

