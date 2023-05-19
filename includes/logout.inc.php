<?php
include "../classes/dbh.classes.php";
include ("../classes/sessions.classes.php");
$session = new Session();
$_SESSION["logstate"] = false;
var_dump($_SESSION["logstate"] );
header("location: ../index.php");