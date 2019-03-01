<?php

require_once "config.php";
require_once "server.php";

$result = validate_select($link, "*", "posts");

if ($result)
    echo "Result True";
else
    echo "Result False";

mysqli_close($link);

?>