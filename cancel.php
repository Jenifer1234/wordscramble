<html>
<head>
<title>Canellation Form</title>
<link href="style3.css" rel="stylesheet" type="text/css">
<link href="datepicker.css" rel="stylesheet" />        
<script language="JavaScript" src="datepicker.js" type="text/javascript"></script>
<script language="JavaScript" src="formVal.js" type="text/javascript"></script>
</head>
<body bgcolor="bisque">
<center><div id="login2" >
<h2>Cancellation Form</h2>
<form class="login" name="frmSample" method="post" action="cancellation.php">
<table>
<br><br>
<tr><td>Enter the Booked id</td>
<td><input type="text" name="bid" id="bid" required /><br><br></td></tr>
<tr><td>Choose booked hall</td>
<td>
<select name="hall" id="hall"> 
<option value="MCC" selected> MCC</option>
<option value="ValluvarArangam">Valluvar Arangam</option>
<option value="MechSeminar">Mech Seminar Hall</option>
<option value="ECESeminar">ECE seminar hall</option>
<option value="CivilSeminar">Civil Seminar hall</option>
<option value="Bio-tech">Bio-tech seminar hall</option>
<option value="Nano-tech">Nano-tech seminar hall</option>
</select></td>
<br><br></tr>
<tr><td>Cadre</td>
<td><select name="cadre" id="cadre"> 
<option value="Theory" selected>Theory</option>
<option value="Extra-Curricular">Extra-curricular</option>
</select><br><br></td></tr>
<tr><td>Enter the Date of the session(mm/dd/yyyy)</td>
<td><input type="text" name="date" id="date" onClick="GetDate(this);" required /><br><br></td></tr></table><br><br>
<center><input type="submit" name="Submit" id="submit" value="Submit" onclick="return ValidateForm()"></center>
</form>
</div></center>
</body>
</html>