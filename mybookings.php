<head>
<title>My bookings</title>
<link href="style1.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="bisque">
<table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
<div>
<tr class="tableheader">
<td align="center" colspan="2">Your Bookings</td>
</tr>
<tr class="tablerow">
<td align="right">Bookingid</td>
<td>Hall id</td>
<td>Date of the session</td>
<td>Category</td>
<td >No. of sessions booked</td>
<td>Session1</td>
<td>Session2</td>
</tr>
<?php
session_start();
$connection = mysql_connect("localhost", "root", "");
$error = "";
$db = mysql_select_db("jeni", $connection); 
$query = "Select * from bookingdetails where sid=".$_SESSION['userid'];
$result1 = mysql_query("Select * from bookingdetails where sid=".$_SESSION['userid']);
while($row1 = mysql_fetch_array($result1))
{
  echo "<tr class='tablerow'>";
  echo "<td align='right'>".$row1[0]."</td>";
  echo "<td>".$row1[1]."</td>";
  echo "<td >".$row1[3]."</td>";
  echo "<td >".$row1[5]."</td>";
  echo "<td >".$row1[6]."</td>";
  if($row1[5] == 'theory')
  {if($row1[8] == 'd1')
     echo "<td>9.00 am to 9.50 am</td>";
  else if($row1[8] == 'd2')
     echo "<td>9.50 am to 10.40 am</td>";
  else if($row1[8] == 'd3')
     echo "<td>11.00 am to 11.50 am</td>";
  else if($row1[8] == 'd4')
     echo "<td>11.50 am to 12.40 pm</td>";
  else if($row1[8] == 'd5')
     echo "<td>1.40 am to 2.30 pm</td>";
  else if($row1[8] == 'd6')
     echo "<td>2.30 pm to 3.20 pm</td>";
  else
     echo "<td>3.40 pm to 4.30 pm</td>";
  if($row1[9] == 'd1')
     echo "<td>9.00 am to 9.50 am</td>";
  else if($row1[9] == 'd2')
     echo "<td>9.50 am to 10.40 am</td>";
  else if($row1[9] == 'd3')
     echo "<td>11.00 am to 11.50 am</td>";
  else if($row1[9] == 'd4')
     echo "<td>11.50 am to 12.40 pm</td>";
  else if($row1[9] == 'd5')
     echo "<td>1.40 am to 2.30 pm</td>";
  else if($row1[9] == 'd6')
     echo "<td>2.30 pm to 3.20 pm</td>";
  else if($row1[9] == 'd7')
     echo "<td>3.40 pm to 4.30 pm</td>";  
  }
  else
  {
     if($row1[8] == 'full')
     echo "Full day</td>";
  else if($row1[8] == 'fore')
     echo "<td>Fore noon</td>";
  else if($row1[8] == 'after')
     echo "<td>After noon</td>";
  else
     echo "<td>Evening</td>";
  }
  echo "</tr>";
}
?>
</table>
<p>
| 101 | ValluvarArangam <br>
| 102 | MechSeminar <br>
| 103 | ECESeminar <br>
| 104 | CivilSeminar <br>
| 105 | Bio-tech <br>
| 106 | Nano-tech <br>
| 107 | MCC <br>
</p>
If any of your booked session is not found, then it might have been booked by other staff for extracurricular. 
</html>