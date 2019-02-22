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
$title = "";
$text = "";
$username = $_SESSION["username"];
$title_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate title
    if(empty(trim($_POST["title"]))){
        $title_err = "Please enter a title.";

    } elseif(strlen(trim($_POST["title"])) < 5){
        $title_err = "Title must have atleast 5 characters.";

    } else{
        $title = trim($_POST["title"]);

    }

    if (!empty(trim($_POST["text"]))){
        $text = trim($_POST["text"]);

    }
    
    // Check input errors before inserting in database
    if(empty($title_err) && !empty($username)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO posts (post_title, post_text, username) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_title, $param_text, $param_username);
            
            // Set parameters
            $param_title = $title;
            $param_text = $text;
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
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

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
    </div>
    <p>
        <form style="margin: 50px" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                <label>Title</label>
                <input type="text" name="title" class="form-control"><br>
                <span class="help-block"><?php echo $title_err; ?></span>

            </div>    

            <div class="form-group <?php echo (!empty($text_err)) ? 'has-error' : ''; ?>">
                <label>Text</label>
            <textarea rows = "15" name = "text" class="form-control"></textarea><br>

            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Post">

            </div>
        </form>
    </p>
</body>
</html>