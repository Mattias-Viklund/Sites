<?php
include_once('config.php');

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
header("location: login.php");
exit;
}

function is_acctype($acctype)
{
return ($_SESSION["acctype"] == $acctype) ? true : false;

}

function is_admin()
{
return is_acctype(0);

}

function is_teacher()
{
return is_acctype(2);

}
?>
