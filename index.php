<?php

#author : Srivishnu Alvakonda
#name   : hw8.php
#purpose: A script to combine php and mysql
#date   : 2017/18/3
#version: 0.2 >

$header=htmlspecialchars("/var/www/html/project/header.php",ENT_QUOTES);
include_once($header);

$bcg = htmlspecialchars('background-color:#d0cc80',ENT_QUOTES);
echo "<body style= 'background: url(https://thumbs.dreamstime.com/z/students-teachers-characters-set-vector-collection-stylish-student-teacher-other-education-modern-flat-design-style-33129285.jpg );' >";
echo "<hr>";

echo "<h1 style='font:40px/41px Arial;color:#004400'; align='center'> ";

echo "Welcome to easyApply";

echo "</h1>";

echo "<br>";

echo "<br>";

echo "<br>";
echo "<br>";

echo "<br>";
echo "<br>";

echo "<br>";
echo "<br>";

echo "<br>";
echo "<br>";

echo "<br>";


echo "<h2 style='font:20px/31px Arial;color:#004400'; align='center'> ";

echo "New User? Please <a href=register.php> Register </a>";

echo "</h2>";


echo "<h2 style='font:20px/31px Arial;color:#004400'; align='center'>";

echo "Already a User? Please <a href=login.php> Login </a>";

echo "</h2>";

echo "<br>";


?>
