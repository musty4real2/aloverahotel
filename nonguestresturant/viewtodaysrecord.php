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
<title>Veiw Today's outsider's resturant  Record</title>
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
  <td width="14%">&nbsp;</td>

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
  
  
  $display = 20;
  // Determine how many pages there are...
  if (isset($_GET['p']) && is_numeric($_GET
  ['p'])) { // Already been determined.
  
  $pages = $_GET['p'];
  } else { // Need to determine.
  
  // Count the number of records:
  $q = "SELECT * FROM `singleresturant`WHERE `entrydate`= CURDATE()";
  $r = mysql_query ($q);
  $records=mysql_num_rows($r);
  if(!$r){echo " could not select for pagination problem";}
  if(empty($r)){echo "the database query is empty";}
  
  
  // Calculate the number of pages...
  if ($records > $display) { // More than
  $pages = ceil ($records/$display);
  } else {
  $pages = 1;
  }
  }
  if (isset($_GET['s']) && is_numeric
  ($_GET['s'])) {
  $start = $_GET['s'];
  } else {
  $start = 0;
  }
  
  ?>
<?php

//SQL query to pull out all registered students
$fetch="SELECT * FROM `outsideresturant` WHERE `entrydate`= CURDATE()  ORDER BY `time` ASC LIMIT $start, $display ";
$fetch=@mysql_query($fetch) or die(mysql_error());
if($object->checkNumofRecord($fetch)==false){echo "<p class='msg info'>Sorry, no visitors found for resturant today!</p>";}
elseif($object->checkNumofRecord($fetch)==true){
?>

<p>Below are Today's Resturant Visitors</p>
<center><fieldset class="rfield">
<?php
if(mysql_num_rows($fetch)==0){echo "No Resturant Records";}
elseif(mysql_num_rows($fetch)>0){
?>


<table width="95%" border="1" cellspacing="1">
<tr class="thead">
<td>Guest Name</td>
<td>Date</td>
<td>Food</td>
<td>Quantity</td>
<td>Per Plate</td>
<td>Cost</td>
<td>Time</td>
<td>Waiter</td>
</tr>
<?php
		while($rows=mysql_fetch_array($fetch)){?>
        
<tr>
<td><?php echo $rows['guestname'];?></td>
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
</table>
<br/>

<table width="800" border="0" cellspacing="1">

<tr>
<td><center><p>Number of resturant visit:</p></center></td>
<td><center><b><?php echo mysql_num_rows($fetch);?></b></center></td>

<td><center>Resturant Total:</center></td>
<td><center><b><?php 

echo "<p class='orange'>".N.number_format($resturanttotal, 2)."</p>"; ?></b></center></td>
<td></td>
<td></td>
</tr> 

</td>
</table>
<?php } }//ELSE IF   ?>
</fieldset>
</center>

<br/><br/>
<?php
 
  //paginate result set
if ($pages > 1) {
echo '<center>';
$current_page = ($start/$display) + 1;

if ($current_page != 1) {
 echo '<center><a href="viewtodaysrecord.php?s=' .
($start - $display) . '&p=' . $pages .
'">Previous</a></center> ';
 }

for ($i = 1; $i <= $pages; $i++) {
 if ($i != $current_page) {
 echo '<a href="viewtodaysrecord.php?s=' .
(($display * ($i - 1))) . '&p=' .
$pages . '">' . $i . '</a> ';
 } else {
 echo $i . ' ';
}
 }

if ($current_page != $pages) {
 echo '<center><a href="viewtodaysrecord.php?s=' .
($start + $display) . '&p=' . $pages .
'">Next</a></center>';
 }

 echo '</center>';// Close the paragraph.
 
 }
 ?>
  
  
  <p>&nbsp;</p>
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
</div><!--content div-->
   <!------------------------------------------------CONTENT---------------------------------------------------------------->

<?php
}
?>

   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">
   <?Php $object->footer($cname);?>
</div><!--footer div-->
   <!------------------------------------------------FOOTER---------------------------------------------------------------->
</div>

</body>
</html>
<?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>