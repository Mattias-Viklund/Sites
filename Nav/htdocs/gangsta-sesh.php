<?php
// Initialize the session
session_start();
require_once "session.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Welcome</title>
</head>
<body>
<?php print_r($_SESSION); phpinfo(); ?>
</body>
</html>
