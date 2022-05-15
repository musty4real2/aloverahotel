<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>view all guest record</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
               <?php $object->head("logo");?>


    		<table width="100%">
            <tr>
            <td width="15%">&nbsp;</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="../groupmenu1.php" style="color:#FFF;">Home</a></td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">

<?php
$laund=$object->query("SELECT *  FROM `group` WHERE `checkout`='0'");
?>
<legend><b>Group Guest Record</b></legend><br/>
<br/>
<?php
if(mysql_num_rows($laund)==0){echo "No Group Guest Record (s)";}
elseif(mysql_num_rows($laund)>0){
?>
<table width="100%" border="1" cellspacing="1" cellpadding="10px">
	<tr class="thead">
<td>GUEST ID</td>
<td>NAME</td>
<td>OCCUPATION</td>
<td>ARRIVE FROM</td>
<td>NEXT DESTINATION</td>
<td>CHECK IN TIME</td>
<td>CHECK IN DATE</td>
<td>INITIAL DEPOSIT</td>
<td>BILLING NUMBER</td>
<td>PHONE NUMBER</td>
<td>RECEPTIONIST</td>
<td>ROOM NUMBER</td>
<td>ROOM CATEGORY</td>
<td>ROOM LOCATION</td>
</tr>
  <?php

  	while($row=mysql_fetch_array($laund)){
	?>
          <tr class="treven">

    <td><?php echo $row['id'];?></td>
<?php $id=$row['id']; 
$roomid=$row['roomid'];
?>
<td><?php echo $row['title'] ." ". $row['surname'] .", ". $row['othername'];?></td>
<td><?php echo $row['occupation'];?></td>
<td><?php echo $row['arrive_from'];?></td>
<td><?php echo $row['next_destination'];?></td>
<td><?php echo $row['checkin_time'];?></td>
<td><?php echo $row['checkin_date'];?></td>
<td><?php echo $row['inidep'];?></td>
<td><?php echo $row['billingno'];?></td>
<td><?php echo $row['phonenumber'];?></td>
<td><?php echo $row['receptionist'];?></td>
<td><?php echo $object->getRoomNumber($row['roomid']);?></td>
<td><?php echo $object->getRoomCat($row['roomid']);?></td>
<td><?php echo $object->getRoomLocation($row['roomid']);?></td>
		<?php echo "<td><a href='single_records.php?id=$id&roomid=$roomid'>View Guest Record</a></td>"; ?> 
</tr>

 <?php 
 $laundrytotal+=$row['inidep'];
}?>		 
</table>

<br/><br/>
<table width="800" border="0" cellspacing="1">
        <tr>
<td><center><p>Number of group reservation(s):</p></center></td>
<td><center><b><?php echo mysql_num_rows($laund);?></b></center></td>
<td><center>Group Reservation total:</center></td>
<td><center><b><?php echo "<p class='orange'>".N.number_format($laundrytotal, 2)."</p>" ;?></b></center></td>
<td></td>
</tr>
</table>
<?php }//ELSE IF   ?>
</table></center></fieldset></div>
<div id="footer">
<?Php $object->footer($cname); ?>
</div>
</div>
</body>
</html>