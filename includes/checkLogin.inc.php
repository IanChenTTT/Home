<?php
include("./classes/dbh.classes.php");
// include("./classes/sessions.classes.php");
		$this->db = new Dbh_class;
		$this->db->connect();
// $session = new Session();
// echo "Hi";
// https://stackoverflow.com/questions/520237/how-do-i-expire-a-php-session-after-30-minutes
// if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
//     // last request was more than 30 minutes ago
//     session_unset();     // unset $_SESSION variable for the run-time 
//     session_destroy();   // destroy session data in storage
// }
// // echo "heeeeeeeeeeeeeeeeeeeeeeeee";
// if (isset($_SESSION["logstate"])) {
//     $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
//     if (!$_SESSION["logstate"]) {
//         session_unset();
//         session_destroy();
//         // https://www.javatpoint.com/how-to-get-current-page-url-in-php#:~:text=To%20get%20the%20current%20page,always%20available%20in%20all%20scope.
//         // GET CURRENT PAGE FILE NAME
//         $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
//         if ($curPageName !== "index.php")
//             header("location:javascript://history.go(-1)");
//             // header("location: ../index.php");
//     }
// } 
// else {

//     session_unset();
//     session_destroy();
//     echo "HIHIHI";
//     $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
//     if ($curPageName !== "index.php")
//         header("location:javascript://history.go(-1)");
// }
