<?php
    include "auth.php";
    include "nav.php";
    include "session.php";

    include "api/user-api.php";

    switch ($_SESSION['userTypeID']) {
        case UserType::Tutor: {
            break;
        }

        case UserType::Teacher: {
            break;
        }

        default: {

        }
    }

    //Something about current time slots
    //Something about tutor applications
?>
