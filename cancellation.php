<html>
<head>
</head>
<body bgcolor="bisque">
<?php
session_start();
$connection = mysql_connect("localhost", "root", "");
$error = "";
$db = mysql_select_db("jeni", $connection);
$hname=$_POST['hall'];
$date=$_POST['date'];
$bid=$_POST['bid'];
$cadre=$_POST['cadre'];
$result = mysql_query("SELECT id FROM halldetails where name='".$hname."'");
while($row1 = mysql_fetch_array($result))
		$hid = $row1[0];		
$result1 = mysql_query("SELECT * FROM bookingdetails where ddate='".$date."' and cadre='".$cadre."' and bid=".$bid." and hid=".$hid." and staff='".$_SESSION['login_user']."'");
$row1 = mysql_fetch_array($result1);
if($row1 == false)
    echo "Sorry!! no such records are found";
else
{
   if($row1[8] == 'full' || $row1[8] == 'fore' || $row1[8] == 'after' || $row1[8] == 'eve')
   {
      $result2 = mysql_query("SELECT * FROM extrarecord where ddate='".$date."' and bid=".$bid." and hid=".$hid);
	  $row2 = mysql_fetch_array($result2);
	  if($row2 == true)
      {
	     if($row1[8] == 'full')	     
	         $chk1 = mysql_query("update extrarecord set full='A',fore='A',after='A',eve='A' where ddate='".$date."' and bid=".$bid." and hid=".$hid);	     
		 else		 
		    $chk1 = mysql_query("update extrarecord set ".$row1[8]." = 'A' where ddate='".$date."' and bid=".$bid." and hid=".$hid);			
	  }	  
   }
   else
   {
       $result2 = mysql_query("SELECT * FROM theoryrecord where ddate='".$date."' and bid=".$bid." and hid=".$hid);
	   $row2 = mysql_fetch_array($result2);       
	   if($row2 == true)
       { 
	       if($row1[6] == 2)  
	          $chk1 = mysql_query("update theoryrecord set ".$row1[8]." = 'A' ," .$row1[9]." = 'A' where ddate='".$date."' and bid=".$bid." and hid=".$hid);
		   else
		       $chk1 = mysql_query("update theoryrecord set ".$row1[8]." = 'A' where ddate='".$date."' and bid=".$bid." and hid=".$hid);
	   }	   
   }
   if($chk1 == 0)
      echo "Updation unsuccess" ;   
   $result2 = mysql_query("delete from bookingdetails where ddate='".$date."' and sid= ".$_SESSION['userid'] );
   if($result2 == true)
       echo "<h2>The session has been cancelled successfully</h2>" ;
}
?>
</body>
</html>