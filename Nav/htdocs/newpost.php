<?php
// Initialize the session
session_start();
 
require_once "utils.php";
check_login();

// Include config file
require_once "config.php";
require_once "server.php";

// Define variables and initialize with empty values
$title = "";
$text = "";
$username = $_SESSION["username"];
$title_err = "";
$sub_err = "";
$currentsub = "";

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

    if (!empty(trim($_POST["sub"]))){
        if (trim($_POST["sub"]) != "none"){
            $currentsub = trim($_POST["sub"]);

        }   
    } else {
        $sub_err = "Please enter a sub name.";

    }

    // Validate credentials
    if(empty($sub_err)){
        if (!validate_select($link, "sub_id", "subs", "sub_name", $currentsub)){
            // Display an error message if sub doesn't exist
            $sub_err = "Niggatoiled.";

        }else{
            echo "Working";

        }
    }
    
    // Check input errors before inserting in database
    if(empty($title_err) && !empty($username) && !empty($currentsub) && empty($sub_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO posts (post_title, post_text, post_username, post_sub) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_title, $param_text, $param_username, $param_sub);
            
            // Set parameters
            $param_title = $title;
            $param_text = $text;
            $param_username = $username;
            $param_sub = $currentsub;
            
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

if(isset($_GET['sub'])){
    $currentsub = trim($_GET['sub']); //some_value

} else {
    $currentsub = "none";

}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="forum.css">
    <style type="text/css">
        body{ 
            font: 14px sans-serif; text-align: center; 

        }
        
        input[type=text] {
            text-align: center;

        }

        textarea {
            text-align: center;

        }

        </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, currently posting for <b><?php echo htmlspecialchars($currentsub); ?></b>.</h1>
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
                <label>Sub: </label>
                <select name="sub">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="opel">Opel</option>
                    <option value="audi">Audi</option>
                </select>

                <span class="help-block"><?php echo $sub_err; ?></span>

            </div>   

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Post">

            </div>
        </form>
    </p>
</body>
</html>