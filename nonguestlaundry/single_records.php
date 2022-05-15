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
<title>Aministrator</title>
<link href="../css/receipt.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<div id="head">
                         <?php $object->head("logo");?>

</div>
<?php
		$id=$_GET['id'];
		$roomid=$_GET['roomid'];
		
		$single=$object->query("SELECT * FROM `single` WHERE `id` ='$id' ");

		
		
        
		$rest=$object->query("SELECT *  FROM `singleresturant` WHERE `guestid`='$id'");
	
	
		$gym=$object->query("SELECT *  FROM `singlegym` WHERE `guestid`='$id'");

		$laund=$object->query("SELECT *  FROM `singlelaundry` WHERE `guestid`='$id'");
		
?>


<?php $row=mysql_fetch_array($single);?>

<fieldset class="gfield">
<legend><b>Reservation</b></legend>

<center><table border="0" width="800" cellspacing="5" class="table">

<tr>
<tr>

        <td>Guest ID:</td>
<td><b><?php echo $row['id'];?></b></td>
<td>Billing no:</td>
<td><b><?php echo $row['billingno'];?></b></td>
<td>Reciept no:</td>
<td><b><?php echo $row['id'];?></b></td>
<td>Time:</td>
<td><b><?php echo date('H:i:s');?></b></td>
</tr>

<tr>
<td>Guest name:</td>
<td><b><?php 
$name=$row['surname'].", " .$row['othername'];
echo $name;?></b></td>
<td>Check in Date:</td>
<td><b><?php 
$checkin_date=$row['checkin_date'];
echo $checkin_date;?></b></td>
<td>Check in Time:</td>
<td><b><?php echo $row['checkin_time'];?></b> </td>
<td>Receptionist:</td>
<td><b><?php echo $row['receptionist'];?></b></td>

</tr>
<tr>

<td>Room category:</td>
<td><b><?php 
echo $object->getRoomCat($roomid);?></b></td>
<td>Today's date:</td>
<td><b><?php $todays=date('D, d M Y');
echo $todays; ?></b></td>
<td>Room cost per day: </td>
<td><b>N<?php echo $object->getRoomCost($roomid);?></b></td>
<td>Initial deposit</td>
<td><b>N<?php $ini=$row['inidep'];
echo number_format($ini, 2);?></b></td>

</tr>

<tr>
<td>Stay duration:</td>
<td><?php 
$now=time();
$yourdate=strtotime($row['checkin_date']);
$days_diff=abs($now-$yourdate);
$oneday=60*60*24;
$answer=floor($days_diff/$oneday);
echo "$answer Day(s)";
?></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>Total room cost:</td>
<td><b>N<?php 
$tot=$object->getRoomCost($roomid) * $answer;

if ($tot==0){echo $row['rmcost'];}
else{
echo number_format($tot, 2);?> </b></td>
</tr>
<?php } 
	?>
</table></center>
</fieldset>

<fieldset class="rfield">
<legend><b>Resturant</b></legend>

<?php
if(mysql_num_rows($rest)==0){echo "No Resturant Records";}
elseif(mysql_num_rows($rest)>0){
?>


<center><table width="800" border="0" cellspacing="1">
<tr class="thead">
<td>Date</td>
<td>Food</td>
<td>Quantity</td>
<td>Per Plate</td>
<td>Cost</td>
<td>Time</td>
<td>Waiter</td>
</tr>
<?php
		while($rows=mysql_fetch_array($rest)){?>
        
<tr>
			<td><?php echo $rows['entrydate'];?></td>
<td><b><?php $object->getFoodname($rows['food_id']);?></b></td>
				<td><?php echo $rows['plate']; ?></td>
		<td>N<?php echo $object->getFoodCost($rows['food_id']);?></td>
		<td>
        N<?php $t=$object->getFoodCost($rows['food_id']) * $rows['plate'];
        echo $t;?>
        </td>
		<td><?php echo $rows['time'];?></td>
		<td><b><?php echo $rows['waiter'];?></b></td>
</tr>
<?php 
$resturanttotal+=$t;
}
?>
<tr>
<td><center><p>Number of resturant visit:</p></center></td>
<td><center><b><?php echo mysql_num_rows($rest);?></b></center></td>

<td><center>Resturant Total:</center></td>
<td><center><b>N<?php 

echo "<p class='orange'>".number_format($resturanttotal, 2)."</p>"; ?></b></center></td>
<td></td>
<td></td>
</tr> 

</td>
</table></center>
<?php }//ELSE IF   ?>
</fieldset>

<fieldset class="gfield">
<legend><b>gymnassium</b></legend>
<?php
if(mysql_num_rows($gym)==0){echo "No gymnassium Records";}
elseif(mysql_num_rows($gym)>0){
?>
<center><table width="800" border="0" cellspacing="1">    
<tr class="thead">
<td>Date</td>
<td>Number of guest</td>
<td>Time</td>
<td>Cost</td>
<td>Attendant</td>
</tr>
<?php 
		while($g=mysql_fetch_array($gym)){
			?>
	<tr class= \"trodd\">
			<td><?php  echo $g['entrydate']; ?></td>
	<td><b><?php echo  $g['num'] ?></td>
		<td><?php  echo $g['time']; ?></td>	
			<td>N<?php  echo  number_format($g['cost'], 2); ?></td>
		<td><b><?php  echo  $g['attendant']; ?></b></td>
</tr>
<?php 
$gymtotal+=$g['cost'];
		}?>
<tr>
<td><center><p>Number of gym visit:</p></center></td>
<td><center><b><?php echo mysql_num_rows($gym);?></b></center></td>
<td><center>Gym total:</center></td>
<td><center><b>N<?php 
echo "<p class='orange'>".number_format($gymtotal, 2)."</p>" ;?></b></center></td>
<td></td>

</tr>
</table></center>
<?php }//ELSE IF   ?>

</fieldset>
<?php
		
?>

<fieldset class="gfield">
<legend><b>Laundry</b></legend>
<?php
if(mysql_num_rows($laund)==0){echo "No laundry Records";}
elseif(mysql_num_rows($laund)>0){
?>
<center><table width="800" border="0" cellspacing="1">
	<tr class="thead">
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

    <td><?php echo $l['cloth_type'];?></td>
    <td>N<?php echo "N".number_format($l['amount'], 2) ;?></td>
    <td><?php echo $l['cabinetnumber'] ;?></td>
    <td><?php echo $l['staff'] ;?></td>
        <td><?php echo $l['entrydate'] ;?></td>
  </tr>
 <?php 
 $laundrytotal+=$l['amount'];
		}?>
<tr>
<td><center><p>Number of laundry visit:</p></center></td>
<td><center><b><?php echo mysql_num_rows($laund);?></b></center></td>
<td><center>Laundry total:</center></td>
<td><center><b>N<?php 
echo "<p class='orange'>".number_format($laundrytotal, 2)."</p>" ;?></b></center></td>
<td></td>
</tr>
</table>
<?php }//ELSE IF   ?>
</center>
</fieldset>

<fieldset>
<legend><b>Total</b></legend>
<center><table border="0" width="700">
<tr>


<td>Grand Total:</td>
<td><center><b>N<?php $grandtotal= $tot + $resturanttotal + $laundrytotal + $gymtotal;
echo number_format($grandtotal, 2); ?></b></center></td>


<td>Balance:</td>
<td>
<center><b>N
<?php 
$balance=abs($grandtotal-$ini);
if($ini>=$grandtotal){echo "0.00"; }

elseif($ini<$grandtotal){
echo number_format($balance, 2);
}
?>
</td>



<td>Refund</td>
<td><?php
//check if initial deposit is greater than current grandtotal
if($ini>$grandtotal){
	$refund=$ini-$grandtotal;
	echo number_format($refund, 2);?>
  <?php
	}
if($ini==$grandtotal){
	echo "N0.00";
	}

if($grandtotal>$ini){
	echo "N0.00";
	}
?>
</td>
</tr>
<tr><td></td><td></td></tr>
</table>
</center>
</fieldset>



</div>

<div id="footer">
   <?Php $object->footer($cname);?>			</div>
</body>
</html>
<?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>
