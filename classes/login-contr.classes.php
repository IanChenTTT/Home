<?php
class LoginContr extends Login{
    private $uid;
    private $password;
    public function __construct($uid, $password)
    {
        $this->uid = $uid;
        $this->password = $password;
    }
    public function loginUser()
    {
        if ($this->emptyInput()) {
            header("location: ../index.php?error=emptyInput");
            exit();
        }
        else {
            $this->getUser($this->uid, $this->password);
        }
    }
    public function emptyInput()
    {
        if (
            empty($this->uid) || empty($this->password)
        ) return  true;
        return false;
    }
   
}