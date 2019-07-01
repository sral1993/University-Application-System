<?php
session_start();
session_regenerate_id();
$header=htmlspecialchars("/var/www/html/project/header.php",ENT_QUOTES);
//include_once($header);
echo "<body style= 'background: url(https://thumbs.dreamstime.com/z/students-teachers-characters-set-vector-collection-stylish-student-teacher-other-education-modern-flat-design-style-33129285.jpg );' >";

$include=htmlspecialchars("/var/www/html/project/project-lib.php",ENT_QUOTES);
include_once($include);
connect($db);
echo "<h4 align='center'> <a style='color:#ff0000'href=recommender.php> Recommender Home </a> ";

echo "<hr>";


isset( $_REQUEST['s'])? $s = strip_tags($_REQUEST['s']) : $s=0;
isset( $_REQUEST['sid'])? $sid = strip_tags($_REQUEST['sid']) : $sid=0;
isset( $_REQUEST['studentid'])? $studentid = strip_tags($_REQUEST['studentid']) : $studentid=0;
isset( $_REQUEST['recoid'])? $recoid = strip_tags($_REQUEST['recoid']) : $recoid=0;
isset( $_REQUEST['lor'])? $lor = strip_tags($_REQUEST['lor']) : $lor=0;

if(!(is_numeric($s)))
{
$str= "Error!!! s is not numeric";
echo htmlspecialchars($str,ENT_QUOTES);
echo "<br>";
}

if(is_numeric($s))
{
switch($s)
{
case 0:
$x=$_SESSION['userid'];
echo"Please select the student to give recommendation:";
echo"<br>";
$query="select distinct i.studentid ,f.firstname  from recommenderlist i,student f where i.studentid = f.studentid and i.studentid>29 and i.userid=$x";
$result=mysqli_query($db, $query);
echo "<br>";
echo "<table border='4'<h4 style='font:20px/31px Arial;color:#004400'; align='center'> </h4>";
echo "<tr>
<th> Student ID </th>
<th> Name </th>
</tr>";
while($row=mysqli_fetch_row($result)){
$row[0]=htmlspecialchars($row[0]);
$row[1]=htmlspecialchars($row[1]);
        echo "<tr>";
        echo "<td> $row[0] </td>";
        echo "<td> <a href=recommender.php?s=2&sid=$row[0] > $row[1] </a> </td>";
        echo "</tr>";
}
echo "</table>";


break;
case 2:
$x=$_SESSION['userid'];
if ($stmt = mysqli_prepare($db, "SELECT recommenderlistid from recommenderlist where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $recommenderlistid);
        while(mysqli_stmt_fetch($stmt)) {
        $recommenderlistidid=$recommenderlistid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

echo "<br>";

echo "
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<form method=post action=recommender.php?s=3&studentid=$sid&recoid=$recommenderlistid>
Please Enter the recommendation:
<input type= \"text\" name=\"lor\">
<br>
<input type= \"submit\" value=\"Submit Recommendation\" />
</form>
</h4>";


break;

case 3;
$lor=mysqli_real_escape_string($db, $lor);
if ($stmt = mysqli_prepare($db, "INSERT INTO recommendation set recommendationid='', studentid=?, recommenderlistid=?, lor=?")) {
        mysqli_stmt_bind_param($stmt, "sss", $studentid, $recoid, $lor);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}
header("Location: /project/recommender.php");

break;

case 88;

session_destroy();
header("Location: /project/login.php");
break;

}

}

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "
<h4 align='center'>
<a href=recommender.php?s=88> Logout </a>
</h4>";


?>




