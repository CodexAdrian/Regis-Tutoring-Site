<?php
include "session.php";
#Checks if the session is still maintained
if ($_SESSION['userID']) {
    include "auth.php";
    include "nav.php";
    include "functions.php";
    include "api/user-api.php";
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

<div class="m-5">

	<p class="text-2xl">Profile Picture Update</p>

	<form class="flex flex-col" action="uploadComplete.php" method="post" enctype="multipart/form-data">
	        <label class="bg-slate-700 p-5 m-3 rounded-lg focus:bg-slate-500">
                <input class="hidden" type="file" name="fileToUpload" id="fileToUpload">
                <div class="text-center">
                    <span class="material-icons m-auto text-4xl">upload</span>
                    <p class="text-lg">Click to upload an image</p>
                </div>
            </label>
            <input class="rounded-full bg-slate-700 w-min p-1 pl-3 pr-3 ml-3" type="submit" value="Upload Image" name="submit">
	</form>

</div>

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