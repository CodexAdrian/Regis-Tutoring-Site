<?php
const BASE_LOGIN_URI = "https://moodle.regis.org/login/token.php";
const BASE_API_URI = "https://moodle.regis.org/webservice/rest/server.php";
const SERVICE = "moodle_mobile_app";
function getUserToken(String $username, String $password) {
    $request = file_get_contents(BASE_LOGIN_URI . "?service=".SERVICE."&username=$username&password=$password");
    //echo $info;
    $results = json_decode($request);
    if(property_exists($results, "error")) {
        //echo $results->{"error"};
        return null;
    }
    $token = $results->{'token'};
    if($token != null) {
        return $token;
    }
    return null;
}

function getUserID(String $token) {
    $request = file_get_contents(BASE_API_URI . "?wstoken=$token&wsfunction=core_webservice_get_site_info&moodlewsrestformat=json");
    $results = json_decode($request);
    //echo $request;
    $id = $results->{'userid'};
    if($id != null) {
        return $id;
    }
    return null;
}