<?php
function articles_load($link, $count = 0, $offset = 0, $category = -1)
{
$sql = 'SELECT * FROM `posts`';
$order = ' ORDER BY date';
$cat = ' WHERE `category` = ' . $category;
$lim = ' DESC LIMIT ' . $count . ' OFFSET ' . $offset;

if ($category != -1) {
$sql = $sql . $cat;
}

$sql = $sql . $order;

if ($count == 0) {
$stmt = mysqli_prepare($link, $sql);

if ($stmt) {
if (mysqli_stmt_execute($stmt)) {
return mysqli_stmt_get_result($stmt);
} else {
echo "Something went wrong. Please try again later.";
}
}
} else {
$sql = $sql . $lim;
$stmt = mysqli_prepare($link, $sql);

if ($stmt) {
if (mysqli_stmt_execute($stmt)) {
return mysqli_stmt_get_result($stmt);
} else {
echo "Something went wrong. Please try again later.";
}
}
}
}

function new_category($link, $name)
{
$categories = get_categories($link);
if (is_array($categories) || is_object($categories)) {
foreach ($categories as $cat) {
if ($cat['name'] == $name) {
return $cat['id'];
}
}
}

$sql = "INSERT INTO `categories` (name) VALUES ('" . $name . "')";

$stmt = mysqli_prepare($link, $sql);
print_r($stmt);

if ($stmt) {
if (mysqli_stmt_execute($stmt)) {
return get_category($link, $name);
} else {
echo "Could not create new category. Please try again later.";
return 0;
}
} else {
echo "Something went wrong. Try again later.";
}
}

function get_category($link, $name)
{
$sql = "SELECT * FROM `categories` WHERE name='" . $name . "'";
$stmt = mysqli_prepare($link, $sql);

echo $sql;

if ($stmt) {
if (mysqli_stmt_execute($stmt)) {
$wat = mysqli_fetch_array(mysqli_stmt_get_result($stmt))[0];
echo $wat;
return $wat;
} else {
echo "Something went wrong. Please try again later.";
}
}
}

function get_categories($link)
{
$sql = 'SELECT * FROM `categories`';
$stmt = mysqli_prepare($link, $sql);

if ($stmt) {
if (mysqli_stmt_execute($stmt)) {
return mysqli_stmt_get_result($stmt);
} else {
echo "Something went wrong. Please try again later.";
}
}
}

function get_article($link, $id)
{
$sql = 'SELECT * FROM `posts` WHERE id=' . $id . '';
$stmt = mysqli_prepare($link, $sql);

if ($stmt) {
if (mysqli_stmt_execute($stmt)) {
return mysqli_stmt_get_result($stmt);
} else {
echo "Something went wrong. Please try again later.";
}
}
}

function delete_article($link, $id)
{
$sql = 'DELETE FROM `posts` WHERE id=' . $id . '';
$stmt = mysqli_prepare($link, $sql);

if ($stmt) {
if (mysqli_stmt_execute($stmt)) {
header('location: ../index.php');
}
}
}

function get_total_articles($link, $category = -1)
{
$sql = 'SELECT COUNT(id) FROM `posts`';

if ($category != -1) {
$sql = $sql . ' WHERE `category` = ' . $category;
}

$stmt = mysqli_prepare($link, $sql);

if ($stmt) {
if (mysqli_stmt_execute($stmt)) {
return mysqli_fetch_array(mysqli_stmt_get_result($stmt));
} else {
echo "Something went wrong. Please try again later.";
}
}
}

function update_article($link, $id, $title, $thumbnail, $category, $content, $git_commit, $updateTime, $worktime)
{
$sql = 'UPDATE `posts` SET title=?, thumbnail=?, category=?, content=?, git_commit=?';
$time =  ',date=current_timestamp()';
$finisher =  ', worktime=? WHERE id=' . $id;

if ($updateTime) {
$sql = $sql . $time;
}

$sql = $sql . $finisher;

if ($stmt = mysqli_prepare($link, $sql)) {
mysqli_stmt_bind_param($stmt, "ssssss", $param_title, $param_thumbnail, $param_category, $param_content, $param_git_commit, $param_worktime);

$param_title = $title;
$param_thumbnail = $thumbnail;
$param_category = $category;
$param_content = $content;
$param_git_commit = $git_commit;
$param_worktime = $worktime;

if (mysqli_stmt_execute($stmt)) {
header('location: ../index.php');
}
}
}
