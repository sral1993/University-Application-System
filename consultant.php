<?php
session_start();
session_regenerate_id();
$header=htmlspecialchars("/var/www/html/project/header.php",ENT_QUOTES);
//include_once($header);

echo "<body style= 'background: url(https://thumbs.dreamstime.com/z/students-teachers-characters-set-vector-collection-stylish-student-teacher-other-education-modern-flat-design-style-33129285.jpg  );' >";


$include=htmlspecialchars("/var/www/html/project/project-lib.php",ENT_QUOTES);
include_once($include);
connect($db);

echo "<h4 align='center'> <a style='color:#ff0000'href=consultant.php> Consultant Home </a> ";

echo "<hr>";


isset( $_REQUEST['s'])? $s = strip_tags($_REQUEST['s']) : $s=0;
isset( $_REQUEST['x'])? $x = strip_tags($_REQUEST['x']) : $x=0;
isset( $_REQUEST['y'])? $y = strip_tags($_REQUEST['y']) : $y=0;
isset( $_REQUEST['comment'])? $comment = strip_tags($_REQUEST['comment']) : $comment=0;
isset( $_REQUEST['sid'])? $sid = strip_tags($_REQUEST['sid']) : $sid=0;
isset( $_REQUEST['rev'])? $rev = strip_tags($_REQUEST['rev']) : $rev=0;

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

$query="SELECT studentid,sop from sop where studentid>29";
$result=mysqli_query($db, $query);
echo "<br>";
echo "<table border='4' align = 'center'>";
echo "<tr>
<th> Studentid </th>
<th> Statement of Purpose </th>
</tr>";
while($row=mysqli_fetch_row($result)){
$row[0]=htmlspecialchars($row[0]);
$row[1]=htmlspecialchars($row[1]);
        echo "<tr>";
        echo "<td> $row[0] </td>";
        echo "<td> <a href=consultant.php?s=1&sid=$row[0]&rev=$row[1] > $row[1] </a> </td>";
        echo "</tr>";
}
echo "</table>";


break;
case 1:
echo "
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<form method=post action=consultant.php?s=2&x=$sid&y=$rev>
Enter Comments:
<input type= \"text\" name=\"comment\">
<br>
<input type= \"submit\" value=\"Submit Comment\" />
</form>
</h4>";


break;

case 2:
$u=$_SESSION['userid'];
$consultantid;
if ($stmt = mysqli_prepare($db, "SELECT consultantid from consultant where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $u);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $consultantid);
        while(mysqli_stmt_fetch($stmt)) {
        $consultantid=$consultantid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

if ($stmt = mysqli_prepare($db, "INSERT INTO review set reviewid='', studentid=?, consultantid=?, comments=?")) {
        mysqli_stmt_bind_param($stmt, "sss", $x, $consultantid, $comment);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}

echo " Review is Successfullu Submitted";
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
<a href=consultant.php?s=88> Logout </a>
</h4>";


?>




