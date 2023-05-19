<?php

class SignupContr extends Signup 
{
    private $uid;
    private $password;
    private $password_repeat;
    private $email;
    public function __construct($uid, $password, $password_repeat, $email)
    {
        $this->uid = $uid;
        $this->password = $password;
        $this->password_repeat = $password_repeat;
        $this->email = $email;
    }
    public function signupUser()
    {
        if ($this->emptyInput()) {
            header("location: ../index.php?error=emptyInput");
            exit();
        }
        else if (!$this->invalidUID()) {
            header("location: ../index.php?error=ID_incorrect");
            exit();
        }
        else if (!$this->invalidEmail()) {
            header("location: ../index.php?error=email_incorrect");
            exit();

        }
       else if (!$this->password_Match()) {
            header("location: ../index.php?error=password_incorrect");
            exit();

        }
        else if (!$this->uidTakenCheck()) {
            header("location: ../index.php?error=ID_TAKEN");
            exit();
        }
        else {
            $this->setUser($this->uid, $this->password, $this->email);
        }
    }
    public function invalidUID()
    {
        if (!preg_match("/^[a-zA-Z0-9]/", $this->uid)) return false;
        return true;
    }
    public function emptyInput()
    {
        if (
            empty($this->uid) || empty($this->password) ||
            empty($this->password_repeat) || empty($this->email)
        ) return  true;
        return false;
    }
    public function invalidEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }
    public function password_Match()
    {
        if ($this->password !== $this->password_repeat) return false;
        return true;
    }
    public function uidTakenCheck()
    {
        // if this user is not taken return true
        if (!($this->UserisTaken($this->uid, $this->email))) return true;
        return false;
    }
}
