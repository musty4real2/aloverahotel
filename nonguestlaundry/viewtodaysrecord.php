<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();
	if($_SESSION['laundry']==1){

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Veiw Today's single laundry  Record</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
<div id="head">
                         <?php $object->head("logo");?>

    		<table width="100%">
            <tr>
            <td width="15%">			</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  |<a href="singlemenu.php"> Home</a></td> 
  <td width="14%">&nbsp;</td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
	<?php
$a=$object->query("SELECT * FROM `section` WHERE `section_name`='laundry' AND `visibility`='1' ");
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
  $q = "SELECT * FROM `outsidelaundry` WHERE `entrydate`= CURDATE() ";
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
$fetch="SELECT * FROM `outsidelaundry` WHERE `entrydate`= CURDATE()  ORDER BY `time` ASC LIMIT $start, $display ";
$fetch=@mysql_query($fetch) or die(mysql_error());
if($object->checkNumofRecord($fetch)==false){echo "<p class='msg info'>Sorry, no visitors found for laundry today!</p>";}
elseif($object->checkNumofRecord($fetch)==true){
?>

<p>Below are Today's Visitors</p>
<center><table width="800" border="1" cellspacing="1">
	<tr class="thead">
        <td>Guest id</td>
    <td>Cloth type</td>
    <td>Amount paid</td>
    <td>Cabinet number</td>
    <td>Attendant</td>
    <td>guest_type</td>
        <td>Entry Date</td>

    <td></td>
    
    </tr>
    <?php

//FETCH AND SPIT IT OUT
while($l=mysql_fetch_array($fetch)){
$bg = ($bg=='#cfebf2' ? '#f6f6f6' :
'#cfebf2'); // Switch the background
 echo "<tr bgcolor='$bg' class='trs'>";  ?>

    <td><?php $object->getGuestName($l['guestid']);?></td>

    <td><?php echo $l['cloth_type'];?></td>
    <td><?php echo "N".number_format($l['amount'], 2) ;?></td>
    <td><?php echo $l['cabinetnumber'] ;?></td>
    <td><?php echo $l['staff'] ;?></td>
    <td><?php echo $l['guest_type'] ;?></td>
        <td><?php echo $l['entrydate'] ;?></td>
  </tr>
 <?php 
 $laundrytotal+=$l['amount'];
}?>		 
</table>

<br/><br/>
<table width="800" border="0" cellspacing="1">
        <tr>
<td><center><p>Number of laundry visitor:</p></center></td>
<td><center><b><?php echo mysql_num_rows($laund);?></b></center></td>
<td><center>Laundry total:</center></td>
<td><center><b><?php echo "<p class='orange'>".N.number_format($laundrytotal, 2)."</p>" ;?></b></center></td>
<td></td>
</tr>
</table>
<?php }//ELSE IF   ?>
  </tr>
</table>
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
<?php } ?>
   <!------------------------------------------------CONTENT---------------------------------------------------------------->



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
