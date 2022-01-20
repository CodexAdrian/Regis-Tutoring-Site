<?php
    include "auth.php";
    session_start();

    //Need some way to get the userID; $_GET[]?

    $sql = "SELECT * FROM users WHERE userID = $userID";
    $rs = mysqli_query($dbc, $sql);
    $row = mysqli_fetch_array($rs);

    $userID = $row['userID'];
    $userTypeID = $row['userTypeID'];
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $picture = $row['picture'];
?>