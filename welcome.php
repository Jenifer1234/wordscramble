<?php   
session_start();
?>
<html>
<head>
</head>  
<body background="clg2.jpg">
<b><i>Welcome <?php echo $_SESSION['login_user']; ?></i></b>
</body>
</html>