<?php

function connect(&$db) {
        $mycnf="/etc/project-mysql.conf";
        if (!file_exists($mycnf)) {
                echo "Error file not found: $mycnf";
                exit;
        }

$mysql_ini_array = parse_ini_file($mycnf);
$db_host=$mysql_ini_array["host"];
$db_user=$mysql_ini_array["user"];
$db_pass=$mysql_ini_array["pass"];
$db_port=$mysql_ini_array["port"];
$db_name=$mysql_ini_array["dbName"];

$db = mysqli_connect(
        $db_host,
        $db_user,
        $db_pass,
        $db_name,
        $db_port
);

if (!$db) {
 echo "Error connectiong to DB: .mysqli_connect_error()";
 exit;
}
}

function authenticate(&$db,$postUser,$postPass){
$query="select userid,categoryid,password,salt from user where username=?";
if($stmt = mysqli_prepare($db, $query)){
	mysqli_stmt_bind_param($stmt, "s", $postUser);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$userid,$categoryid,$password,$salt);
	while(mysqli_stmt_fetch($stmt)) {
		$userid=$userid;
		$password=$password;
		$salt=$salt;
		$categoryid=$categoryid;
	}
mysqli_stmt_close($stmt);
if($userid < 17)
{
$epass=$postPass;
}
else
{
$epass=hash('sha256',$postPass.$salt);
}
if($epass == $password){
	session_regenerate_id();
	$_SESSION['userid']=$userid;
	$_SESSION['categoryid']=$categoryid;
	$_SESSION['authenticated']="yes";
	$_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
        $_SESSION['HTTP_USER_AGENT']=md5($_SERVER['SERVER_ADDR'].$_SERVER['HTTP_USER_AGENT']);
        $_SESSION['created']=time();
        $action='pass';
        logininput($db,$postUser,$action);
}else{
	echo"<br>";
        echo "Failed to Login";
	$action='fail';
        logininput($db,$postUser,$action);
        error_log("Srivishnu_Alvakonda_Project has failed login from Ip Address : ". $_SERVER['REMOTE_ADDR'],0);
	header("Location: /project/login.php");
	exit;
}
}
}

function logininput(&$db,$postUser,$action) {
$query="INSERT INTO login set loginid='',ip=?,user=?,date=now(),action=?";
if($stmt = mysqli_prepare($db, $query)){
        mysqli_stmt_bind_param($stmt, "sss", $_SERVER['REMOTE_ADDR'],$postUser,$action);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
}
}



function checkAuth(){

if(isset($_SESSION['HTTP_USER_AGENT'])) {
        if($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['SERVER_ADDR'].$_SERVER['HTTP_USER_AGENT'])) {
        logout();
        }
} else {
        logout();
}

if(isset($_SESSION['ip'])) {
        if($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) {
                logout();
        }
} else {
        logout();
}

if(isset($_SESSION['created'])) {
        if(time() - $_SESSION['created'] > 5000) {
                logout();
        }
} else {
        logout();
}

 if("POST" == $_SERVER["REQUEST_METHOD"]) {
        if (isset($_SERVER["HTTP_ORIGIN"])) {
                        if($_SERVER["HTTP_ORIGIN"] != "https://100.66.1.4") {
                        logout();
        }
        } else {
        logout();
        }
}


}
function logout()
{
header("Location: /project/dashboard.php?s=88");
}


?>
