<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();

?>

<?php

$id=$_GET['id'];
$refund=$_GET['refund'];
$balance=$_GET['balance'];
$roomid=$_GET['roomid'];



$a=$object->query("UPDATE `accountbalance` SET `balance` = '$balance' , `refund`='$refund', `entrydate` = NOW() WHERE `guestid` ='$id'");	

header("location:balanced+account.php?id=$id&roomid=$roomid&balance=1");

?>
