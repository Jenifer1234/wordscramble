<?php
session_start(); 
$error=''; 
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
$username=$_POST['username'];
$password=$_POST['password'];
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("jeni", $connection);
$query = mysql_query("select * from seminarlogindetails where password='$password' AND userid='$username'", $connection);
$row1 = mysql_fetch_array($query);
$rows = mysql_num_rows($query);
if ($rows == 1) 
{
$_SESSION['userid']=$row1[0];
$_SESSION['login_user']=$row1[2];
header("location:mainpage.html");
} else {
$error = "Username or Password is invalid";
}
mysql_close($connection);
}
}
?>