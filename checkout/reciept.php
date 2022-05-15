<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();
if($_SESSION['reception']==1){
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
</div></div>

<center><h1>RECIEPT</h1></center>


<?php
		$id=$_GET['id'];
		$roomid=$_GET['roomid'];
		
		
		$single=$object->query("SELECT * FROM `single` WHERE `id` ='$id' ");
		$rest=$object->query("SELECT *  FROM `singleresturant` WHERE `guestid`='$id'");
		$gym=$object->query("SELECT *  FROM `singlegym` WHERE `guestid`='$id'");
		$laund=$object->query("SELECT *  FROM `singlelaundry` WHERE `guestid`='$id'");
		
?>
<center><table width="178"><tr>
<td align="center" width="12%"></td> <td width="88%"><a style="color:#000;" href="../logout.php">logout</a>  | <a href="../receptionmenu.php" style="color:#000;">Home</a></td> 
 </tr>
</table></center>

<?php $row=mysql_fetch_array($single);?>
<center>

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
if($row['checkin_date']==$object->currentDate()){
	$answer=1;
	echo "$answer Day(s)";
}else{
$answer=floor($days_diff/$oneday);
echo "$answer Day(s)";
}

?></td>
<td>Sex</td>
<td><?php echo $row['sex']; ?></td>
<td></td>
<td></td>
<td>room cost:</td>
<td><b>N<?php 
$tot=$object->getRoomCost($roomid) * $answer;

if ($tot==0){echo $row['rmcost'];}

else{
echo number_format($tot, 2);

}
?></tr>

</table></center>
</fieldset>
<center><?php
if($row['room2_id']==0){echo "There Was No Room Change";}
elseif(mysql_num_rows($single)>0){
?></center>
<fieldset class="gfield">
<legend><b>Rooms</b></legend>

<center><table border="0" width="800" cellspacing="5" class="table">
  <tr>
    <td><table border="0" width="800" cellspacing="5" class="table">
      <tr></tr>
      <tr>
        <td>RoomNumber:</td>
        <td>Room Category:</td>
        <td>Room Location</td>
        <td>RoomCost </td>
        <td>Date</td>
      </tr>
      <tr>
        <td><?php  echo $object->getRoomNumber($row['room2_id']); ?></td>
        <td><?php echo $object->getRoomCat($row['room2_id']);?></td>
        <td><?php echo $object->getRoomLocation($row['room2_id']); ?></td>
        <td>N<?php echo $object->getRoomCost($row['room2_id']);?></td>
        <td><?php echo $row['date_of_change']; ?></td>
      </tr>
      <tr>
        <td>Stay duration:</td>
        <td><?php 
$now=time();
$yourdate2=strtotime($row['date_of_change']);
$days_diff2=abs($now-$yourdate2);
$oneday2=60*60*24;
$answer2=floor($days_diff2/$oneday2);
echo "$answer2 Day(s)";
?></td>
        <td> room cost:</td>
        <td><b>N
          <?php 
$tot2=$object->getRoomCost($row['room2_id']) * $answer2;

if ($tot2==0){echo $row['rmcost'];}

else{
echo number_format($tot2, 2);

 } 
	?>
        </b></td>
               <td>Total room cost:</td>
        <td><b>N
          <?php 
		  $totl=$tot+$tot2;
echo number_format($totl, 2) ;

	?>
        </b></td>
      </tr>
    </table></td>
  </tr>
</table>
</center>


</fieldset>
<?php 
}
?><center>
<fieldset class="rfield">
<legend><b>Resturant</b></legend>

<?php
if(mysql_num_rows($rest)==0){echo "No Resturant Records";}
elseif(mysql_num_rows($rest)>0){
?>


<table width="800" border="0" cellspacing="1">
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
</table>
<?php }//ELSE IF   ?>
</fieldset>
</center><center>
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
	<td><b><?php echo  $g['num'] ?></b></td>
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
</center>

<?php
		
?>
<center>
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
    <td>guest_type</td>
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
    <td><?php echo $l['guest_type'] ;?></td>
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

<?php
		$details=$object->query("SELECT * FROM `accountbalance` WHERE `guestid`='$id'");
		while($row=mysql_fetch_array($details)){
			
			$total=$row['grand_total'];
			$initial=$row['initial_deposit'];
			$refund=$row['refund'];
			$balance=$row['balance'];
		}
?>







<fieldset>
<legend><strong>ACCOUNT</strong></legend>
<center><table width="800" border="1">
  <tr>
    <td><strong>GRAND TOTAL</strong></td>
    <td><strong>N
    <?php
echo number_format($total, 2); ?>
      </strong>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>BALANCE</strong></td>
    <td><strong>N<?php echo number_format($balance, 2) ;?></strong>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>INITIAL DEPOSIT</strong></td>
    <td><strong>N<?php echo $initial ;?></strong></td>
    <td>&nbsp;</td>
    <td><strong>REFUND</strong></td>
    <td><strong>N<?php echo number_format($refund, 2) ;?>&nbsp;</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    
    <h2 style="text-align:right">=</h2></td>
    <td><hr />
      <strong>N
    <?php
    
	$left=abs($total-$initial);
	echo number_format($left, 2); ?>
      </strong>&nbsp;</td>
    <td>&nbsp;</td>
    <td><h2 style="text-align:right">=</h2></td>
    <td><hr /><strong>N
      <?php
    
	$right=abs($balance-$refund);
	echo number_format($right, 2); ?></strong>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>N
      <?php
    
	$left=abs($total-$initial);
	echo number_format($left, 2); ?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>N
    <?php
    
	$right=abs($balance-$refund);
	echo number_format($right, 2); ?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>ACCOUNT BALANCE:</strong></td>
    <td><hr /><strong>N
    <?php
    $bal=abs($left-$right);
	echo number_format($bal, 2);?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</center>
</fieldset>


<center>
<input type="button" onclick="javascript:window.print() " value="PRINT"  />

</center>



</div>
<div id="footer">
    <?Php $object->footer($cname); ?>
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