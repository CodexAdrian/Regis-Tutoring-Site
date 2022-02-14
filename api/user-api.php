<?php

const BASE_URI = "https://moodle.regis.org/webservice/rest/server.php";

function getUserProfile(int $userid, String $token) {
    //TODO make $exists equal to whether or not the user exists in the table
    $exists = false;

    if($exists) {
        //TODO grab data from database
    } else {
        $userProfile1 = file_get_contents(BASE_URI. "?wstoken=$token&moodlewsrestformat=json&wsfunction=core_webservice_get_site_info");
        $userProfile2 = file_get_contents(BASE_URI. "?wstoken=$token&moodlewsrestformat=json&wsfunction=core_user_get_users_by_field&field=id&values[]=$userid");
        $profilePicture = ;
        $firstName;
        $lastName;
        $userName;
        $isDeptHead;
        $picture;
        $userType;
    }
}
