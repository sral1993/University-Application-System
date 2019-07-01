<?php
$header=htmlspecialchars("/var/www/html/project/header.php",ENT_QUOTES);
//include_once($header);

echo "<body style= 'background: url(https://thumbs.dreamstime.com/z/students-teachers-characters-set-vector-collection-stylish-student-teacher-other-education-modern-flat-design-style-33129285.jpg );' >";


$include=htmlspecialchars("/var/www/html/project/project-lib.php",ENT_QUOTES);
include_once($include);
connect($db);
echo "<h4 align='center'> <a style='color:#ff0000'href=index.php> Dashboard </a> ";
echo "<hr>";



echo "
<h4 style='font:20px/31px Arial;color:#004400'; align='center'>
<form method=post action=dashboard.php?s=0>
Username:
<input type= \"text\" name=\"postUser\">
<br>
Password:
<input type= \"password\" name=\"postPass\">
<br>
<input type= \"submit\" value=\"Login\" />
</form>
</h4>";

?>


