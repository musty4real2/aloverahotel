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
            <td width="15%">			
</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="edit_menu.php" style="color:#FFF;">Home</a></td> 
  <td width="14%"></td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php

if(isset($_GET['deleteid'])){
echo 'Do You Really Want To Delete Guest With ID of '.$_GET['deleteid'].'? <a href="singledelete.php?yesdelete='.$_GET['deleteid'].'">Yes </a>| <a href="singledelete.php">No</a>';
exit();

}

if(isset($_GET['yesdelete'])){
	$id_to_delete=$_GET['yesdelete'];
	$sql=mysql_query("DELETE FROM `single` WHERE `id`='$id_to_delete' limit 1") or die(mysql_error());
	
	header("location:singledelete.php");
	exit();
}
	

?>
<?php
$laund=$object->query("SELECT * FROM `single` WHERE `checkout`='0' ORDER BY 'surname' DESC");
?>
<?php
if(mysql_num_rows($laund)==0){echo "No Single Guest Record (s)";}
elseif(mysql_num_rows($laund)>0){
?>
<fieldset>
<legend><b>View All Record </b></legend>
<center><table width="98%" border="1" cellspacing="1" cellpadding="10px">
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
    <td></td>
    
    </tr>
  <?php
	$serial=1;
  	while($row=mysql_fetch_array($laund)){?>
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
<?php $id=$row['id']; ?>
<?php echo "<td><a href='vsingle_records.php?id=$id&roomid=$roomid'>View Guest Record</a></td>"; ?> 

<?php echo "<td><a href='singledelete.php?deleteid=$id'>Delete</a></td>"; ?> 
<?php echo "<td><a href='edit_single_reservation_details.php?pid=$id'>Edit</a></td>"; ?> 

  </tr>
  <?php 
	}
	} ?></table></center></fieldset></div><!--content div-->
   <!------------------------------------------------CONTENT---------------------------------------------------------------->



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