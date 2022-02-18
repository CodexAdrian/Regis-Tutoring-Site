<?php
include "session.php";
#Checks if the session is still maintained
if ($_SESSION['userID']) {
    include "auth.php";
    include "nav.php";
    include "functions.php";

?>

<?php 
}
else {
    header("Location: index.php");
    exit();
}
?>
?>