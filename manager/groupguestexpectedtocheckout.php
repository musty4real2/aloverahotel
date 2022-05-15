<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();

if($_SESSION['auth']==1){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>list of group reservation guest expected to checkout today</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="admin_menu.php" style="color:#FFF;">Home</a></td> 
  <td width="14%"></td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php
$select=$object->query("SELECT * FROM `group` WHERE `checkout_date`=CURDATE() AND `checkout`='0' ORDER BY 'surname' DESC");




?>
<fieldset>
<legend><center><h4><font color="#FF0000"><p><b>List Of Group Guest Expected To Checkout Today</b></p></font></h4></center></legend>
<center><table width="90%" border="1" cellspacing="1" cellpadding="10px">
	<tr class="thead">
    <td>S/N</td>
    <td>Guest name</td>
    <td>Initial deposit</td>
    <td>Check in date</td>
        <td>Check out date</td>
    <td>Billing no</td>
    <td>Room Category</td>
    <td>Room Number</td>
    <td>Room Cost</td>
    <td>Room Location</td>
    <td></td>
    </tr>
  <?php
	$serial=1;
  	while($row=mysql_fetch_array($select)){?>
	<?php $id=$row['id'];
	$surname=$row['surname'];
	$roomid=$row['roomid'];
	?>
      <tr class="treven">

    <td><?php echo $serial++; ?></td>
    <td><?php echo $surname.", ".$row['othername'];?></td>
    <td><?php echo "N".$row['inidep']." .00" ;?></td>
    <td><?php echo $row['checkin_date'] ;?></td>
    <td><?php echo $row['checkout_date'] ;?></td>
    <td><?php echo $row['billingno'] ;?></td>
    <td><?php echo $object->getRoomCat($roomid); ?></td>
    <td><?php echo $object->getRoomNumber($roomid); ?></td>
    <td><?php echo $object->getRoomCost($roomid); ?></td>
    <td><?php echo $object->getRoomLocation($roomid); ?></td>
            <?php echo "<td><a href='single_records.php?id=$id&roomid=$roomid'>View Guest Record</a></td>"; ?> 

  </tr>
  <?php } ?></table></center></fieldset></div><!--content div-->
   <!------------------------------------------------CONTENT---------------------------------------------------------------->

<center>   <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
if (window.print) {
document.write('<form>'
+ '<input type="button" name="print" value="  Print  " '
+ 'onClick="javascript:window.print()"></form>');
}
// End -->
</SCRIPT>
</center>

   <!------------------------------------------------FOOTER---------------------------------------------------------------->


   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">

    <?Php $object->footer($cname); ?>
</div><!--footer div-->
</div>
</body>
</html>
<?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>