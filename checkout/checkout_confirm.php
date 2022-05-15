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
<title>Aministrator</title>
<link href="../css/receipt.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<div id="head">
     <?php $object->head("logo");?>

</div>
<div id="content">
<center><table width="182"><tr>
<td align="center" width="9%"></td> <td width="91%"><a style="color:#000;" href="../logout.php">logout</a>  | <a href="../receptionmenu.php" style="color:#000;">Home</a></td> 
 </tr>
 </table></center>
<?php
$bill=$object->query("SELECT `billingno` FROM `single` WHERE `id`='{$_GET['id']}'");
while($row=mysql_fetch_array($bill)){
	$billno=$row['billingno'];
	}
?>

<center><h1><?php echo $billno;?> has been checked out from the Hotel successfuly!.</h1>

<h1>Click <a href="reciept.php?id=<?php echo $_GET['id'];?>&roomid=<?php echo $_GET['roomid'];?>">here</a> to preview and print reciept</h1></center>

</div><br/><br/><br/>
<div id="footer">
    <?Php $object->footer($cname); ?>
			</div>
</div>
