<?php
session_start();
session_regenerate_id();
$header=htmlspecialchars("/var/www/html/project/header.php",ENT_QUOTES);
//include_once($header);

echo "<body style= 'background: url(https://thumbs.dreamstime.com/z/students-teachers-characters-set-vector-collection-stylish-student-teacher-other-education-modern-flat-design-style-33129285.jpg);' >";
$include=htmlspecialchars("/var/www/html/project/project-lib.php",ENT_QUOTES);
include_once($include);
connect($db);


echo "<h4 align='center'> <a style='color:#ff0000'href=student.php> Student Home </a> ";

echo "<hr>";

isset( $_REQUEST['s'])? $s = strip_tags($_REQUEST['s']) : $s=0;
isset( $_REQUEST['firstname'])? $firstname = strip_tags($_REQUEST['firstname']) : $firstname=0;
isset( $_REQUEST['lastname'])? $lastname = strip_tags($_REQUEST['lastname']) : $lastname=0;
isset( $_REQUEST['dob'])? $dob = strip_tags($_REQUEST['dob']) : $dob=0;
isset( $_REQUEST['dno'])? $dno = strip_tags($_REQUEST['dno']) : $dno=0;
isset( $_REQUEST['street'])? $street = strip_tags($_REQUEST['street']) : $street=0;
isset( $_REQUEST['state'])? $state = strip_tags($_REQUEST['state']) : $state=0;
isset( $_REQUEST['city'])? $city = strip_tags($_REQUEST['city']) : $city=0;
isset( $_REQUEST['country'])? $country = strip_tags($_REQUEST['country']) : $country=0;
isset( $_REQUEST['gre'])? $gre = strip_tags($_REQUEST['gre']) : $gre=0;
isset( $_REQUEST['greurl'])? $greurl = strip_tags($_REQUEST['greurl']) : $greurl=0;
isset( $_REQUEST['toefl'])? $toefl = strip_tags($_REQUEST['toefl']) : $toefl=0;
isset( $_REQUEST['toeflurl'])? $toeflurl = strip_tags($_REQUEST['toeflurl']) : $toeflurl=0;
isset( $_REQUEST['cgpa'])? $cgpa = strip_tags($_REQUEST['cgpa']) : $cgpa=0;
isset( $_REQUEST['cgpaurl'])? $cgpaurl = strip_tags($_REQUEST['cgpaurl']) : $cgpaurl=0;
isset( $_REQUEST['phone'])? $phone = strip_tags($_REQUEST['phone']) : $phone=0;
isset( $_REQUEST['zip'])? $zip = strip_tags($_REQUEST['zip']) : $zip=0;
isset( $_REQUEST['univ'])? $univ = strip_tags($_REQUEST['univ']) : $univ=0;
isset( $_REQUEST['review'])? $review = strip_tags($_REQUEST['review']) : $review=0;
isset( $_REQUEST['sop1'])? $sop1 = strip_tags($_REQUEST['sop1']) : $sop1=0;
isset( $_REQUEST['sop2'])? $sop2 = strip_tags($_REQUEST['sop2']) : $sop2=0;
isset( $_REQUEST['uid'])? $uid = strip_tags($_REQUEST['uid']) : $uid=0;
isset( $_REQUEST['did'])? $did = strip_tags($_REQUEST['did']) : $did=0;
isset( $_REQUEST['uid2'])? $uid2 = strip_tags($_REQUEST['uid2']) : $uid2=0;
isset( $_REQUEST['did2'])? $did2 = strip_tags($_REQUEST['did2']) : $did2=0;
isset( $_REQUEST['rid'])? $rid = strip_tags($_REQUEST['rid']) : $rid=0;
isset( $_REQUEST['uid3'])? $uid3 = strip_tags($_REQUEST['uid3']) : $uid3=0;
isset( $_REQUEST['did3'])? $did3 = strip_tags($_REQUEST['did3']) : $did3=0;
isset( $_REQUEST['rid3'])? $rid3 = strip_tags($_REQUEST['rid3']) : $rid3=0;
isset( $_REQUEST['reconame1'])? $reconame1 = strip_tags($_REQUEST['reconame1']) : $reconame1=0;
isset( $_REQUEST['recomail1'])? $recomail1 = strip_tags($_REQUEST['recomail1']) : $recomail1=0;
isset( $_REQUEST['reconame2'])? $reconame2 = strip_tags($_REQUEST['reconame2']) : $reconame2=0;
isset( $_REQUEST['recomail2'])? $recomail2 = strip_tags($_REQUEST['recomail2']) : $recomail2=0;
isset( $_REQUEST['reconame3'])? $reconame3 = strip_tags($_REQUEST['reconame3']) : $reconame3=0;
isset( $_REQUEST['recomail3'])? $recomail3 = strip_tags($_REQUEST['recomail3']) : $recomail3=0;

function integercheck($variable)
{
if(!is_numeric($variable))
{
if(!($variable == null))
exit("Invalid entry of variable");
}
}

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
echo "<a style='font:30px/41px Arial;color:#003300' href=student.php?s=1 > Update Profile</a> 
<br>
<a style='font:30px/41px Arial;color:#003300' href=student.php?s=21 > Add Profile</a>
<br>
<a style='font:30px/41px Arial;color:#003300' href=student.php?s=3 > Add Statement of Purpose</a>
<br>
<a style='font:30px/41px Arial;color:#003300' href=student.php?s=5 > Consultant Review</a>
<br>
<a style='font:30px/41px Arial;color:#003300' href=student.php?s=7 > Recommenders</a>
<br>
<a style='font:30px/41px Arial;color:#003300' href=student.php?s=30 > Recommendation status</a>
<br>
<a style='font:30px/41px Arial;color:#003300' href=student.php?s=10 > Apply Universities</a> 
<br>
<a style='font:30px/41px Arial;color:#003300' href=student.php?s=15 > Check Status</a> </h4>";

break;

case 30:
$studentid;
$x=$_SESSION['userid'];
if ($stmt = mysqli_prepare($db, "SELECT studentid from student where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $studentid);
        while(mysqli_stmt_fetch($stmt)) {
        $studentid=$studentid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

echo"<br>";
$query="select r.name,l.lor,s.studentid from recommenderlist r, recommendation l ,student s where r.recommenderlistid=l.recommenderlistid and l.studentid=s.studentid and s.studentid=$studentid";
$result=mysqli_query($db, $query);
echo "<br>";
echo "<table border='4'<h4 style='font:20px/31px Arial;color:#004400'; align='center'> </h4>";
echo "<tr>
<th> Professor Name </th>
<th> Letter of Recommendation </th>
</tr>";
while($row=mysqli_fetch_row($result)){
$row[0]=htmlspecialchars($row[0]);
$row[1]=htmlspecialchars($row[1]);
        echo "<tr>";
        echo "<td> $row[0] </td>";
        echo "<td> $row[1] </a> </td>";
        echo "</tr>";
}
echo "</table>";


break;

case 15:
$studentid;
$x=$_SESSION['userid'];
if ($stmt = mysqli_prepare($db, "SELECT studentid from student where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $studentid);
        while(mysqli_stmt_fetch($stmt)) {
        $studentid=$studentid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}


echo"<br>";
$query="select u.name,r.departmentid,r.result from university u,status r where u.universityid=r.universityid and r.studentid=$studentid";
$result=mysqli_query($db, $query);
echo "<br>";
echo "<table border='4'<h4 style='font:20px/31px Arial;color:#004400'; align='center'> </h4>";
echo "<tr>
<th> University </th>
<th> DepartmentId </th>
<th> Result </th>
</tr>";
while($row=mysqli_fetch_row($result)){
$row[0]=htmlspecialchars($row[0]);
$row[1]=htmlspecialchars($row[1]);
$row[2]=htmlspecialchars($row[2]);
        echo "<tr>";
        echo "<td> $row[0] </td>";
        echo "<td> $row[1] </td>";
	echo "<td> $row[2] </td>";
        echo "</tr>";
}
echo "</table>";


break;
case 10:
$query="SELECT universityid,name from university where universityid>5 and universityid!=7 and universityid!=8";
$result=mysqli_query($db, $query);
echo "<br>";
echo "<table border='4'<h4 style='font:20px/31px Arial;color:#004400'; align='center'> </h4>";
echo "<tr>
<th> uid </th>
<th> Name </th>
</tr>";
while($row=mysqli_fetch_row($result)){
$row[0]=htmlspecialchars($row[0]);
$row[1]=htmlspecialchars($row[1]);
        echo "<tr>";
        echo "<td> $row[0] </td>";
        echo "<td> <a href=student.php?s=11&uid=$row[0] > $row[1] </a> </td>";
        echo "</tr>";
}
echo "</table>";


break;

case 11:

$query="SELECT departmentid,name from department,departmentlist where department.listid = departmentlist.listid and universityid=$uid";
$result=mysqli_query($db, $query);
echo "<br>";
echo "<table border='4'<h4 style='font:20px/31px Arial;color:#004400'; align='center'> </h4>";
echo "<tr>
<th> Departmentid </th>
<th> DepartmentName </th>
</tr>";
while($row=mysqli_fetch_row($result)){
$row[0]=htmlspecialchars($row[0]);
$row[1]=htmlspecialchars($row[1]);
        echo "<tr>";
        echo "<td> $row[0] </td>";
        echo "<td> <a href=student.php?s=12&did=$row[0]&uid=$uid > $row[1] </a> </td>";
        echo "</tr>";
}
echo "</table>";


break;
case 12:
$studentid;
$x=$_SESSION['userid'];
if ($stmt = mysqli_prepare($db, "SELECT studentid from student where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $studentid);
        while(mysqli_stmt_fetch($stmt)) {
        $studentid=$studentid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

echo"<br>";
$query="select r.name,l.lor,l.recommendationid,s.studentid from recommenderlist r, recommendation l ,student s where r.recommenderlistid=l.recommenderlistid and l.studentid=s.studentid and s.studentid=$studentid";
$result=mysqli_query($db, $query);
echo "<br>";
echo "<table border='4'<h4 style='font:20px/31px Arial;color:#004400'; align='center'> </h4>";
echo "<tr>
<th> Professor Name </th>
<th> Letter of Recommendation </th>
<th> RecommendationId </th>
</tr>";
while($row=mysqli_fetch_row($result)){
$row[0]=htmlspecialchars($row[0]);
$row[1]=htmlspecialchars($row[1]);
        echo "<tr>";
        echo "<td> $row[0] </td>";
	echo "<td> $row[1] </td>";
        echo "<td> <a href=student.php?s=13&rid=$row[2]&did2=$did&uid2=$uid > $row[2] </a> </td>";
        echo "</tr>";
}
echo "</table>";
break;
case 13:
echo "
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<form method=post action=student.php?s=14&uid3=$uid2&did3=$did2&rid3=$rid>
Username: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<input type= \"text\" name=\"User\">
<br>
Electronic Signature:
<input type= \"password\" name=\"Pass\">
<br>
<input type= \"submit\" value=\"Submit Application\" />
</form>
</h4>";



break;

case 14:

echo " Application is Successfully Submitted";
$x=$_SESSION['userid'];
if ($stmt = mysqli_prepare($db, "SELECT studentid from student where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $studentid);
        while(mysqli_stmt_fetch($stmt)) {
        $studentid=$studentid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

if ($stmt = mysqli_prepare($db, "SELECT sopid from sop where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $sopid);
        while(mysqli_stmt_fetch($stmt)) {
        $sopid=$sopid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

if ($stmt = mysqli_prepare($db, "INSERT INTO submitapplication set applicationid='', studentid=?, universityid=?, departmentid=?, sopid=?,recommendationid=?")) {
        mysqli_stmt_bind_param($stmt, "sssss", $studentid, $uid3, $did3, $sopid, $rid3);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}

header("Location: /project/student.php");

break;

case 1:
echo "
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<form method=post action=student.php?s=2>
First Name          :&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
<input type= \"text\" name=\"firstname\">
<br>
Last Name:&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
<input type= \"text\" name=\"lastname\">
<br>
Date of Birth:&nbsp;&nbsp; &nbsp; &nbsp;
<input type= \"text\" name=\"dob\">
<br>
Door Number:&nbsp;&nbsp; &nbsp; 
<input type= \"text\" name=\"dno\">
<br>
Street:&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
<input type= \"text\" name=\"street\">
<br>
City:&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"city\">
<br>
State:&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"state\">
<br>
Country: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"country\">
<br>
Zipcode: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
<input type= \"text\" name=\"zip\">
<br>
Phone Number: &nbsp; &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"phone\">
<br>
Enter your GRE Score:  &nbsp;
<input type= \"text\" name=\"gre\">
<br>
Upload URL: &nbsp;&nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"greurl\">
<br>
Enter your TOEFL Score: 
<input type= \"text\" name=\"toefl\">
<br>
Upload URL:  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"toeflurl\">
<br>
Undergraduate University:
<input type= \"text\" name=\"univ\">
<br>
Enter your Under Graduation CGPA: 
<input type= \"text\" name=\"cgpa\">
<br>
Upload URL:&nbsp;&nbsp; &nbsp;&nbsp;
<input type= \"text\" name=\"cgpaurl\">
<br>
<input type= \"submit\" value=\"Update Profile\" />
</form>
</h4>";
break;
case 21:
echo "
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<form method=post action=student.php?s=22>
First Name          :&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
<input type= \"text\" name=\"firstname\">
<br>
Last Name:&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
<input type= \"text\" name=\"lastname\">
<br>
Date of Birth:&nbsp;&nbsp; &nbsp; &nbsp;
<input type= \"text\" name=\"dob\">
<br>
Door Number:&nbsp;&nbsp; &nbsp;
<input type= \"text\" name=\"dno\">
<br>
Street:&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
<input type= \"text\" name=\"street\">
<br>
City:&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"city\">
<br>
State:&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"state\">
<br>
Country: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"country\">
<br>
Zipcode: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
<input type= \"text\" name=\"zip\">
<br>
Phone Number: &nbsp; &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"phone\">
<br>
Enter your GRE Score:  &nbsp;
<input type= \"text\" name=\"gre\">
<br>
Upload URL: &nbsp;&nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"greurl\">
<br>
Enter your TOEFL Score:
<input type= \"text\" name=\"toefl\">
<br>
Upload URL:  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"toeflurl\">
<br>
Undergraduate University:
<input type= \"text\" name=\"univ\">
<br>
Enter your Under Graduation CGPA:
<input type= \"text\" name=\"cgpa\">
<br>
Upload URL:&nbsp;&nbsp; &nbsp;&nbsp;
<input type= \"text\" name=\"cgpaurl\">
<br>
<input type= \"submit\" value=\"Add Profile\" />
</form>
</h4>";


break;
case 2:
$firstname=mysqli_real_escape_string($db, $firstname);
$lastname=mysqli_real_escape_string($db, $lastname);
$dob=mysqli_real_escape_string($db, $dob);
$x=$_SESSION['userid'];
$dno=mysqli_real_escape_string($db, $dno);
$street=mysqli_real_escape_string($db, $street);
$city=mysqli_real_escape_string($db, $city);
$state=mysqli_real_escape_string($db, $state);
$country=mysqli_real_escape_string($db, $country);
$zip=mysqli_real_escape_string($db, $zip);
$phone=mysqli_real_escape_string($db, $phone);
$gre=mysqli_real_escape_string($db, $gre);
$greurl=mysqli_real_escape_string($db, $greurl);
$toefl=mysqli_real_escape_string($db, $toefl);
$toeflurl=mysqli_real_escape_string($db, $toeflurl);
$cgpa=mysqli_real_escape_string($db, $cgpa);
$cgpaurl=mysqli_real_escape_string($db, $cgpaurl);
$univ=mysqli_real_escape_string($db, $univ);
$studentid;
$flag=0;
$addressid;
$greid;
$toeflid;
$transcriptid;
if ($stmt = mysqli_prepare($db, "SELECT studentid from student where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $studentid);
        while(mysqli_stmt_fetch($stmt)) {
        $studentid=$studentid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
if ($stmt = mysqli_prepare($db, "SELECT addressid from address where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $addressid);
        while(mysqli_stmt_fetch($stmt)) {
        $addressid=$addressid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

if ($stmt = mysqli_prepare($db, "SELECT greid from gre where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $greid);
        while(mysqli_stmt_fetch($stmt)) {
        $greid=$greid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
if ($stmt = mysqli_prepare($db, "SELECT toeflid from toefl where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $toeflid);
        while(mysqli_stmt_fetch($stmt)) {
        $toeflid=$toeflid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
if ($stmt = mysqli_prepare($db, "SELECT transcriptid from transcript where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $transcriptid);
        while(mysqli_stmt_fetch($stmt)) {
        $transcriptid=$transcriptid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}


if ($stmt = mysqli_prepare($db, "UPDATE student set userid=?, firstname=?, lastname=?, dob=? where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "sssss", $x, $firstname, $lastname, $dob, $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}
if ($stmt = mysqli_prepare($db, "UPDATE address set studentid=?, street=?,doornumber=?,city=?,state=?,zipcode=?,country=?,phone=? where addressid=?")) {
        mysqli_stmt_bind_param($stmt, "sssssssss", $studentid, $street, $dno, $city, $state, $zip, $country, $phone, $addressid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}
if ($stmt = mysqli_prepare($db, "UPDATE gre set studentid=?, score=?,url=? where greid=?")) {
        mysqli_stmt_bind_param($stmt, "ssss", $studentid, $gre, $greurl, $greid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}
if ($stmt = mysqli_prepare($db, "UPDATE toefl set studentid=?, score=?,url=? where toeflid=?")) {
        mysqli_stmt_bind_param($stmt, "ssss", $studentid, $toefl, $toeflurl,$toeflid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}
if ($stmt = mysqli_prepare($db, "UPDATE transcript set studentid=?, url=?,cgpa=?,university=? where transcriptid=?")) {
        mysqli_stmt_bind_param($stmt, "sssss", $studentid, $cgpaurl, $cgpa, $univ, $transcriptid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}

header("Location: /project/student.php");

break;

case 22:

$firstname=mysqli_real_escape_string($db, $firstname);
$lastname=mysqli_real_escape_string($db, $lastname);
$dob=mysqli_real_escape_string($db, $dob);
$x=$_SESSION['userid'];
$dno=mysqli_real_escape_string($db, $dno);
$street=mysqli_real_escape_string($db, $street);
$city=mysqli_real_escape_string($db, $city);
$state=mysqli_real_escape_string($db, $state);
$country=mysqli_real_escape_string($db, $country);
$zip=mysqli_real_escape_string($db, $zip);
$phone=mysqli_real_escape_string($db, $phone);
$gre=mysqli_real_escape_string($db, $gre);
$greurl=mysqli_real_escape_string($db, $greurl);
$toefl=mysqli_real_escape_string($db, $toefl);
$toeflurl=mysqli_real_escape_string($db, $toeflurl);
$cgpa=mysqli_real_escape_string($db, $cgpa);
$cgpaurl=mysqli_real_escape_string($db, $cgpaurl);
$univ=mysqli_real_escape_string($db, $univ);
$studentid;

if ($stmt = mysqli_prepare($db, "INSERT INTO student set studentid='', userid=?, firstname=?, lastname=?, dob=?")) {
        mysqli_stmt_bind_param($stmt, "ssss", $x, $firstname, $lastname, $dob);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}
if ($stmt = mysqli_prepare($db, "SELECT studentid from student where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $studentid);
        while(mysqli_stmt_fetch($stmt)) {
        $studentid=$studentid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

if ($stmt = mysqli_prepare($db, "INSERT INTO address set addressid='', studentid=?, street=?,doornumber=?,city=?,state=?,zipcode=?,country=?,phone=?")) {
        mysqli_stmt_bind_param($stmt, "ssssssss", $studentid, $street, $dno, $city, $state, $zip, $country, $phone);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}
if ($stmt = mysqli_prepare($db, "INSERT INTO gre set greid='', studentid=?, score=?,url=?")) {
        mysqli_stmt_bind_param($stmt, "sss", $studentid, $gre, $greurl);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}
if ($stmt = mysqli_prepare($db, "INSERT INTO toefl set toeflid='', studentid=?, score=?,url=?")) {
        mysqli_stmt_bind_param($stmt, "sss", $studentid, $toefl, $toeflurl);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}
if ($stmt = mysqli_prepare($db, "INSERT INTO transcript set transcriptid='', studentid=?, url=?,cgpa=?,university=?")) {
        mysqli_stmt_bind_param($stmt, "ssss", $studentid, $cgpaurl, $cgpa, $univ);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}
header("Location: /project/student.php");
break;

case 3:

echo "
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<form method=post action=student.php?s=4>
Enter Statement of Purpose:
<input type= \"text\" name=\"sop1\">
<br>
<input type= \"submit\" value=\"Submit Review Request\" />
</form>
</h4>";


break;

case 4:
$sop1=mysqli_real_escape_string($db, $sop1);
$review=mysqli_real_escape_string($db, $review);
$studentid;
$x=$_SESSION['userid'];
$conuserid=2;
$conname=consultant;
$review=yes;
if ($stmt = mysqli_prepare($db, "SELECT studentid from student where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $studentid);
        while(mysqli_stmt_fetch($stmt)) {
        $studentid=$studentid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

if ($stmt = mysqli_prepare($db, "INSERT INTO sop set sopid='', studentid=?, sop=?, request=?")) {
        mysqli_stmt_bind_param($stmt, "sss", $studentid, $sop1, $review);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}

if ($stmt = mysqli_prepare($db, "INSERT INTO consultant set consultantid='', userid=?, studentid=?, name=?")) {
        mysqli_stmt_bind_param($stmt, "sss", $conuserid, $studentid, $conname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}

header("Location: /project/student.php");
break;

case 5:
$x=$_SESSION['userid'];
if ($stmt = mysqli_prepare($db, "SELECT studentid from student where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $studentid);
        while(mysqli_stmt_fetch($stmt)) {
        $studentid=$studentid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
if ($stmt = mysqli_prepare($db, "SELECT comments from review where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $comments);
        while(mysqli_stmt_fetch($stmt)) {
        $comments=$comments;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
echo " <h4 style='font:20px/31px Arial;color:#004400'; align='center'>Consultant Review is : $comments </h4>";
echo "
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<form method=post action=student.php?s=6>
Update Statement of Purpose:
<input type= \"text\" name=\"sop2\">
<br>
<input type= \"submit\" value=\"Submit Review Request\" />
</form>
</h4>";

break;

case 6:

$sop2=mysqli_real_escape_string($db, $sop2);
$review=mysqli_real_escape_string($db, $review);
$studentid;
$sopid;
$x=$_SESSION['userid'];
echo"$sop2";
echo "<br>";
echo "$review";
echo "<br>";
$review=yes;
if ($stmt = mysqli_prepare($db, "SELECT studentid from student where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $studentid);
        while(mysqli_stmt_fetch($stmt)) {
        $studentid=$studentid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
echo"$studentid";
echo"<br>";
if ($stmt = mysqli_prepare($db, "SELECT sopid from sop where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $sopid);
        while(mysqli_stmt_fetch($stmt)) {
        $sopid=$sopid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
echo"$sopid";
if ($stmt = mysqli_prepare($db, "UPDATE sop set studentid=?, sop=?, request=? where sopid=?")) {
        mysqli_stmt_bind_param($stmt, "ssss", $studentid, $sop2, $review,$sopid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}

$conuserid=2;
$conname=consultant;

if ($stmt = mysqli_prepare($db, "SELECT consultantid from consultant where studentid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $studentid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $consultantid);
        while(mysqli_stmt_fetch($stmt)) {
        $consultantid=$consultantid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

if ($stmt = mysqli_prepare($db, "UPDATE consultant set userid=?, studentid=?, name=? where consultantid=?")) {
        mysqli_stmt_bind_param($stmt, "ssss", $conuserid, $studentid, $conname, $consultantid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}


header("Location: /project/student.php");

break;

case 7:

echo "
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<form method=post action=student.php?s=8>
Recommender Name:
<input type= \"text\" name=\"reconame1\">
<br>
Email:&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type= \"text\" name=\"recomail1\">
<br>
<input type= \"submit\" value=\"Submit Recommendation Request\" />
</form>
</h4>";


break;
case 8:
$reconame1=mysqli_real_escape_string($db, $reconame1);
$recomail1=mysqli_real_escape_string($db, $recomail1);
$studentid;
$x=$_SESSION['userid'];
$userid1;
$userid2;
$userid3;
if ($stmt = mysqli_prepare($db, "SELECT studentid from student where userid=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $x);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $studentid);
        while(mysqli_stmt_fetch($stmt)) {
        $studentid=$studentid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}
if ($stmt = mysqli_prepare($db, "SELECT userid from user where username=?")) {
        mysqli_stmt_bind_param($stmt, "s" , $reconame1);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $userid);
        while(mysqli_stmt_fetch($stmt)) {
        $userid1=$userid;
        }
        mysqli_stmt_close($stmt);
} else {
        echo " Error with the query";
}

if ($stmt = mysqli_prepare($db, "INSERT INTO recommenderlist set recommenderlistid='', userid=?, studentid=?, email=?, name=?")) {
        mysqli_stmt_bind_param($stmt, "ssss", $userid1, $studentid, $recomail1,$reconame1);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}

header("Location: /project/student.php");


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
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<a href=student.php?s=88> Logout </a>
</h4>";


?>
