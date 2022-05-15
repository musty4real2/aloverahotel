<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();
	if($_SESSION['laundry']==1){

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>view all guest record</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <div id="wrapper">
	 <div id="head">
               <?php $object->head("logo");?>


    		<table width="100%">
            <tr>
            <td width="15%">			
</td>
<td width="50%">&nbsp;</td>
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="groupmenu.php" style="color:#FFF;">Home</a></td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php
$a=$object->query("SELECT * FROM `section` WHERE `section_name`='laundry' AND `visibility`='1' ");
?>
<?php
if(mysql_num_rows($a)==0){echo "This Module Wasn't Installed";}
elseif(mysql_num_rows($a)>0){
?>
<?php
$laund=$object->query("SELECT * FROM `grouplaundry` WHERE `checkout`='0'");
?>
<legend><b>View Laundry Record</b></legend>
<?php
if(mysql_num_rows($laund)==0){echo "No laundry Records";}
elseif(mysql_num_rows($laund)>0){
?>
<center><table width="95%" border="1" cellspacing="1">
	<tr class="thead">
        <td>Guest id</td>
    <td>Cloth type</td>
    <td>Amount paid</td>
    <td>Cabinet number</td>
    <td>Attendant</td>
        <td>Entry Date</td>

    <td></td>
    
    </tr>
  <?php

  	while($l=mysql_fetch_array($laund)){
	echo "<tr class= \"trodd\">";
	?>
    <td><?php $object->getGuestName2($l['guestid']); ?></td>

    <td><?php echo $l['cloth_type'];?></td>
    <td><?php echo "N".number_format($l['amount'], 2) ;?></td>
    <td><?php echo $l['cabinetnumber'] ;?></td>
    <td><?php echo $l['staff'] ;?></td>
        <td><?php echo $l['entrydate'] ;?></td>
  
  <?php 		$t=$object->query("SELECT `roomid`  FROM `group` WHERE `id`='{$l['guestid']}'");
  	while($room=mysql_fetch_array($t)){
		$roomid=$room['roomid'];
	}
	?>
<td><?php echo "<a href='single_records.php?id={$l['guestid']}&roomid=$roomid'>View Guest Record</a>"; ?> </td>   </tr>
</tr>
 <?php 
 $laundrytotal+=$l['amount'];
}?>		 
</table>

<br/><br/>
<table width="800" border="0" cellspacing="1">
        <tr>
<td><center><p>Number of laundry visitor:</p></center></td>
<td><center><b><?php echo mysql_num_rows($laund);?></b></center></td>
<td><center>Laundry total:</center></td>
<td><center><b><?php echo "<p class='orange'>".N.number_format($laundrytotal, 2)."</p>" ;?></b></center></td>
<td></td>
</tr>
</table>
<?php }//ELSE IF   ?>
  </tr>
</table>
</center>
<?php
}
?>
</div>
</div>
</body>
</html>

<?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>