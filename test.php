<html>
<body>
<?php
include "api/login-api.php";
$token = getUserToken($_POST['username'], $_POST['password']);
echo $token . "<br>";
$id = getUserID($token);
echo $id;
?>
</body>
</html>