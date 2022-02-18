<?php
include "session.php";
#Checks if the session is still maintained
if ($_SESSION['userID']) {
    include "nav.php";
    include "auth.php";
    include "functions.php";
    include "api/user-api.php";
    // commented out because it is causing page not to load
    $sql = "SELECT * FROM users WHERE userID = " . $_GET['userID'];
    $rs = mysqli_query($dbc, $sql);
    $row = mysqli_fetch_array($rs);
    $_SESSION['userID'] = $row['userID'];
    $userID = $_SESSION['userID'];
    $_SESSION['userTypeID'] = $row['userTypeID'];
    $_SESSION['firstName'] = $row['firstName'];
    $_SESSION['lastName'] = $row['lastName'];
    $_SESSION['picture'] = $row['picture'];
    $_SESSION['fullname'] = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
    ?>
    <div class="m-5 w-full">
        <p class="text-2xl m-5 max-w-full border-b-2 pb-2 border-gray-500">Welcome Back, <?= $_SESSION['firstName'] ?>
            👋</p>
        <p class="text-xl m-5 mb-0">See Tutors Availability (WIP)</p>
        <div class="grid grid-cols-5 w-full h-min">
            <?php
            $sql = "
        SELECT subjectID, subjectName, userID FROM users
        INNER JOIN subjects s ON users.deptID = s.subjectID
        WHERE subjectID < 7";
            $rs = mysqli_query($dbc, $sql);

            while ($row = mysqli_fetch_array($rs)) {
                $subjectID = $row['subjectID'];
                $subjectName = $row['subjectName'];
                $deco = getSubjectDecoration($subjectID);
                ?>

                <div class="m-5 rounded-lg p-4 text-white h-min" style="background-color: #343046">
                    <div class="flex flex-row">
                        <span class="material-icons text-white text-3xl p-5 mt-auto mb-auto mr-5 rounded-md"
                              style="background-color: <?= $deco['color'] ?>"><?= $deco['icon'] ?></span>
                        <div class="mb-auto mt-auto">
                            <p class="text-2xl"><?= $subjectName ?></p>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <div class="m-5">
            <p class="text-xl">Upcoming Events</p>
            <p class="text-md text-slate-400 max-w-full border-gray-500 border-b-2 pb-2"">Today
            | <?= date('M d, Y') ?> </p>
            <?php
            $eventQuery = "
                SELECT eventID, tutorID, subjectID, firstName, lastName, picture, userName, startTime, endTime FROM calendarEvents
                INNER JOIN users u on calendarEvents.tutorID = u.userID
                INNER JOIN periods p on calendarEvents.periodID = p.periodID
                INNER JOIN topics t on calendarEvents.topicID = t.topicID
                WHERE studentID = $userID && eventDate = DATE(SYSDATE());
                ";
            $rs = mysqli_query($dbc, $eventQuery);
            while ($row = mysqli_fetch_array($rs)) {
                $tutorID = $row['tutorID'];
                $tutorName = $row['firstName'] . " " . $row['lastName'];
                $eventID = $row['eventID'];
                $subjectID = $row['subjectID'];
                $picture = $row['picture'];
                $email = $row['userName'] . '@regis.org';
                $startTime = $row['startTime'];
                $endTime = $row['endTime'];
                $iconDeco = getSubjectDecoration($subjectID);
                if(!$picture) $picture = 'default-profile.png';
                ?>
                <div class="flex flex-row w-full justify-between m-3">
                    <div class="flex flex-row ">
                        <img class="rounded-full w-16 h-16" src="<?= $picture ?>" alt="Profile Picture"/>
                        <div class="flex flex-col ml-3 mt-auto mb-auto">
                            <p class="flex text-lg"><?= $tutorName ?> <span class="material-icons ml-2 m-auto" style="color: <?= $iconDeco['color']?>"><?= $iconDeco['icon']?></span></p>
                            <p class="text-md text-slate-400"><?= $startTime . " - " . $endTime ?></p>
                        </div>
                    </div>
                    <div class="flex mr-5">
                        <a href="mailto:<?= $email ?>?subject=Tutor help&body=Hi <?= $row['firstName'] ?>" class="rounded-full h-min w-min p-2 mr-2" style="background-color: #343046; color: #AEA8CE"><span class="material-icons">email</span></a>
                        <a onclick="return confirm('Are you sure you would like to cancel your meeting with <?= $tutorName ?>?')" href="registrationDelete.php?eventID=<?=$eventID?>" class="rounded-full h-min w-min p-2" style="background-color: #343046; color: #D61341"><span class="material-icons">remove_circle</span></a>
                    </div>
                </div>
                    <?php
            } //End of While loop
            ?>
        </div>
    </div>
    </body>

    </html>
    <?php
}#Redirects users back to the index page if session times out.
else {
    header("Location: index.php");
    exit();
}
?>