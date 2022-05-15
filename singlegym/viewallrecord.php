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

		$rest=$object->query("SELECT *  FROM `singlegym`");


?>
<fieldset>
<legend><b>View Record</b></legend>
<center><table width="800" border="1" cellspacing="1">
<tr class="thead">
<td>Guest Name</td>
<td>Date of Entry</td>
<td>Time</td>
<td>No. of Guest's</td>
<td>Cost</td>
<td>Attendant's Name</td>
<td></td>
</tr>
  <?php
	$serial=1;
  	while($rows=mysql_fetch_array($rest)){?>
	
      <tr class="treven">
<td><center><?php $object->getGuestName($rows['guestid']);?></center></td>
			<td><center><?php echo $rows['entrydate'];?></center></td>
<td><center><b><?php echo $rows['time'];?></b></center></td>
				<td><center><?php echo $rows['num']; ?></center></td>
		<td><center>N<?php echo $rows['cost'];?></center></td>
		<td>
        <center><?php echo $rows['attendant']; ?></center>
        </td>

<?php 		$t=$object->query("SELECT `roomid`  FROM `single` WHERE `id`='{$rows['guestid']}'");
  	while($room=mysql_fetch_array($t)){
		$roomid=$room['roomid'];
	}
	?>
<td><?php echo "<a href='single_records.php?id={$rows['guestid']}&roomid=$roomid'>View Guest Record</a>"; ?> </td>   </tr>
  </tr>
     <?php
}
?> 
 <?php } ?>

</div><!--content div-->
<!------------------------------------------------CONTENT---------------------------------------------------------------->



   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">
   <?Php $object->footer($cname);?>
</div><!--footer div-->
   <!------------------------------------------------FOOTER---------------------------------------------------------------->
</div>
</body>
</html>
<?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>