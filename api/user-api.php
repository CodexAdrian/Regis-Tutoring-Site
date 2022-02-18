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

function getSubjectDecoration($subjectTypeId) {
    $color = '#FFFFFF';
    $icon = 'warning';
    switch ($subjectTypeId) {
        case SubjectType::Math :
            $color = '#FF8F28';
            $icon = 'calculate';
            break;
        case SubjectType::English :
            $color = '#F8FF3B';
            $icon = 'edit_note';
            break;
        case SubjectType::Science :
            $color = '#009AA3';
            $icon = 'tungsten';
            break;
        case SubjectType::Language :
            $color = '#808080';
            $icon = 'translate';
            break;
        case SubjectType::History :
            $color = '#08A827';
            $icon = 'history_edu';
            break;
        case SubjectType::Theology :
            $color = '#ED4253';
            $icon = 'local_hospital';
            break;
        case SubjectType::Guidance :
            $color = '#FFF700';
            $icon = 'child_care';
            break;
        case SubjectType::ComputerScience :
            $color = '#1800B5';
            $icon = 'settings_suggest';
            break;
        case SubjectType::Art :
            $color = '#FF00BF';
            $icon = 'brush';
            break;
        case SubjectType::PhysicalEducation :
            $color = '#000000';
            $icon = 'sports_football';
            break;
    }

    return array("color" => $color, "icon" => $icon);
}

class UserProfile {
    public string $firstName;
    public string $lastName;
    public string $userName;
    public int $id;

    public function __construct($firstName, $lastName, $userName, $id)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->id = $id;
    }
}

function getUserProfile(int $userid, string $token): UserProfile|null {
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
        $userProfile1 = file_get_contents(BASE_URI . "?wstoken=$token&moodlewsrestformat=json&wsfunction=core_webservice_get_site_info");
        $userProfile2 = file_get_contents(BASE_URI . "?wstoken=$token&moodlewsrestformat=json&wsfunction=core_user_get_users_by_field&field=id&values[]=$userid");
        //$profilePicture = file_get_contents($userProfile1->{'userpictureurl'} . );
        $firstName = $userProfile1->{'firstname'};
        $lastName = $userProfile1->{'lastname'};
        $userName = $userProfile2->{'username'};

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
