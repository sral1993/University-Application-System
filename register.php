<?php
session_start();
session_regenerate_id();
$header=htmlspecialchars("/var/www/html/project/header.php",ENT_QUOTES);
//include_once($header);
echo "<body style= 'background: url(https://thumbs.dreamstime.com/z/students-teachers-characters-set-vector-collection-stylish-student-teacher-other-education-modern-flat-design-style-33129285.jpg );' >";

$include=htmlspecialchars("/var/www/html/project/project-lib.php",ENT_QUOTES);
include_once($include);
connect($db);
echo "<h4 align='center'> <a style='color:#ff0000'href=index.php> Dashboard </a> ";

echo "<hr>";

isset( $_REQUEST['s'])? $s = strip_tags($_REQUEST['s']) : $s=0;
isset( $_REQUEST['username'])? $username = strip_tags($_REQUEST['username']) : $username=0;
isset( $_REQUEST['password'])? $password = strip_tags($_REQUEST['password']) : $password=0;
isset( $_REQUEST['category'])? $category = strip_tags($_REQUEST['category']) : $category=0;


switch($s)
{

case 0:
echo "
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<form method=post action=register.php?s=1>
Please Select the type of user:
<input type= \"radio\" name=\"category\" value=\"1\">Student 
<input type= \"radio\" name=\"category\"value=\"4\">University
<br>
Username:
<input type= \"text\" name=\"username\">
<br>
Password:
<input type= \"text\" name=\"password\">
<br>
<br>
<input type=\"submit\" value=\"Register\"/>
</form>
</h4>";
break;

case 1:
/*
echo "$username"; echo "<br>";
echo "$password"; echo "<br>";
echo "$category"; echo "<br>";
*/
$username=mysqli_real_escape_string($db, $username);
$password=mysqli_real_escape_string($db, $password);
$category=mysqli_real_escape_string($db, $category);
$salt=rand(0,25689778967);
$password=hash('sha256',$password.$salt);
//$password=hash('sha256',$password);
if ($stmt = mysqli_prepare($db, "INSERT INTO user set userid='', username=?, password=?,categoryid=?,salt=?")) {
        mysqli_stmt_bind_param($stmt, "ssss", $username, $password, $category, $salt);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
echo"Added New user";

} else {
        echo " Error with the query";
}
//echo "$salt";
/*
if($category==4)
{

if ($stmt = mysqli_prepare($db, "INSERT INTO university set universityid='', userid=?,name=?")) {
        mysqli_stmt_bind_param($stmt, "ssss", $userid, $name);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

} else {
        echo " Error with the query";
}

}
*/
header("Location: /project/login.php");


break;
}
?>
