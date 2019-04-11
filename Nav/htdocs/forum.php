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
    <script src="forum.js"></script>
</head>
<body>
    <div class="topbar" id="topbar">
        <h1>Showing all posts.</h1>
    </div>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="toggleNav()">×</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>
    <div class="main" id="main">
        <button class="openbtn" onclick="toggleNav()">☰ Toggle Sidebar</button>
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
        <?php
        for ($i = 0; $i < 10; $i++)
        {
            echo ("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");

        }
    ?>
    <p>
        <a href="newpost.php" class="btn btn-info">Post New Text</a>
        <a href="createsub.php" class="btn btn-primary">Create New Sub</a>
        <a href="subs.php" class="btn btn-link">Show Subs</a>
    </p>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out</a>
    </p>
    </div>
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