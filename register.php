<html>
<head>
</head>
<body bgcolor="bisque">
<?php
$connection = mysql_connect("localhost", "root", "");
$error = "";
$db = mysql_select_db("jeni", $connection);
$hname=$_POST['hall'];
$date=$_POST['date'];
$sid=$_POST['sid'];
$sname=$_POST['sname'];
$dept=$_POST['dept'];
$cadre=$_POST['cadre'];
$durn1 = $_POST['dur1'];
$durn2 = $_POST['dur2'];
$ebid = 200;$hid = 0; $tbid = 300;				
$result = mysql_query("SELECT id FROM halldetails where name='".$hname."'");
while($row1 = mysql_fetch_array($result))
		$hid = $row1[0];
if($cadre == "Extra-Curricular") // Higher preference for extra-curricular
{	   
    $result1= mysql_query("Select * from extrarecord");
	$row1 = mysql_fetch_array($result1);
	if ($row1 == false)	// NO records in the extrarecord
	{$ebid = 201;}
	else//retrieving last record to compute id
    {
	   $ebid = $row1[0];
	   while($row1 = mysql_fetch_array($result1))
	   {	if($row1 != false)
				$ebid = $row1[0];
	   }
	   $ebid = $ebid+1;	   	   
	}	
	$result7= mysql_query("Select * from extrarecord where ddate='".$date."' and hid =".$hid);//checking if the same hall is already booked on the particular date
	$row7 = mysql_fetch_array($result7);
	if($durn2 == "full")		
	{
	    if($row7 == false) // Same Hall is not booked on the particular date
		{				    
	       $val = mysql_query("insert into extrarecord(bid,hid,ddate) values(".$ebid.",".$hid.",'".$date."')");		   
	       if($val == false)
			   echo "NOt inserted";			
		   $chk1 = mysql_query("update extrarecord set full= 'BE', fore='BE',after='BE',eve='BE' where bid=".$ebid);		
		   $result2= mysql_query("Select * from theoryrecord where ddate='".$date."' and hid=".$hid);		   
		   $row2 = mysql_fetch_array($result2);
		   if($row2)
		   {
		      mysql_query("insert into bookingdetails values(".$ebid.",".$hid.",'".$sname."','".$date."','".$dept."','".$cadre."',7,".$sid.",'full','-')");  
		      $val = mysql_query("delete from bookingdetails where ddate='".$date."' and cadre='Theory' and hid=".$hid);
			   if($val == false)
			     echo "Unsuccessful del";
		       $chk1 = mysql_query("update theoryrecord set d1= 'BE',d2= 'BE',d3= 'BE',d4= 'BE',d5='BE',d6='BE',d7='BE' where ddate='".$date."'");			       
			  echo "The hall has been booked successfully. The booked id is".$ebid." . Use it for future access"; 
		   }
		}
		else//Same Hall is booked on the particular date
		{
		    if($row7[2] == 'BE')
				echo "Sorry !! The hall is already booked for full day" ;
			if($row7[3] == 'BE' && $row7[4] == 'BE')
			    echo "Sorry !! The hall is already booked for both morning and afternoon sessions" ;
			else if($row7[3] == 'BE')
				echo "Sorry !! The hall is already booked for fore noon session" ;
			else if($row7[4] == 'BE')
				echo "Sorry !! The hall is already booked for after noon session" ;
		}
	}    		
	else
	{	
	   if($row7 == false)//Hall is not booked on the same date
	   {
	    $val = mysql_query("insert into extrarecord(bid,hid,ddate) values(".$ebid.",".$hid.",'".$date."')");		
		$chk1 = mysql_query("update extrarecord set ".$durn2."= 'BE' where ddate='".$date."' and hid=".$hid);			
		if($chk1 == 0)
		   echo "Updation unsuccess";		
		mysql_query("insert into bookingdetails values(".$ebid.",".$hid.",'".$sname."','".$date."','".$dept."','".$cadre."',4,".$sid.",'".$durn2."','-')");  
		$result2= mysql_query("Select * from theoryrecord where ddate='".$date."' and hid=".$hid);
		$row2 = mysql_fetch_array($result2);
		if($row2)//To cancel any theory sessions if booked on the same date for the same hall
		{
			$val = mysql_query("delete from bookingdetails where ddate='".$date."' and cadre='Theory' and hid=".$hid);
				if($durn2 == "fore")
				{		
					$chk1 = mysql_query("update theoryrecord set d1= 'BE',d2= 'BE',d3= 'BE',d4= 'BE' where ddate='".$date."' and hid=".$hid);						
				}			  			  		
				else if($durn2 == "after")
				{		    
					$chk1 = mysql_query("update theoryrecord set d7= 'BE',d5= 'BE',d6= 'BE' where ddate='".$date."' and hid=".$hid);						
				}			  			  
		}
		echo "The hall has been booked successfully. The booked id is".$ebid." . Use it for future access" ;
      }
      else //Hall is booked on the same date
      {
	    if($row7[2] == 'BE')
			echo "Sorry !! The hall is already booked for full day" ;
		if($row7[3] == 'BE' && $row7[4] == 'BE')
			    echo "Sorry !! The hall is already booked for both morning and afternoon sessions" ;
		else if($row7[3] == 'BE')
		    echo "Sorry !! The hall is already booked for fore noon session" ;
		else if($row7[4] == 'BE')
			echo "Sorry !! The hall is already booked for after noon session" ;
	  }	  
	}	   	   	
}
else//For theory
{
    $result1= mysql_query("Select * from extrarecord where ddate='".$date."' and hid=".$hid);
	$row1 = mysql_fetch_array($result1);$cnt = count($durn1);
	if ($row1 == false)	//NO extrarecord entry on that date for that hall
	{
	   $result1= mysql_query("Select * from theoryrecord");//NO records found in the theoryrecord table
	   $row1 = mysql_fetch_array($result1);
	   if($row1 == false)//1st record into  theoryrecord table	
	   {  $val = mysql_query("insert into theoryrecord(bid,hid,ddate) values(301,".$hid.",'".$date."')");	      
		  if($cnt == 1)
		  {$chk1 = mysql_query("update theoryrecord set ".$durn1[0]."='BT' where ddate='".$date."'");	
		  mysql_query("insert into bookingdetails values(301,".$hid.",'".$sname."','".$date."','".$dept."','".$cadre."',".$cnt.",".$sid.",'".$durn1[0]."','-')");  			}
		  else
		{$chk1 = mysql_query("update theoryrecord set ".$durn1[0]."='BT', ".$durn1[1]."='BT' where ddate='".$date."'");	
		mysql_query("insert into bookingdetails values(301,".$hid.",'".$sname."','".$date."','".$dept."','".$cadre."',".$cnt.",".$sid.",'".$durn1[0]."','".$durn1[1]."')");  	}		  
          echo "The hall has been booked successfully. The booked id is".$tbid." . Use it for future access" ;		  
	   }
	   else //other records into  theoryrecord table
	  {
	    $row2= true;$row3 = true;
	    if($cnt == 2)
		{	$result2= mysql_query("Select ".$durn1[0].", ".$durn1[1]." from theoryrecord where ddate='".$date."' and hid=".$hid);//check if already a record is in that table with the same date
		    $row2 = mysql_fetch_array($result2);
		}
		else 
		{$result3= mysql_query("Select ".$durn1[0]." from theoryrecord where ddate='".$date."' and hid=".$hid);//check if already a record is in that table with the same date
	  	$row3 = mysql_fetch_array($result3);
		}
		if($row2 == false || $row3 == false)//If no record is in the theoryrecord table with that date for that hall
		{
		    $result3= mysql_query("Select * from theoryrecord");//taking last record to compute  new id
		    while($row3 = mysql_fetch_array($result3))			
			   $tbid = $row3[0];
			$tbid = $tbid+1;
			$val = mysql_query("insert into theoryrecord(bid,hid,ddate) values(".$tbid.",".$hid.",'".$date."')");
			$cnt = count($durn1);
		  if($cnt == 1)
		  {$chk1 = mysql_query("update theoryrecord set ".$durn1[0]."='BT' where bid=".$tbid);
		   mysql_query("insert into bookingdetails values(".$tbid.",".$hid.",'".$sname."','".$date."','".$dept."','".$cadre."',".$cnt.",".$sid.",'".$durn1[0]."','-')");  
		  }
		  else
		  {
			$chk1 = mysql_query("update theoryrecord set ".$durn1[0]."='BT',".$durn1[1]."='BT' where bid=".$tbid);
			mysql_query("insert into bookingdetails values(".$tbid.",".$hid.",'".$sname."','".$date."','".$dept."','".$cadre."',".$cnt.",".$sid.",'".$durn1[0]."','".$durn1[1]."')");  
		  }		  
		  echo "The hall has been booked successfully. The booked id is".$tbid." . Use it for future access" ;
		}	    
		else//Already a Record is in theoryrecord table with the same date for the same seminar hall
		{
		    $result6 = mysql_query("select bid from theoryrecord where ddate='".$date."' and hid=".$hid);
			$row6 = mysql_fetch_array($result6);
			$tbid = $row6[0];
		    if($cnt == 2)
			{
			   if($row2[0] == 'A' && $row2[1] == 'A')
			   {   $chk1 = mysql_query("update theoryrecord set ".$durn1[0]."='BT',".$durn1[1]."='BT' where bid=".$tbid);	
                mysql_query("insert into bookingdetails values(".$tbid.",".$hid.",'".$sname."','".$date."','".$dept."','".$cadre."',".$cnt.",".$sid.",'".$durn1[0]."','".$durn1[1]."')");  }
				if($row2[0] != 'A')				
				    echo "Sorry!! Your first choice is already booked. Please choose some other";									
				if($row2[1] != 'A')				
				    echo "Sorry!! Your second choice is already booked";									
			}
			else
			{
			   if($row3[0] == 'A')
			   {    
			   $chk1 = mysql_query("update theoryrecord set ".$durn1[0]."='BT' where ddate='".$date."' and hid=".$hid);	  mysql_query("insert into bookingdetails values(".$tbid.",".$hid.",'".$sname."','".$date."','".$dept."','".$cadre."',".$cnt.",".$sid.",'".$durn1[0]."','-')");  
			   }
			   else			 
			      echo "Sorry!! The session is already booked. Please choose some other";			  
			}			
		    echo "The hall has been booked successfully. The booked id is".$ebid." . Use it for future access" ;
		}
	  }
	}
	else//Extra curricular entry is there for that particular date for the same hall
    {	    
		$row2= true;$row3 = true; $flag1 = false;$flag2 = false;
		if($row1[2] == 'BE')//Full day booked
            echo "Sorry the full day session has been booked already.Your session cannot be booked"	;
        if($row1[3] == 'BE')//Fore noon  session already booked
		{
		    if($cnt == 2)
		    {
			    if(($durn1[0] == 'd1' || $durn1[0] == 'd2'||$durn1[0] == 'd3'||$durn1[0] == 'd4') && ($durn1[1] == 'd1' || $durn1[1] == 'd2'||$durn1[1] == 'd3'||$durn1[1] == 'd4'))
                    echo "Sorry morning session has been booked for extra-curricular"	;
			    else if($durn1[0] == 'd1' || $durn1[0] == 'd2'||$durn1[0] == 'd3'||$durn1[0] == 'd4')
				    echo "Sorry !! Your first session cannot be booked";
				else if($durn1[1] == 'd1' || $durn1[1] == 'd2'||$durn1[1] == 'd3'||$durn1[1] == 'd4')
				    echo "Sorry !! Your second session cannot be booked";
		    }
			else
			{
			    if($durn1[0]== 'd1' || $durn1[0] == 'd2'||$durn1[0] == 'd3'||$durn1[0] == 'd4')
				    echo "Sorry morning session has been booked for extra-curricular"	;
			}			
		}
		else //Allowing forenoon sessions to be booked				  
		{  
		    if($cnt == 2)
			{
		       if(($durn1[0] == 'd1'||$durn1[0] == 'd2'||$durn1[0] == 'd3'||$durn1[0] == 'd4')&&$durn1[1] == 'd1'||$durn1[1] == 'd2'||$durn1[1] == 'd3'||$durn1[1] == 'd4')
          		     $flag1 = true;  			   			   			    	
			}
			else if($cnt == 1)
			{
			    if($durn1[0] == 'd1'||$durn1[0] == 'd2'||$durn1[0] == 'd3'||$durn1[0] == 'd4')
				    $flag1 = true;  			   			   			    	
			}
			else 
			    $flag1 = false;
		}
		if($row1[4] == 'BE')//Afternoon session already booked
		{
			if($cnt == 2)
		    {
			    if(($durn1[0] == 'd5' || $durn1[0] == 'd6'||$durn1[0] == 'd7') && ($durn1[1] == 'd5' || $durn1[1] == 'd6'||$durn1[1] == 'd7'))
                    echo "Sorry afternoon session has been booked for extra-curricular"	;
			    else if($durn1[0] == 'd5' || $durn1[0] == 'd6'||$durn1[0] == 'd7')
				    echo "Sorry !! Your first session cannot be booked";
				else if($durn1[1] == 'd5' || $durn1[1] == 'd6'||$durn1[1] == 'd7')
				    echo "Sorry !! Your second session cannot be booked";
		    }
			else
			{
			    if($durn1[0]== 'd5' || $durn1[0] == 'd6'||$durn1[0] == 'd7')
				    echo "Sorry afternoon session has been booked for extra-curricular"	;
		    }	
		}
		else//Allowing afternoon sessions to be booked		
		{  if($cnt == 2)
			{
		       if(($durn1[0] == 'd5'||$durn1[0] == 'd6'||$durn1[0] == 'd7')&&($durn1[1] == 'd5'||$durn1[1] == 'd6'||$durn1[1] == 'd7'))
          		     $flag2 = true;  			   			   			    	
			}
			else if($cnt == 1)
			{
			    if($durn1[0] == 'd5'||$durn1[0] == 'd6'||$durn1[0] == 'd7')
				    $flag2 = true;  			   			   			    	
			}
			else 
			    $flag2 = false;
		} 
        if($flag1 == true || $flag2==true)		   
		{		  
			if($cnt == 2)
			{
			   $result2= mysql_query("Select ".$durn1[0].", ".$durn1[1]." from theoryrecord where ddate='".$date."' and hid=".$hid);//check if already a record is in that table with the same date
		       $row2 = mysql_fetch_array($result2);			   
			}
			else
			{
			   $result3= mysql_query("Select ".$durn1[0]." from theoryrecord where ddate='".$date."' and hid=".$hid);//check if already a record is in that table with the same date
	  	       $row3 = mysql_fetch_array($result3);			   
			}
			if($row2 == false || $row3 == false)//If no record is in the theoryrecord table with that date for the same hall
		 {		    
		    $result3= mysql_query("Select * from theoryrecord");//taking last record to compute  new id
		    while($row3 = mysql_fetch_array($result3))			
			   $tbid = $row3[0];
			$tbid = $tbid+1;
			$val = mysql_query("insert into theoryrecord(bid,hid,ddate) values(".$tbid.",".$hid.",'".$date."')");
			$cnt = count($durn1);
		  if($cnt == 1)
		  {$chk1 = mysql_query("update theoryrecord set ".$durn1[0]."='BT' where bid=".$tbid);
		   mysql_query("insert into bookingdetails values(".$tbid.",".$hid.",'".$sname."','".$date."','".$dept."','".$cadre."',".$cnt.",".$sid.",'".$durn1[0]."','-')");  
		  }
		  else
		  {
			$chk1 = mysql_query("update theoryrecord set ".$durn1[0]."='BT',".$durn1[1]."='BT' where bid=".$tbid);
			mysql_query("insert into bookingdetails values(".$tbid.",".$hid.",'".$sname."','".$date."','".$dept."','".$cadre."',".$cnt.",".$sid.",'".$durn1[0]."','".$durn1[1]."')");  
		  }
		  if($chk1 == 0)
			echo "Updation unsuccess";
		  echo "The hall has been booked successfully. The booked id is".$tbid." . Use it for future access" ;
		}	    
		else//Already a Record is in theoryrecord table with the same date for the same hall
		{		   
		    $result6 = mysql_query("select bid from theoryrecord where ddate='".$date."' and hid=".$hid);
			$row6 = mysql_fetch_array($result6);
			$tbid = $row6[0];
		    if($cnt == 2)
			{
			   if($row2[0] == 'A' && $row2[1] == 'A')
			   {   $chk1 = mysql_query("update theoryrecord set ".$durn1[0]."='BT',".$durn1[1]."='BT' where ddate='".$date."' and hid=".$hid);				        
                mysql_query("insert into bookingdetails values(".$tbid.",".$hid.",'".$sname."','".$date."','".$dept."','".$cadre."',".$cnt.",".$sid.",'".$durn1[0]."','".$durn1[1]."')");  }
				if($row2[0] != 'A')				
				    echo "Sorry!! Your first choice is already booked. Please choose some other";									
				if($row2[1] != 'A')				
				    echo "Sorry!! Your second choice is already booked";									
			}
			else
			{
			   if($row3[0] == 'A')
			   {    $chk1 = mysql_query("update theoryrecord set ".$durn1[0]."='BT' where ddate='".$date."' and hid=".$hid);	      
			       mysql_query("insert into bookingdetails values(".$tbid.",".$hid.",'".$sname."','".$date."','".$dept."','".$cadre."',".$cnt.",".$sid.",'".$durn1[0]."','-')");  
			   }
			   else			 			      
			      echo "Sorry!! The session is already booked. Please choose some other";			  
			}			
		    echo "The hall has been booked successfully .The booked id is".$tbid." . Use it for future access" ;
		}
		}
	}       	
}
?>
</body>
</html>