<?php
include("./classes/dbh.classes.php");
include("./classes/sessions.classes.php");
$session = new Session();
// https://stackoverflow.com/questions/520237/how-do-i-expire-a-php-session-after-30-minutes
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

if (isset($_SESSION["logstate"])) {
    if (!$_SESSION["logstate"]) {
        session_unset();
        session_destroy();
    }
}
