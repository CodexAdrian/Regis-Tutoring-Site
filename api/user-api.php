<?php
$dbc = mysqli_connect("cs.regis.org", "aortiz22", "38271038", "tutor");
const BASE_URI = "https://moodle.regis.org/webservice/rest/server.php";

abstract class UserType {
    const Inactive = 0;
    const Student = 1;
    const Tutor = 2;
    const Teacher = 3;
}

abstract class SubjectType {
    const Math = 1;
    const English = 2;
    const Science = 3;
    const Language = 4;
    const History = 5;
    const Theology = 6;
    const Guidance = 7;
    const ComputerScience = 8;
    const Art = 9;
    const PhysicalEducation = 10;
}

class UserProfile {
    public String $firstName;
    public String $lastName;
    public String $userName;
    public int $id;

    public function __construct($firstName, $lastName, $userName, $id) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->id = $id;
    }
}

function getUserProfile(int $userid, String $token): UserProfile | null {
    $dbc = mysqli_connect("cs.regis.org", "aortiz22", "38271038", "tutor");
    $sql = "
                select * 
                from users 
                where extraID = $userid
            ";

    $rs = mysqli_query($dbc, $sql);
    //echo $rs;
    if (!$rs) {
        //I was told this was not necessary after i finished this -_-
        $userProfile1 = file_get_contents(BASE_URI. "?wstoken=$token&moodlewsrestformat=json&wsfunction=core_webservice_get_site_info");
        $userProfile2 = file_get_contents(BASE_URI. "?wstoken=$token&moodlewsrestformat=json&wsfunction=core_user_get_users_by_field&field=id&values[]=$userid");
        //$profilePicture = file_get_contents($userProfile1->{'userpictureurl'} . );
        $firstName = $userProfile1 -> {'firstname'};
        $lastName = $userProfile1 -> {'lastname'};
        $userName = $userProfile2 -> {'username'};

        $sql = "
        insert into users (userID, firstName, lastName, userName, extraID)
        values ($userid, $firstName, $lastName, $userName, $userid)
        ";

        return mysqli_query($dbc, $sql) ? getUserProfile($userid, $token) : null;
    } else {
        $dbProfile = mysqli_fetch_object($rs);
        return new UserProfile($dbProfile->{'firstName'}, $dbProfile->{'lastName'}, $dbProfile->{'userName'}, $dbProfile->{'userID'});
    }
}
