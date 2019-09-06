<?php
function articles_load($link)
{
$sql = "SELECT * FROM `posts` ORDER BY id DESC";
$stmt = mysqli_prepare($link, $sql);

if ($stmt) {
if (mysqli_stmt_execute($stmt)) {
return mysqli_stmt_get_result($stmt);

} else {
echo "Something went wrong. Please try again later.";

}
}
}
