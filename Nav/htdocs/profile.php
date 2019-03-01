<?php
// Initialize the session
session_start();
 
require_once "utils.php";
check_login();

// Include config file
require_once "config.php";
 
// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    

}

$sql = "SELECT * FROM posts;";
$result = mysqli_query($link, $sql);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum All</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="forum.css">
    <style type="text/css">
        body{ 
            font: 14px sans-serif; text-align: center; 
            
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Showing all posts.</h1>
    </div>

    <div class="page-header">
    <?php 
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $time = explode(" ", $row["created_at"]);
                echo "<a onclick=\"getComment(".$row["post_id"].")\">" . $time[0]. "(" . $time[1] . ") ". $row["post_username"] . ": ". $row["post_title"]. "<br></a>";
    
            }
        } else {
            echo "0 results";
    
        }
    
        mysqli_close($link);
        ?>
    </div>
    <p>
        <a href="post.php" class="btn btn-info">Post New Text</a>
        <a href="createsub.php" class="btn btn-primary">Create New Sub</a>
        <a href="subs.php" class="btn btn-link">Show Subs</a>
    </p>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out</a>
    </p>
</body>
<footer>
    <div id="hidden_form_container" style="display:none;"></div>

    <script>
        function getComment (value) {
        var theForm, newInput;
        // Start by creating a <form>
        theForm = document.createElement('form');
        theForm.action = '../../comment.php';
        theForm.method = 'get';
        // Next create the <input>s in the form and give them names and values
        newInput = document.createElement('input');
        newInput.type = 'hidden';
        newInput.name = 'post';
        newInput.value = value;
        // Now put everything together...
        theForm.appendChild(newInput);
        // ...and it to the DOM...
        document.getElementById('hidden_form_container').appendChild(theForm);
        // ...and submit it
        theForm.submit();
        }
    </script>
</footer>
</html>