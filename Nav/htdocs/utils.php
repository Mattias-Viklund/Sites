<?php
function check_login()
{
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;

    }
}

function console_log($message)
{
    echo "<script>console.log(".$message.");</script>";

}
?>  