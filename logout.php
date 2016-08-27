<?php
//session_destroy();
if(isset($_SESSION['login_user']))
   unset($_SESSION['login_user']);
?>
<html>
<head>
  <title>Main page </title>
</head>  
<Script Language=JavaScript> parent.RIGHT.location.href='beforelogin.html'</script>
	<Script Language=JavaScript>parent.BODY.location.href='logout.html'</script>
	<Script Language=JavaScript>parent.LEFT.location.href='beforelogin.html'</script>
</html>

