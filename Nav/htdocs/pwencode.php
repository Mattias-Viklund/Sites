<?php 
    // define variables and set to empty values
    $output = $password = $firstname = $lastname = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = test_input($_POST["firstname"]);
        $lastname = test_input($_POST["lastname"]);
        $password = test_input($_POST["password"]);
        try_login($firstname." ".$lastname.", ".$password);

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }

    function try_login($data){
        $output = exec("oof.exe ".escapeshellarg($data));

    }
?>


<html>
<head>
    <title>Login page</title>
</head>

<body>
    <?php echo "<p>$firstname, $lastname<p>" ?> 
    <?php echo "<h1>$password </h1>" ?>
    <?php echo "<p>Output: $output</p>" ?>
</body>
</html>