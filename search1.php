<head>
<title>Search by Date</title>
<link href="style1.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="bisque">
<table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
<div>
<tr class="tableheader">
<td align="center" colspan="12">Bookings</td>
</tr>
<tr class="tableheader">
<td align="center" colspan="12">For theory</td>
</tr>
<tr class="tablerow">
<?php
session_start();
$connection = mysql_connect("localhost", "root", "");
$date=$_POST['date'];
$db = mysql_select_db("jeni", $connection); 
$result1 = mysql_query("Select * from theoryrecord where ddate='".$date."'");
$row1 = mysql_fetch_array($result1);
if($row1 == true)
{
  echo "<td align='right'>Date of the session</td>" ;
  echo "<td>Hall id</td>";
  echo "<td>9.00 am - 9.50 am</td>";
  echo "<td>9.50 am - 10.40 am</td>" ;
  echo "<td >11.00 am - 11.50 am</td>";
  echo "<td>11.50 am - 12.40 pm</td>";
  echo "<td>1.40 pm - 2.30 pm</td>";
  echo "<td>2.30 pm - 3.20 pm</td>" ;
  echo "<td>3.20 pm - 4.30 pm</td>";
  echo "</tr>";
  echo "<tr class='tablerow'>";
  echo "<td align='right'>".$row1[9]."</td>";
  echo "<td>".$row1[1]."</td>";
  echo "<td >".$row1[2]."</td>";
  echo "<td >".$row1[3]."</td>";
  echo "<td >".$row1[4]."</td>";
  echo "<td >".$row1[5]."</td>";
  echo "<td >".$row1[6]."</td>";
  echo "<td >".$row1[7]."</td>";
  echo "<td >".$row1[8]."</td>";
  echo "</tr>";
  $result1 = mysql_query("Select * from bookingdetails where ddate='".$date."'");   
  echo "<table border='0' cellpadding='10' cellspacing='1' width='500' align='center'> ";  
  echo "<tr class='tableheader'>" ;
  echo "<td align='center' colspan='12'>Bookings done by</td>";
  echo "</tr>" ;
  echo "<tr class='tablerow'> " ;
  echo "<td align='right'>Date of the session</td>" ;
  echo "<td>Hall id</td>";  
  echo "<td>Booked by</td>";  
  echo "<td>Dept of staff</td>";  
  echo "<td>Category</td>"; 
  echo "<td>Session1</td>";  
  echo "<td>Session2</td>";  echo "</tr>";
  while($row1 = mysql_fetch_array($result1))
  {
      echo "<tr class='tablerow'>";
  echo "<td align='right'>".$row1[3]."</td>";
  echo "<td>".$row1[1]."</td>";
  echo "<td >".$row1[2]."</td>";
  echo "<td >".$row1[4]."</td>";
  echo "<td >".$row1[5]."</td>";  
  echo "<td >".$row1[8]."</td>";
  echo "<td >".$row1[9]."</td>";
  echo "</tr>";
  } 
  echo "</table>" ; 
}
else
{
   echo "<tr class='tablerow'>";
  echo "<td align='right'>No halls have been booked for theory for the given date</td>";
  echo "</tr>";
}
?>
<table border="0" cellpadding="10" cellspacing="1" width="500" align="center">
<div>
<tr class="tableheader">
<td align="center" colspan="12">For extracurricular</td>
</tr>
<tr class="tablerow">
<?php
$result1 = mysql_query("Select * from  extrarecord where ddate='".$date."'");
$row1 = mysql_fetch_array($result1);
if($row1 == true)
{
  echo "<td align='right'>Date of the session</td>" ;
  echo "<td>Hall id</td>";
  echo "<td>Full day</td>";  
  echo "<td>Fore noon</td>";
  echo "<td>After noon</td>" ;
  echo "<td>Evening</td>";
  echo "</tr>";
  echo "<tr class='tablerow'>";
  echo "<td align='right'>".$row1[6]."</td>";
  echo "<td>".$row1[1]."</td>";
  echo "<td >".$row1[2]."</td>";
  echo "<td >".$row1[3]."</td>";
  echo "<td >".$row1[4]."</td>";
  echo "<td >".$row1[5]."</td>";  
  echo "</tr>";
  $result1 = mysql_query("Select * from bookingdetails where ddate='".$date."'");   
  echo "<table border='0' cellpadding='10' cellspacing='1' width='500' align='center'> ";  
  echo "<tr class='tableheader'>" ;
  echo "<td align='center' colspan='12'>Bookings done by</td>";
  echo "</tr>" ;
  echo "<tr class='tablerow'> " ;
  echo "<td align='right'>Date of the session</td>" ;
  echo "<td>Hall id</td>";  
  echo "<td>Booked by</td>";  
  echo "<td>Dept of staff</td>";  
  echo "<td>Category</td>"; 
  echo "<td>Session1</td>";  
  echo "<td>Session2</td>";  echo "</tr>";
  while($row1 = mysql_fetch_array($result1))
  {
      echo "<tr class='tablerow'>";
  echo "<td align='right'>".$row1[3]."</td>";
  echo "<td>".$row1[1]."</td>";
  echo "<td >".$row1[2]."</td>";
  echo "<td >".$row1[4]."</td>";
  echo "<td >".$row1[5]."</td>";  
  echo "<td >".$row1[8]."</td>";
  echo "<td >".$row1[9]."</td>";
  echo "</tr>";
  } 
  echo "</table>" ; 
}
else
{
   echo "<tr class='tablerow'>";
  echo "<td align='right'>No halls have been booked for extracurricular for the given date</td>";
  echo "</tr>";
} ?>
</table>
<p>
| 101 | ValluvarArangam <br>
| 102 | MechSeminar <br>
| 103 | ECESeminar <br>
| 104 | CivilSeminar <br>
| 105 | Bio-tech <br>
| 106 | Nano-tech <br>
| 107 | MCC <br>
| BT | Booked for theory <br>
| BE | Booked for extra-curricular <br>
</p>
If any of your booked session is not found, then it might have been booked by other staff for extracurricular. 
</html>