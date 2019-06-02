<?php
function insert_into($link, $into, $columns, ...$values)
{
    // echo func_num_args();

    // // Prepare an insert statement
    // $sql = "INSERT INTO posts (post_title, post_text, post_username, post_sub) VALUES (?, ?, ?, ?)";
         
    // if($stmt = mysqli_prepare($link, $sql)){
    //     // Bind variables to the prepared statement as parameters
    //     mysqli_stmt_bind_param($stmt, "ssss", $param_title, $param_text, $param_username, $param_sub);
                
    //     // Set parameters
    //     $param_title = $title;
    //     $param_text = $text;
    //     $param_username = $username;
    //     $param_sub = $currentsub;
                
    //     // Attempt to execute the prepared statement
    //     if(mysqli_stmt_execute($stmt)){
    //         // Redirect to login page
    //         header("location: forum.php");
    
    //     } else {
    //         echo "Something went wrong. Please try again later.";
    
    //     }
    // }
    // // Close statement
    // mysqli_stmt_close($stmt);

}

function get_user_subs($user_id)
{


}

function mod_delete($link, $sub_id){
    $sql = "DELETE FROM `subs` WHERE sub_id='".$sub_id."'";
    mysqli_query($link, $sql);

}

function is_user_following($link, $user_id, $sub_name)
{
    $sub_id = 0;
    $sql = "SELECT * FROM `subs` WHERE sub_name='".$sub_name."'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if ($row['sub_name'] == $sub_name)
                $sub_id = $row['sub_id'];

        }
    } else
        return;

    $result = validate_select($link, "*", "following");
    $found = FALSE;
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if ($row['user_id'] == $user_id && $row['sub_id'] == $sub_id)
                $found = TRUE;
                     
        }
    } 
    
    if ($found) 
        echo "<div id=\"subscribed\" title=\"yes\"></div>";
     else 
        echo "<div id=\"subscribed\" title=\"no\"></div>";
    
}

function get_valid_args(...$args){
    $valid_args = 0;
    foreach ($args as $value) {
        if ($value != "" || $value != null)
            $valid_args += 1;

    }

    return $valid_args;

}


function load_posts($result, $root){
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $time = explode(" ", $row["created_at"]);
            if ($root)
                echo "<a href=\"comment.php?post=".$row["post_id"]."\">" . $time[0]. "(" . $time[1] . ") ". $row["post_username"] . ": ". $row["post_title"]. "<br></a>";
            else
                echo "<a href=\"../../comment.php?post=".$row["post_id"]."\">" . $time[0]. "(" . $time[1] . ") ". $row["post_username"] . ": ". $row["post_title"]. "<br></a>";

        }
      } else {
        echo "0 results";

      }
}

function validate_select($link, $select, $from, $where="", $is="")
{
    $args = get_valid_args($select, $from, $where, $is);

    // Prepare a select statement
    $sql = "SELECT ".$select." FROM `".$from."` WHERE ".$where." = \'".$is."\'";

    if ($args == 2)
        $sql = "SELECT ".$select." FROM `".$from."`";

    $stmt = mysqli_query($link, $sql);
    return $stmt;

}
?>