<?php
include "session.php";
#Checks if the session is still maintained
if ($_SESSION['userID']) {
    include "auth.php";
    include "nav.php";
    include "functions.php";
    include "api/user-api.php";
    // commented out because it is causing page not to load
    $sql = "SELECT * FROM users WHERE userID = $userID";
    $rs = mysqli_query($dbc, $sql);
    $row = mysqli_fetch_array($rs);
    $_SESSION['userID'] = $row['userID'];
    $_SESSION['userTypeID'] = $row['userTypeID'];
    $_SESSION['firstName'] = $row['firstName'];
    $_SESSION['lastName'] = $row['lastName'];
    $_SESSION['picture'] = $row['picture'];

?>

<body>
	<!---<p>File Upload Form - Simple (any file)</p>
	
	<form action="upload.php" method="post" enctype="multipart/form-data">
	  Select file to upload:
	  <input type="file" name="fileToUpload" id="fileToUpload">
	  <input type="submit" value="Upload File" name="submit">
	</form>
	
	<hr>
    --->


	<p>Profile Picture Update</p>
	
	<form action="uploadComplete.php" method="post" enctype="multipart/form-data">
	  Select an image to upload:
	  <input type="file" name="fileToUpload" id="fileToUpload">
	  <input type="submit" value="Upload Image" name="submit">
	</form>	
	
	<hr>
	
	<!--<p>For reference, content for this example is based on this reference at <a href="https://www.w3schools.com/php/php_file_upload.asp">W3Schools</a></p>
    -->
    
</body>
</html>

<?php
}
else {
    header("Location: index.php");
    exit();
}
?>