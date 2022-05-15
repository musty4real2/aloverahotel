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
<div id="head">     <?php $object->head("logo");?>

</div>
<div id="content">
<center><table width="168"><tr>
<td align="center" width="9%"></td> <td width="91%"><a style="color:#000;" href="../logout.php">logout</a>  | <a href="../receptionmenu.php" style="color:#000;">Home</a></td> 
 </tr>
 </table></center>
<center><h3><p>Click the Button Below To Checkout Guest.</p></h3></center>

<center><form action="checkout.php" method="get">
<input type="submit" onclick="return confirm('Do you really want to checkout Guest?')" value="CHECKOUT GUEST"/>
<input type="hidden" value="<?php echo $_GET['id']; ?>"  name="id" />
<input type="hidden" value="<?php echo $_GET['roomid']; ?>"  name="roomid" />
</form></center>



</div>
<br/><br/><br/>
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
