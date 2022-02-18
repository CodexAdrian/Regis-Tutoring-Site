<?php
include "api/login-api.php";
include "api/user-api.php";
include "session.php";
$token = getUserToken($_POST['username'], $_POST['password']);
$id = getUserID($token);
$userProfile = getUserProfile($id, $token);
header("Location: homepage.php?userID=$userProfile->id");
?>
