<?php 
    include "auth.php";

    #Function to automatically query the database and return regis email, given the userID
    function getEmail($userID) {
        $sql = "
            SELECT *
            FROM users
            WHERE userID = $userID
        ";
        $rs = mysqli_query($dbc, $sql);
        $row = mysqli_fetch_array($rs);
        
    }
?>