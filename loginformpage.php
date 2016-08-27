<?php
include('uservalidation.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<link href="style2.css" rel="stylesheet" type="text/css">
<style>
body
{
font-family:Comic Sans MS;font-color:purple;font-size:150%;
background-image:url('th.jpeg');
background-attachment: fixed;
background-repeat:no-repeat;
background-size:100%;
}
</style>
</head>
<body>
<div id="main" style="height:500px;">
<img src="clgname1.jpg"
</div>
<h2>SEMINAR HALL BOOKING</h2>
<center>
<div id="login">
<form action="" method="post">
<label align="left">UserId</label>
<input id="name" name="username" placeholder="username" type="text" required>
<label align="left">Password</label>
<input id="password" name="password" placeholder="**********" type="password">
<br><br>
<input name="submit" type="submit" value=" Login ">
<span><?php echo $error; ?></span>
</form>
</div>
</center>
</body>
</html>