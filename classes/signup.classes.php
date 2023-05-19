<?php

class Signup extends Dbh_class{
    protected function setUser($uid,$password,$email){
        $state = $this->connect()->
        prepare('INSERT INTO users (users_uid, users_pwd, users_email) VALUES
        (?,?,?)');
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        if(!$state->execute(array($uid, $hashedPwd, $email))){
            $state = null;
            header("location: ../index.php?error=statefailed");
            exit();
        }
    }
    protected function UserisTaken($uid,$email){
        $state = $this->connect()->
        prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;');
        if(!$state->execute(array($uid, $email))){
            $state = null;
            header("location: ../index.php?error=statefailed");
            exit();
        }
        if($state ->rowCount() > 0)return true;
        return false;

    }

}