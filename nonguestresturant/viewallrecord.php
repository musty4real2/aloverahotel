<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();
	if($_SESSION['resturant']==1){

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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="nonguestresmenu.php" style="color:#FFF;">Home</a></td> 

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
	<?php
$a=$object->query("SELECT * FROM `section` WHERE `section_name`='restaurant' AND `visibility`='1' ");
?>
<?php
if(mysql_num_rows($a)==0){echo "This Module Wasn't Installed";}
elseif(mysql_num_rows($a)>0){
?>
<?php

		$rest=$object->query("SELECT *  FROM `outsideresturant`");


?>
<fieldset>
<legend><b>View Record</b></legend>
<center><table width="90%" border="1" cellspacing="1">
	<tr class="thead">
    <td>S/N</td>
    <td>Guest name</td>
    <td>Entry Date</td>
    <td>Entry Time</td>
    <td>Food</td>
    <td>Plate (Qty)</td>
    <td>Per Plate</td>
    <td>Cost</td>
        <td>Waiter</td>

    <td></td>
    
    </tr>
  <?php
	$serial=1;
  	while($row=mysql_fetch_array($rest)){?>
	
      <tr class="treven">

    <td><?php echo $serial++; ?></td>
    <td><?php echo $row['guestname'];?></td>
    <td><?php echo $row['entrydate'];?></td>
    <td><?php echo $row['time'];?></td>
       <td><?php $object->getFoodname($row['food_id']);?></td>
    <td><?php echo $row['plate']; //shows number of plates ordered?></td>
 <td><?php echo $object->getFoodCost($row['food_id']);  //shows cost of the food PER PLATE?></td>
    <td>N <?php echo  $object->getFoodCost($row['food_id']) * $row['plate']; // calculate the total by multiplying the cost of one plate by the total of plates ordered  ?></td>
    <td><?php echo $row['waiter'];?></td>
  </tr>
  <?php } ?>  </table></center></fieldset>

</div><!--content div--><!------------------------------------------------CONTENT---------------------------------------------------------------->

<?php
}
?>

   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">
   <?Php $object->footer($cname);?>
</div><!--footer div-->
 </div>  <!------------------------------------------------FOOTER---------------------------------------------------------------->
</div>
</body>
</html>
<?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>