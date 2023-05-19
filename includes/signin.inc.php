<?php
//  echo '<pre>'; var_dump($_POST); echo '</pre>';   
if (isset($_POST["submit"])) {
    // get POST data
    $uid = $_POST["uid"];
    echo $uid;

    $passwrord = $_POST["password"];
    echo $passwrord;
    $passwrord_repeat = $_POST["password_repeat"];

    $email = $_POST["email"];
    echo $email;
    // initiate class include ORDER MATTER
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup_class =
     new SignupContr($uid, $passwrord, $passwrord_repeat, $email);
    $signup_class->signupUser();
    header("location: ../index.php?error=none");
    die();
}
?>