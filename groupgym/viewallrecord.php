<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();
	if($_SESSION['gym']==1){
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="gymmenu1.php" style="color:#FFF;">Home</a></td>

 </tr>

 </table>
 

 </div>
<!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php
$a=$object->query("SELECT * FROM `section` WHERE `section_name`='gym' AND `visibility`='1' ");
?>
<?php
if(mysql_num_rows($a)==0){echo "This Module Wasn't Installed";}
elseif(mysql_num_rows($a)>0){
?>
<?php
$laund=$object->query("SELECT *  FROM `groupgym`");

?>
<legend><b>View Group Gym Record</b></legend>
<?php
$sn=1;
if(mysql_num_rows($laund)==0){echo "No Gym Records";}
elseif(mysql_num_rows($laund)>0){
?>
<center><table width="800" border="1" cellspacing="1">
	<tr class="thead">
    <td>S/n</td>
        <td>Guest Name</td>
    <td>Cost</td>
    <td>Entry Time</td>
    <td>Attendant</td>
    <td>Entry Date</td>

    <td></td>
    
    </tr>

  <?php

  	while($l=mysql_fetch_array($laund)){
	echo "<tr class= \"trodd\">";
	?>
    	<?php $id=$l['id']; ?>
<td><?php echo $sn++; ?></td>
    <td><center><?php $object->getGuestName2($l['guestid']);?></center></td>
    <td><center><?php echo "N".number_format($l['cost'], 2) ;?></center></td>
    <td><center><?php echo $l['time'] ;?></center></td>
    <td><center><?php echo $l['entrydate'] ;?></center></td>
    <td><center><?php echo $l['attendant'] ;?></center></td>
<?php 		$t=$object->query("SELECT `roomid`  FROM `group` WHERE `id`='{$l['guestid']}'");
  	while($room=mysql_fetch_array($t)){
		$roomid=$room['roomid'];
	}
	?>
<td><center><?php echo "<a href='single_records.php?id={$l['guestid']}&roomid=$roomid'>View Guest Record</a>"; ?></center> </td>   </tr>
 <?php 
 $laundrytotal+=$l['cost'];
}?>		 
</table></center>

<br/><br/>
<center><table width="800" border="0" cellspacing="1">
        <tr>
<td><center><p>Number of Gym visit(s):</p></center></td>
<td><center><b><?php echo mysql_num_rows($laund);?></b></center></td>
<td><center> total:</center></td>
<td><center><b><?php echo "<p class='orange'>".N.number_format($laundrytotal, 2)."</p>" ;?></b></center></td>
<td></td>
</tr>
</table></center>
<?php }//ELSE IF   ?>
  </div>
  
  <?php
}
?>
 </div>

</body>
</html>

<?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>