<?php
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'sql208.epizy.com');
    define('DB_USERNAME', 'epiz_23499980');
    define('DB_PASSWORD', 'DobkwzTv3CGG2');
    define('DB_NAME', 'epiz_23499980_forum');
    define('SERVER_EXECUTING_DIRECTORY', dirname(__FILE__));
 
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
        
    }
?>