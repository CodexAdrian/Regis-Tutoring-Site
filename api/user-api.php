<?php

const BASE_URI = "https://moodle.regis.org/webservice/rest/server.php";

function getUserProfile(int $userid, String $token) {
    //TODO make $exists equal to whether or not the user exists in the table
    $exists = false;

    if($exists) {
        //TODO grab data from database
    } else {
        $userProfile1 = file_get_contents(BASE_URI. "?wstoken=$token&moodlewsrestformat=json&field=id&id=$userid");
        $userProfile2 = file_get_contents(BASE_URI. "?wstoken=$token&moodlewsrestformat=json&values[]=86");
        $profilePicture;
        $firstName;
        $lastName;
        $userName;
        $isDeptHead;
        $picture;
        $userType;
    }
}
