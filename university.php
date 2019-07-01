<?php
session_start();
session_regenerate_id();
$header=htmlspecialchars("/var/www/html/project/header.php",ENT_QUOTES);
//include_once($header);
echo "<body style= 'background: url(https://thumbs.dreamstime.com/z/students-teachers-characters-set-vector-collection-stylish-student-teacher-other-education-modern-flat-design-style-33129285.jpg );' >";

$include=htmlspecialchars("/var/www/html/project/project-lib.php",ENT_QUOTES);
include_once($include);
connect($db);
echo "<h4 align='center'> <a style='color:#ff0000'href=university.php> University Home </a> ";
echo "<h4 align='center'> <a style='color:#ff0000'href=university.php?s=10> Add Profile </a> ";
echo "<hr>";


isset( $_REQUEST['s'])? $s = strip_tags($_REQUEST['s']) : $s=0;
isset( $_REQUEST['did'])? $did = strip_tags($_REQUEST['did']) : $did=0;
isset( $_REQUEST['did2'])? $did2 = strip_tags($_REQUEST['did2']) : $did2=0;
isset( $_REQUEST['sid'])? $sid = strip_tags($_REQUEST['sid']) : $sid=0;
isset( $_REQUEST['uid'])? $uid = strip_tags($_REQUEST['uid']) : $uid=0;
isset( $_REQUEST['did4'])? $did4 = strip_tags($_REQUEST['did4']) : $did4=0;
isset( $_REQUEST['sid4'])? $sid4 = strip_tags($_REQUEST['sid4']) : $sid4=0;
isset( $_REQUEST['uid4'])? $uid4 = strip_tags($_REQUEST['uid4']) : $uid4=0;
isset( $_REQUEST['aid4'])? $aid4 = strip_tags($_REQUEST['aid4']) : $aid4=0;
isset( $_REQUEST['did5'])? $did5 = strip_tags($_REQUEST['did5']) : $did5=0;
isset( $_REQUEST['sid5'])? $sid5 = strip_tags($_REQUEST['sid5']) : $sid5=0;
isset( $_REQUEST['uid5'])? $uid5 = strip_tags($_REQUEST['uid5']) : $uid5=0;
isset( $_REQUEST['aid5'])? $aid5 = strip_tags($_REQUEST['aid5']) : $aid5=0;
isset( $_REQUEST['decision'])? $decision = strip_tags($_REQUEST['decision']) : $decision=0;
isset( $_REQUEST['univname'])? $univname = strip_tags($_REQUEST['univname']) : $univname=0;
isset( $_REQUEST['lid'])? $lid = strip_tags($_REQUEST['lid']) : $lid=0;

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

case 10:
echo"
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<a href=university.php?s=11> Add Name </a> </h4>";
echo "<br>";
echo"
<h4 align='center'>
<a href=university.php?s=15> Add Department </a> </h4>";
echo "<br>";


break;

case 15:

$query="SELECT listid,name from departmentlist";
$result=mysqli_query($db, $query);
echo "<br>";
echo "<table border='4'<h4 style='font:20px/31px Arial;color:#004400'; align='center'> </h4>";
echo "<tr>
<th> ListId </th>
<th> DepartmentName </th>
</tr>";
while($row=mysqli_fetch_row($result)){
$row[0]=htmlspecialchars($row[0]);
$row[1]=htmlspecialchars($row[1]);
        echo "<tr>";
        echo "<td> $row[0] </td>";
        echo "<td> <a href=university.php?s=16&lid=$row[0] > $row[1] </a> </td>";
        echo "</tr>";
}
echo "</table>";


break;

case 16:

$universityid;
$x=$_SESSION['userid'];
if ($stmt = mysqli_prepare($db, "SELECT universityid from university where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $universityid);
        while(mysqli_stmt_fetch($stmt)) {
        $universityid=$universityid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

if ($stmt = mysqli_prepare($db, "INSERT INTO department set departmentid='', universityid=?, listid=?")) {
        mysqli_stmt_bind_param($stmt, "ss", $universityid, $lid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}

header("Location: /project/university.php");


break;
case 11:

echo "
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<form method=post action=university.php?s=12>
Add University Name:
<input type= \"text\" name=\"univname\">
<br>
<input type= \"submit\" value=\"Add\" />
</form>
</h4>";


break;
case 12:
$x=$_SESSION['userid'];
if ($stmt = mysqli_prepare($db, "INSERT INTO university set universityid='', userid=?, name=?")) {
        mysqli_stmt_bind_param($stmt, "ss", $x, $univname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}
if ($stmt = mysqli_prepare($db, "SELECT universityid from university where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $universityid);
        while(mysqli_stmt_fetch($stmt)) {
        $universityid=$universityid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
header("Location: /project/university.php");

break;

case 0:
$x=$_SESSION['userid'];
if ($stmt = mysqli_prepare($db, "SELECT universityid from university where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $universityid);
        while(mysqli_stmt_fetch($stmt)) {
        $universityid=$universityid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}


$query="SELECT departmentid,name from department,departmentlist where department.listid = departmentlist.listid and universityid=$universityid";
$result=mysqli_query($db, $query);
echo "<br>";
echo "<table border='4'<h4 style='font:20px/31px Arial;color:#004400'; align='center'> </h4>";
echo "<tr>
<th> DepartmentID </th>
<th> Name </th>
</tr>";
while($row=mysqli_fetch_row($result)){
$row[0]=htmlspecialchars($row[0]);
$row[1]=htmlspecialchars($row[1]);
        echo "<tr>";
        echo "<td> $row[0] </td>";
        echo "<td> <a href=university.php?s=1&did=$row[0] > $row[1] </a> </td>";
        echo "</tr>";
}
echo "</table>";

break;
case 1:

$x=$_SESSION['userid'];
if ($stmt = mysqli_prepare($db, "SELECT universityid from university where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $universityid);
        while(mysqli_stmt_fetch($stmt)) {
        $universityid=$universityid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

if ($stmt = mysqli_prepare($db, "SELECT studentid from submitapplication where universityid=? and departmentid=?")) {
        mysqli_stmt_bind_param($stmt, "ss" , $universityid, $did);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $studentid);
        while(mysqli_stmt_fetch($stmt)) {
        $studentid=$studentid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
echo"Students Applied to this Department";
echo"<br>";
echo"<br>";
echo "<h2 align='center'> <a style='color:#ff0000'href=university.php?s=2&did2=$did&uid=$universityid&sid=$studentid> student : $studentid </a> ";

echo "<h2>";



break;

case 2:
echo "<br>";
echo " Profile of the Student : $sid";
echo "<br>";
echo "<br>";
echo "<br>";
$applicationid;
$universityid=$uid;
$studentid=$sid;
$did=$did2;
$x=$_SESSION['userid'];

if ($stmt = mysqli_prepare($db, "SELECT applicationid,departmentid,sopid,recommendationid from submitapplication where universityid=? and studentid=?")) {
        mysqli_stmt_bind_param($stmt, "ss" , $universityid, $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $applicationid,$departmentid,$sopid,$recommendationid);
        while(mysqli_stmt_fetch($stmt)) {
        $applicationid=$applicationidid;
	$departmentid= $departmentid;
	$sopid= $sopid;
	$recommendationid= $recommendationid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

if($did==$departmentid)
{
if ($stmt = mysqli_prepare($db, "SELECT firstname,lastname,dob from student where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $firstname, $lastname, $dob);
        while(mysqli_stmt_fetch($stmt)) {
        $firstname=$firstname;
	$lastname=$lastname;
	$dob=$dob;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
echo "FirstName: $firstname"; echo "<br>";
echo "LastName: $lastname"; echo "<br>";
echo "Date of Birth: $dob"; echo "<br>";


if ($stmt = mysqli_prepare($db, "SELECT doornumber,street,city,state,zipcode,country,phone from address where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $doornumber, $street, $city, $state, $zipcode, $country, $phone);
        while(mysqli_stmt_fetch($stmt)) {
        $doornumber=$doornumber;
        $street=$street;
        $city=$city;
	$state=$state;
	$zipcode=$zipcode;
	$country=$country;
	$phone=$phone;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
echo "DoorNumber: $doornumber"; echo "<br>";
echo "Street: $Street"; echo "<br>";
echo "City: $city"; echo "<br>";
echo "State: $state"; echo "<br>";
echo "Zipcode: $zipcode"; echo "<br>";
echo "Country: $country"; echo "<br>";
echo "Phone : $phone"; echo "<br>";

if ($stmt = mysqli_prepare($db, "SELECT score,url from gre where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $score, $url);
        while(mysqli_stmt_fetch($stmt)) {
        $grescore=$score;
        $greurl=$url;
        
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
echo "GRE Score: $grescore"; echo "<br>";
echo "GRE Score Card URL: $greurl"; echo "<br>";

if ($stmt = mysqli_prepare($db, "SELECT score,url from toefl where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $score, $url);
        while(mysqli_stmt_fetch($stmt)) {
        $toeflscore=$score;
        $toeflurl=$url;
                }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
echo "TOEFL Score: $toeflscore"; echo "<br>";
echo "TOEFL Score Card URL: $toeflurl"; echo "<br>";

if ($stmt = mysqli_prepare($db, "SELECT url,cgpa,university from transcript where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $url, $cgpa, $university);
        while(mysqli_stmt_fetch($stmt)) {
        $uguniversity=$university;
        $ugcgpa=$cgpa;
        $cgpaurl=$url;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
echo "Under Grad University: $uguniversity"; echo "<br>";
echo "Under Grad CGPA: $ugcgpa"; echo "<br>";
echo "CGPA Score Card URL: $cgpaurl"; echo "<br>";

if ($stmt = mysqli_prepare($db, "SELECT sop from sop where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$sop);
        while(mysqli_stmt_fetch($stmt)) {
        $studentsop=$sop;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
echo "Statement of Purpose: $studentsop"; echo "<br>";

if ($stmt = mysqli_prepare($db, "SELECT lor from recommendation where recommendationid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $recommendationid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$lor);
        while(mysqli_stmt_fetch($stmt)) {
        $studentlor=$lor;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

if ($stmt = mysqli_prepare($db, "SELECT applicationid from submitapplication where universityid=? and studentid=?")) {
        mysqli_stmt_bind_param($stmt, "ss" , $universityid, $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$applicationid);
        while(mysqli_stmt_fetch($stmt)) {
        $applicationid=$applicationid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}


echo "Letter of Recommendation: $studentlor"; echo "<br>";

echo "<h2 align='center'> <a style='color:#ff0000'href=university.php?s=3&uid4=$universityid&aid4=$applicationid&did4=$did&sid4=$studentid> Take Decision </a> ";

echo "<h2>";



}
break;

case 3:

echo "
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<form method=post action=university.php?s=4&uid5=$uid4&aid5=$aid4&did5=$did4&sid5=$sid4>
Decision:
<input type= \"text\" name=\"decision\">
<br>
<br>
<input type= \"submit\" value=\"Submit Decision\" />
</form>
</h4>";
break;
case 4:

if ($stmt = mysqli_prepare($db, "INSERT INTO status set resultid='', universityid=?, applicationid=?, departmentid=?, studentid=?, result=?")) {
        mysqli_stmt_bind_param($stmt, "sssss", $uid5, $aid5, $did5, $sid5, $decision);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}

echo" Apllication Result is Successfully Posted";

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
<a href=university.php?s=88> Logout </a>
</h4>";

?>




