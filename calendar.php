<?php
include "session.php";
#Checks if the session is still maintained
if ($_SESSION['userID']) {
    include "auth.php";
    include "nav.php";
    include "functions.php";
    include "api/user-api.php";
    // commented out because it is causing page not to load
    $userID = $_GET['userID'];
    $sql = "SELECT * FROM users WHERE userID = $userID";
    $rs = mysqli_query($dbc, $sql);
    $row = mysqli_fetch_array($rs);
    $_SESSION['userID'] = $row['userID'];
    $_SESSION['userTypeID'] = $row['userTypeID'];
    $_SESSION['firstName'] = $row['firstName'];
    $_SESSION['lastName'] = $row['lastName'];
    $_SESSION['picture'] = $row['picture'];

} else {
    header("Location: index.php");
    exit();
}