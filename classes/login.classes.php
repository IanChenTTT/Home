<?php

class Login extends Dbh_class
{
    protected function getUser($uid_email, $password)
    {
        // Check password by user_id or user_email
        $state = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_uid = ? OR users_email = ?;');
        if (!$state->execute(array($uid_email, $uid_email))) {
            $state = null;
            header("location: ../index.php?error=stateFailed");
            exit();
        }
        $loginData = $state->fetchAll(PDO::FETCH_ASSOC);
        if (count($loginData) === 0) {
            $state = null;
            header("location: ../index.php?error=UserNotFound");
            exit();
        }
        $checkPassword = password_verify($password, $loginData[0]["users_pwd"]);
        if ($checkPassword === false) {
            $state = null;
            header("location: ../index.php?error=Password_Wrong");
            exit();
        }
        if ($checkPassword === true) {
            $state = $this->connect()->
                // Login with email and user_id
                prepare('SELECT * FROM users WHERE users_uid = ? OR users_email = ? AND 
            users_pwd = ?;');
            if (!$state->execute(array($uid_email, $uid_email, $loginData[0]["users_pwd"]))) {
                $state = null;
                header("location: ../index.php?error=stateFailed");
                exit();
            }
            $user = $state->fetchAll(PDO::FETCH_ASSOC);
            if (count($user) === 0) {
                $state = null;
                header("location: ../index.php?error=UserNotFound");
                exit();
            }
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
            include("../classes/sessions.classes.php");
            $session = new Session();
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["logstate"] = true;
            $_SESSION["useruid"] = $user[0]["users_uid"];
            $state = null;
        }
    }
}
