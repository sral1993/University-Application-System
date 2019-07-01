<?php
session_start();
session_regenerate_id();
$header=htmlspecialchars("/var/www/html/project/header.php",ENT_QUOTES);
//include_once($header);
echo "<body style= 'background: url(https://thumbs.dreamstime.com/z/students-teachers-characters-set-vector-collection-stylish-student-teacher-other-education-modern-flat-design-style-33129285.jpg );' >";

$bcg = htmlspecialchars('background-color:#ffcc80',ENT_QUOTES);
$include=htmlspecialchars("/var/www/html/project/project-lib.php",ENT_QUOTES);
include_once($include);
connect($db);

isset( $_REQUEST['s'])? $s = strip_tags($_REQUEST['s']) : $s=0;
isset( $_REQUEST['postUser']) ? $postUser = strip_tags($_REQUEST['postUser']) : $postUser="";
isset( $_REQUEST['postPass']) ? $postPass = strip_tags($_REQUEST['postPass']) : $postPass="";
isset( $_REQUEST['salt']) ? $salt = strip_tags($_REQUEST['salt']) : $salt="";
isset( $_REQUEST['categoryid']) ? $categoryid = strip_tags($_REQUEST['categoryid']) : $categoryid="";


if(!isset($_SESSION['authenticated']))  {
        $count=0;
        $x='fail';
        $a=$_SERVER['REMOTE_ADDR'];
        $whitelist=array('198.18.5.186');
        if(!in_array($a,$whitelist))    {
                $query="SELECT count(loginid) FROM login WHERE ip = ? and action = ? and date > DATE_SUB(NOW(), INTERVAL 1 HOUR)";
                if($stmt = mysqli_prepare($db, $query)) {
                        mysqli_stmt_bind_param($stmt, "ss", $a ,$x);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt,$count);
                        while(mysqli_stmt_fetch($stmt)) {
                                $count=htmlspecialchars($count);
                                }
                        mysqli_stmt_close($stmt);
                        }
                        if($count >= 100)
                        {
                        header("Location: /project/login.php");
                        }
                        else
                        {
                        authenticate($db,$postUser,$postPass);
                        }
                }
                else
                {
                authenticate($db,$postUser,$postPass);
                }
}

checkAuth();



switch($s) {

case 0:

if($_SESSION['categoryid']==1)
{
header("Location: /project/student.php");
}
elseif($_SESSION['categoryid']==2)
{
header("Location: /project/consultant.php");
}
elseif($_SESSION['categoryid']==3)
{
header("Location: /project/recommender.php");
}
elseif($_SESSION['categoryid']==4)
{
header("Location: /project/university.php");
}
elseif($_SESSION['categoryid']==5)
{
header("Location: /project/admin.php");
}

break;
case 88;

session_destroy();
header("Location: /project/login.php");
break;

}

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "
<h4 align='center'>
<a href=dashboard.php?s=88> Logout </a>
</h4>";


?>
