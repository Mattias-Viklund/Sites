<?php
    session_start();
 
    require_once "utils.php";
    check_login();

    require_once "config.php";
    require_once "server.php";

    $yes = $_GET['sub'];
    $sub = $_GET['ret'];

    $sub_id = 0;
    $sql = "SELECT * FROM `subs`";
    $result = mysqli_query($link, $sql);

    echo "eyo <br>";
    echo "sub: ".$yes."<br>";
    echo "ret: ".$sub."<br>";
    echo "user_id: ".$_SESSION['id']."<br>";

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if ($row['sub_name'] == $sub)
            {
                $sub_id = $row['sub_id'];
                break;

            }            
        }
    }

    $sql = "SELECT * FROM `following`";
    $result = mysqli_query($link, $sql);
    $exists = false;

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if ($row['sub_id'] == $sub_id && $row['user_id'] == $_SESSION['id'])
            {
                $exists = true;
                break;

            }            
        }
    }

    echo "sub_id: ".$sub_id."<br>";

    if ($exists)
    {
        $sql = "DELETE FROM `following` WHERE user_id=".$_SESSION['id']." AND sub_id=".$sub_id;
        $result = mysqli_query($link, $sql);

        print_r($result);

        echo "Deleted the thing from the thing. Line 55 subscribe.php // fulla mattias";

    } else {
        $sql = "INSERT INTO `following` (`user_id`, `sub_id`) VALUES (".$_SESSION['id'].", ".$sub_id.")";
        $result = mysqli_query($link, $sql);

        echo $sql."<br>";

        print_r($result);

        echo "Inserted the thing into the thing. Line 60 subscribe.php // fulla mattias";

    }

    header("location: "."sub/".$redirect);

?>