<?php
// Include config file
require_once "config.php";
 
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;

}

// Define variables and initialize with empty values
$subname = "";
$subname_err = "";
$username = $_SESSION["username"];
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate Sub name
    if(empty(trim($_POST["subname"]))){
        $subname_err = "Please enter a Sub name.";
        
    } else{
        // Prepare a select statement
        $sql = "SELECT sub_id FROM subs WHERE sub_name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_subname);
            
            // Set parameters
            $param_subname = trim($_POST["subname"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $subname_err = "This Sub name is already taken.";

                } else{
                    $subname = trim($_POST["subname"]);

                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);

    }
    
    // Check input errors before inserting in database
    if(empty($subname_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO subs (sub_name, sub_owner) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_subname, $param_username);
            
            // Set parameters
            $param_subname = $subname;
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                create_sub($subname);

                // Redirect to login page
                header("location: forum.php");

            } else{
                echo "Something went wrong. Please try again later.";

            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

    }
    
    // Close connection
    mysqli_close($link);

}

function create_sub($sub_name){
    mkdir("sub/".$sub_name, 0777, true);

    $copy = SERVER_EXECUTING_DIRECTORY."\\default\\sub\\index.php";
    $copyto = SERVER_EXECUTING_DIRECTORY."\\sub\\".$sub_name."\\index.php";

    copy($copy, $copyto);

    $copy = SERVER_EXECUTING_DIRECTORY."\\default\\sub\\index.css";
    $copyto = SERVER_EXECUTING_DIRECTORY."\\sub\\".$sub_name."\\index.css";

    copy($copy, $copyto);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Sub</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="forum.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Create Sub</h2>
        <p>Please fill this form to create a new Sub.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($subname_err)) ? 'has-error' : ''; ?>">
                <label>Sub</label>

                <input type="text" name="subname" class="form-control" value="<?php echo $subname; ?>">
                <span class="help-block"><?php echo $subname_err; ?></span>

            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">

            </div>
        </form>
    </div>
</body>
</html>