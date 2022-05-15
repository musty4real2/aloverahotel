<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();



//update checkout field in aingle table
$update=$object->query("UPDATE `single` SET `checkout`='1' WHERE `id`='{$_GET['id']}'");

//update room availability field in the rooms talbe
$update=$object->query("UPDATE `rooms` SET `room_availability`='0' WHERE `id`='{$_GET['roomid']}'");


//update checkout field in restaurant table
$update=$object->query("UPDATE `singleresturant` SET `checkout`='1' WHERE `guestid`='{$_GET['id']}'");
//update account balance table 
$update=$object->query("UPDATE `accountbalance` SET `checkout`='1' WHERE `guestid`='{$_GET['id']}'");

//update checkout field in gym tablee

$update=$object->query("UPDATE `singlegym` SET `checkout`='1' WHERE `guestid`='{$_GET['id']}'");
//update checkout field in laundry table

$update=$object->query("UPDATE `singlelaundry` SET `checkout`='1' WHERE `guestid`='{$_GET['id']}'");






//INSERT into single history table
//get chekin date first
$checkin=$object->query("SELECT `checkin_date` FROM `single` WHERE `id`='{$_GET['id']}'");
while($row=mysql_fetch_array($checkin)){
	$checkin_date=$row['checkin_date'];
	}
	
	//INSERT
	$object->query("INSERT INTO `single_history` (`guestid`, `date_in`, `date_out`, `staff`) VALUES ('{$_GET['id']}', '$checkin_date', NOW(), '')");
	
	
	
	//redirect to confimation
	header("location:checkout_confirm.php?id={$_GET['id']}&roomid={$_GET['roomid']}&checkout=1");

?>