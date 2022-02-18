<?php
include "session.php";
#Checks if the session is still maintained
if ($_SESSION['userID']) {
    include "auth.php";
    include "nav.php";
    include "functions.php";
    // commented out because it is causing page not to load
    $userID = $_GET['userID'];
    $sql = "SELECT * FROM users WHERE userID = $userID";
    $rs = mysqli_query($dbc, $sql);
    $row = mysqli_fetch_array($rs);
    $_SESSION['userID'] = $row['userID'];
    $_SESSION['userTypeID'] = $row['userTypeID'];
    $_SESSION['firstName'] = $row['firstName'];
    $_SESSION['lastName'] = $row['lastName'];
    $_SESSION['picture'] = $row['picture'];
    ?>

    <div class="grid grid-cols-5 w-full">
    <?php
    $sql = "
        select subjectID, subjectName, userID from users
        inner join subjects s on users.deptID = s.subjectID";
    $rs = mysqli_query($dbc, $sql);

    while ($row = mysqli_fetch_array($rs)) {
        $subjectID = $row['subjectID'];
        $subjectName = $row['subjectName'];
        ?>

        <div class="m-5 rounded-lg p-4 text-white h-min" style="background-color: #575271">
            <div class="flex flex-row">
                <span class="material-icons text-white text-3xl p-5 mt-auto mb-auto mr-5 bg-red-600 rounded-md">menu</span>
                <div class="mb-auto mt-auto">
                    <p class="text-2xl"><?= $subjectName ?></p>
                    <p class="text-1xl text-gray-300">1 available Tutor</p>
                </div>
            </div>
        </div>
            <?php }
            ?>
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