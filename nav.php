<?php
?>
<html>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tutoring Homepage</title>
</head>
<body class="m-0 text-white" style="background-color: #20182D">
<div class="flex flex-col h-full">
    <div class="flex justify-between border-gray-700 border-b-2"><!-- Top Nav -->
        <div class="flex flex-row">
            <div><span class="material-icons text-white text-3xl p-4 border-gray-700 border-r-2">menu</span></div>
            <div class="rounded-3xl p-2 mt-auto mb-auto ml-10 flex"
                 style="background-color: #575271"><a href = "search.php"><span class="material-icons text-white ml-2">search</span></a>
                <p class="text-white ml-3 mr-60">Search</p></div>
            <div class="rounded-3xl p-2 mt-auto mb-auto ml-10 flex"
                 style="background-color: #D61341"><p class="text-white ml-3"><a href="tutor-application.php">Tutor Sign Up</a></p><span
                        class="material-icons text-white ml-2 mr-3">school</span></div>
        </div>
        <div class="flex flex-row">
            <span class="material-icons text-white text-3xl p-4">notifications</span>
            <img src="Logo.png" class="h-12 m-auto mr-3 rounded-3xl" alt="logo"/>
        </div>
    </div>
    <div class="flex flex-row h-full">
        <div class="flex justify-between p-4 pt-5 border-gray-700 border-r-2 h-full">
            <div class="flex flex-col h-full">
                <span class="material-icons text-white text-3xl pb-10">home</span>
                <a href = "tutor-application.php"><span class="material-icons text-white text-3xl pb-10">school</span></a>
                <a href = "search.php"><span class="material-icons text-white text-3xl pb-10">account_circle</span></a>
                <a href = "tutee-signup.php"><span class="material-icons text-white text-3xl pb-10">event</span></a>
            </div>
        </div>



