<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();

include("../connect.php");
include("../class.php");
$object=new hms;
if($_SESSION['auth']==1){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Today's State Security Services Report</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
          <?php $object->head("logo");?>
    		<table width="100%">
            <tr>
            <td width="15%" height="54">&nbsp;</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#fff;" href="../logout.php">logout</a>  | <a href="admin_menu.php" style="color:#fff;">Home</a></td> 


 </tr>

 </table>
 <br/><br/><br/><br/>

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->

  <?php
  
  
  $display = 20;
  // Determine how many pages there are...
  if (isset($_GET['p']) && is_numeric($_GET
  ['p'])) { // Already been determined.
  
  $pages = $_GET['p'];
  } else { // Need to determine.
  
  // Count the number of records:
  $q = "SELECT * FROM `single`WHERE `checkin_date`= CURDATE() ";
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
  
  ?> <br/><br/><br/><br/>

<?php
//SQL query to pull out all registered students
$fetch="SELECT * FROM `single` WHERE `checkin_date`= CURDATE()  ORDER BY `checkin_date` ASC LIMIT $start, $display ";
$fetch=@mysql_query($fetch) or die(mysql_error());

if($object->checkNumofRecord($fetch)==false){echo "<center><p class='msg info'>Sorry, no visitors found!</p></center>";}
elseif($object->checkNumofRecord($fetch)==true){
?>
<center><h1 style="color:#F00"><p>TODAY'S STATE SECURITY SERVICES <?php $date=getdate();
 echo $date['mday'] ." : ".$date['month']." :  ". $date['year']; ?></p></h1></center>
<center><table width="100%" border="1" cellspacing="1" cellpadding="10px">
	<tr class="thead">
<th>NAME</th>
<th>ARRIVE FROM</th>
<th>NEXT DESTINATION</th>
<th>CHECK IN TIME</th>
<th>CHECK IN DATE</th>
<th>GENDER</th>
<th>ROOM NUMBER</th>
<th>PHONE NUMBER</th>
<th>ID</th>
<th>ADDRESS</th>
<th>OCCUPATION</th>
<th>EXPECTED TO CHECKOUT</th>
<th></th>

</tr>
<?php

//FETCH AND SPIT IT OUT
while($row=mysql_fetch_array($fetch)){
 ?>
      <tr class="treven">
<td><?php echo $row['title'] ." ". $row['surname'] .", ". $row['othername'];?></td>
<td><?php echo $row['arrive_from'];?></td>
<td><?php echo $row['next_destination'];?></td>
<td><?php echo $row['checkin_time'];?></td>
<td><?php echo $row['checkin_date'];?></td>
<td><?php echo $row['sex'];?></td>
<td>	<?php $roomid=$row['roomid']; ?>
<?php echo $object->getRoomNumber($roomid); ?></td>
<td><?php echo $row['phonenumber'];?></td>
<td><?php echo $row['identification'];?></td>
<td><?php echo $row['fulladdress'];?></td>
<td><?php echo $row['occupation'];?></td>
<td><?php echo $row['checkout_date'];?></td>
</tr>

<?php
}  }
?>
</table></center>

<?php
 
  //paginate result set
if ($pages > 1) {
echo '<center>';
$current_page = ($start/$display) + 1;

if ($current_page != 1) {
 echo '<center><a href="singlesssreport.php?s=' .
($start - $display) . '&p=' . $pages .
'">Previous</a></center> ';
 }

for ($i = 1; $i <= $pages; $i++) {
 if ($i != $current_page) {
 echo '<a href="singlesssreport.php?s=' .
(($display * ($i - 1))) . '&p=' .
$pages . '">' . $i . '</a> ';
 } else {
 echo $i . ' ';
}
 }

if ($current_page != $pages) {
 echo '<center><a href="singlesssreport.php?s=' .
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
   <!------------------------------------------------CONTENT---------------------------------------------------------------->



   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">
<?php include_once('footer.php'); ?>

    		<p>&copy;Copyrights2013. All Rights reserved. Alovera Hotels International, Minna Niger State.</p>
			
</div><!--footer div-->
   <!------------------------------------------------FOOTER---------------------------------------------------------------->
</div>

</body>
</html>
<?php
}
else {
	header("location:index.php?access=denied");
	}
	?>