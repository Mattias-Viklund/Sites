<?php

include_once "../blog/config.php";

mysqli_query($link, "SET character_set_results = 'utf8', character_set_client = 'utf8',
character_set_connection = 'utf8', character_set_database = 'utf8',
character_set_server = 'utf8'");

$posted = !empty($_POST);

$inf = array(
"ALL_TEACHERS",
"ALL_STUDENTS_ASC_BIRTH",
">ALL_COURSES",
"TEACHERS_PARTTIME",
"COURSE_NO_TEACHER",
"+STUDENTS_COURSE",
"+TEACHERS_COURSE",
"+TEACHERS_STUDENTS_COURSE"

);

$dispname = array(
"ALL_TEACHERS" => "ALL TEACHERS",
"ALL_STUDENTS_ASC_BIRTH" => "STUDENTS",
">ALL_COURSES" => "COURSES",
"TEACHERS_PARTTIME" => "PART TIME TEACHERS",
"COURSE_NO_TEACHER" => "COURSES W/O TEACHER",
"+STUDENTS_COURSE" => "STUDENTS IN COURSE",
"+TEACHERS_COURSE" => "TEACHERS FOR COURSE",
"+TEACHERS_STUDENTS_COURSE" => "TEACHERS AND STUDENTS IN COURSE",
"COURSE_INFO" => "COURSE INFORMATION"

);

$disp = array(
"ALL_TEACHERS" => "firstname,lastname,workload",
"ALL_STUDENTS_ASC_BIRTH" => "firstname,lastname,birthdate",
">ALL_COURSES" => "name,subject,points",
"TEACHERS_PARTTIME" => "firstname,lastname,workload",
"COURSE_NO_TEACHER" => "name,subject,points",
"+STUDENTS_COURSE" => "firstname,lastname",
"+TEACHERS_COURSE" => "firstname,lastname",
"+TEACHERS_STUDENTS_COURSE" => "",
"COURSE_INFO" => "name"

);

// '+' REQUIRES COURSE
$sql = array(
"ALL_TEACHERS" => "SELECT * FROM `teachers`",
"ALL_STUDENTS_ASC_BIRTH" => "SELECT * FROM `students` ORDER BY birthdate ASC",
">ALL_COURSES" => "SELECT * FROM `courses`",
"TEACHERS_PARTTIME" => "SELECT * FROM `teachers` WHERE workload < 100",
"COURSE_NO_TEACHER" => "SELECT * FROM `courses` WHERE teacher_id = 0",
"+STUDENTS_COURSE" => "!1",
"+TEACHERS_COURSE" => "!2",
"+TEACHERS_STUDENTS_COURSE" => "!3"
);

function GetCourses($link, $sql)
{
$result = mysqli_query($link, $sql);

if ($result) {
return mysqli_fetch_all($result);
}
}

$courses = GetCourses($link, $sql[">ALL_COURSES"]);
$course_name_index  = 1;
$course_id_index  = 0;

?>

<html>

<head>
<style>
.information {
display: block;
}

.course {
display: none;
}

/* #inf {
display: none;
} */

p {
margin: 0;
padding: 0;
}

h5 {
margin: 0;
padding: 0;
}
</style>
</head>

<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<select class="information" id="information" name="query">
<option value="" selected>Select Information</option>
<?php
for ($i = 0; $i < count($inf); $i++) {
echo '<option value="' . $i . '">' . $dispname[$inf[$i]] . '</option>';
}
?>
</select>
<select class="course" id="course" name="course">
<option value="-1" selected>Select Course</option>
<?php
for ($i = 0; $i < count($courses); $i++) {
echo '<option value="' . $courses[$i][$course_id_index] . '">' . $courses[$i][$course_name_index] . '</option>';
}
?>
</select>
<input type="submit" value="Submit" id="submitButton" hidden />
</form>
<div id="inf">
<?php
if ($posted) {
if ($_POST['course'] != -1) {
$course = $_POST['course'];
$query = $_POST['query'];
$name = $inf[$query];
$sql = "";

switch ($query) {
case 5: // Students in course
PrintStudentsInClass($link, $disp, $dispname, $name, $courses, $course);
break;
case 6: // Teachers for course
PrintTeachersInClass($link, $disp, $dispname, $name, $courses, $course);
break;
case 7: // Teachers and students in course
PrintTeachersInClass($link, $disp, $dispname, "+TEACHERS_COURSE", $courses, $course);
echo "<br>";
PrintStudentsInClass($link, $disp, $dispname, "+STUDENTS_COURSE", $courses, $course);
break;
}
} else {
$name = $inf[$_POST['query']];
$query = $sql[$name];

$result = mysqli_query($link, $query);
PrintHeader($disp, $dispname, $name);
PrintResult($result, $disp, $name);
}
}

function PrintStudentsInClass($link, $disp, $dispname, $name, $courses, $course)
{
$query = 'SELECT * FROM `coursestudents` WHERE course_id=' . $course . '';
if ($result1 = mysqli_query($link, $query)) {
PrintHeader($disp, $dispname, $name, $courses[$course - 1][1]);
while ($row = mysqli_fetch_assoc($result1)) {
$query2 = 'SELECT * FROM `students` WHERE id=' . $row['student_id'];
if ($result = mysqli_query($link, $query2)) {
PrintResult($result, $disp, $name);
}
}
}
}

function PrintTeachersInClass($link, $disp, $dispname, $name, $courses, $course)
{
$query = 'SELECT * FROM `courses` WHERE id=' . $course . '';
if ($result1 = mysqli_query($link, $query)) {
PrintHeader($disp, $dispname, $name, $courses[$course - 1][1]);
while ($row = mysqli_fetch_assoc($result1)) {
$query2 = 'SELECT * FROM `teachers` WHERE id=' . $row['teacher_id'];
if ($result = mysqli_query($link, $query2)) {
PrintResult($result, $disp, $name);
}
}
}
}

function PrintHeader($disp, $dispname, $name, $extra = '')
{
echo '<strong>' . $dispname[$name] . ' ' . $extra . '</strong><br>';
$disparr = explode(",", $disp[$name]);
echo '<h5>';
for ($i = 0; $i < count($disparr); $i++) {
echo strtoupper($disparr[$i]) . ' ';
}
echo   '</h5><br>';
}

function PrintResult($result, $disp, $name)
{
$disparr = explode(",", $disp[$name]);

if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
// print_r($row);
echo '<p>';
for ($j = 0; $j < count($disparr); $j++) {
echo $row[$disparr[$j]] . ' ';
}
echo '</p>';
}
}
}
?>
</div>
</body>
<footer>
<script>
let informationElement = document.getElementById("information");
informationElement.onchange = function() {
let courses = document.getElementById("course");
let hiddenInf = document.getElementById("inf");
let submitButton = document.getElementById("submitButton");
let found = false;
let showCourses = false;
let showSubmit = true;

if (this.value == "") {
submitButton.hidden = true;
hiddenInf.style.display = "none";
courses.style.display = "none";
return;

}

<?php
for ($i = 0; $i < count($inf); $i++) {
if (strlen($inf[$i]) > 0) {
$needs_course = $inf[$i][0] == '+' ? true : false;

if ($needs_course) {
$key = array_search($inf[$i], $inf);
echo 'if (this.value == ' . $key . ') {found = true; showSubmit = false;}';
}
}
}
?>

if (!found)
submitButton.click();

courses.style.display = (found) ? "block" : "none";
hiddenInf.style.display = (showCourses) ? "block" : "none";
submitButton.hidden = (showSubmit) ? false : true;
};

let courseElement = document.getElementById("course");
courseElement.onchange = function() {
let submitButton = document.getElementById("submitButton");
if (this.value == "") {
submitButton.hidden = true;
return;

}

submitButton.click();

}
</script>
</footer>

<?php
mysqli_close($link);

?>

</html>
