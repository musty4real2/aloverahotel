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
</div>

<?php
		$id=$_GET['id'];
		$roomid=$_GET['roomid'];
		
		
		$single=$object->query("SELECT * FROM `group` WHERE `id` ='$id' ");
		
?>

<center><table width="273"><tr>
<td align="center" width="9%"></td> <td width="91%"><a style="color:#000;" href="../logout.php">logout</a>  | <a href="../receptionmenu.php" style="color:#000;">Home</a></td> 
 </tr>
 </table></center>
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
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

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
<td></td>
<td></td>
<td></td>
<td></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table></center>
</fieldset>












<?php
if($_GET['balance']){?> <center><h1>Guest has been balanced successfuly. Account is balanced.</h1> </center> <?php } ?>

<?php
if($_GET['refund']){?><center> <h1>Guest has been Refunded successfuly. Account is balanced</h1> </center> <?php } ?>






<?php
		$id=$_GET['id'];
		$roomid=$_GET['roomid'];
		
		$details=$object->query("SELECT * FROM `groupaccountbalance` WHERE `guestid`='$id'");
		while($row=mysql_fetch_array($details)){
			
			$total=$row['grand_total'];
			$initial=$row['initial_deposit'];
			$refund=$row['refund'];
			$balance=$row['balance'];
		}
?>







<fieldset>
<legend><strong>BALANCE</strong>&nbsp;

</legend>
<table width="100%" border="1">
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

</fieldset>


<h1>
<?php $records=$object->query("SELECT * FROM `groupaccountbalance` WHERE `guestid`='$id'");
			while($row=mysql_fetch_array($records)){
			$initial=$row['initial_deposit'];
			$total=$row['grand_total'];
			$balance=$row['balance'];
			$refund=$row['refund'];
						}

			if(abs($total-$initial) - abs($balance-$refund)==0){
				echo "<center><h2><a href='checkout_guest.php?id=$id&roomid=$roomid'>PROCEED TO CHECKOUT</a></h2></center>";
				}	
			if(abs($total-$initial) - abs($balance-$refund)!=0){
				echo "<center><h2>GUEST CANNOT CHECKOUT. ACCOUNT NOT BALANCED</h2></center>";
				}	
			
			?>
</h1>




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