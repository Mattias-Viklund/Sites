<?php
function insert_into($link, $into, $columns, ...$values)
{
    echo func_num_args();

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

function get_valid_args(...$args){
    $valid_args = 0;
    foreach ($args as $value) {
        if ($value != "" || $value != null)
            $valid_args += 1;

    }

    return $valid_args;

}

function validate_select($link, $select, $from, $where="", $is="")
{
    $args = get_valid_args($select, $from, $where, $is);
    echo ("<script>console.log(\"Valid args: ".$args."\");</script>");

    // Prepare a select statement
    $sql = "SELECT ".$select." FROM `".$from."` WHERE ".$where." = '".$is."'";

    if ($args == 2)
        $sql = "SELECT ".$select." FROM `".$from."`";
        
    $stmt = mysqli_prepare($link, $sql);
    if($stmt){
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            $result = mysqli_stmt_store_result($stmt);
                        
            // Check if it exists, if yes then return true
            if(mysqli_stmt_num_rows($stmt) > 0){
                // Close statement
                mysqli_stmt_close($stmt);                    
                return $result;

            } else{
                // Close statement
                mysqli_stmt_close($stmt);
                return false;
        
            }
        } else {
            return false;
        
        }
    } else {
        echo "<br> Something went wrong, try again later. (in: 'server.php')";

    }
}
?>