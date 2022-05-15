<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include("../connect.php");
include("../class.php");
$object=new hms;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Veiw Today's single reservation  Record</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="../recepmenu1.php" style="color:#FFF;">Home</a></td> 


 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">

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
  
  ?>
<?php

//SQL query to pull out all registered students
$fetch="SELECT * FROM `single` WHERE `checkin_date`= CURDATE()  ORDER BY `checkin_date` ASC LIMIT $start, $display ";
$fetch=@mysql_query($fetch) or die(mysql_error());
if($object->checkNumofRecord($fetch)==false){echo "<p class='msg info'>Sorry, no visitors found!</p>";}
elseif($object->checkNumofRecord($fetch)==true){
?>
<p>Below are Today's Visitors</p>
<table width="100%" border="1" cellspacing="1" cellpadding="10px">
	<tr class="thead"><th>NAME</th>
<th>OCCUPATION</th>
<th>ARRIVE FROM</th>
<th>NEXT DESTINATION</th>
<th>CHECK IN TIME</th>
<th>CHECK IN DATE</th>
<th>INITIAL DEPOSIT</th>
<th>BILLING NUMBER</th>
<th>PHONE NUMBER</th>
<th></th>

</tr>
<?php

//FETCH AND SPIT IT OUT
while($row=mysql_fetch_array($fetch)){
 ?>
      <tr class="treven">
<td><?php echo $row['title'] ." ". $row['surname'] .", ". $row['othername'];?></td>
<td><?php echo $row['occupation'];?></td>
<td><?php echo $row['arrive_from'];?></td>
<td><?php echo $row['next_destination'];?></td>
<td><?php echo $row['checkin_time'];?></td>
<td><?php echo $row['checkin_date'];?></td>
<td><?php echo $row['inidep'];?></td>
<td><?php echo $row['billingno'];?></td>
<td><?php echo $row['phonenumber'];?></td>
</tr>

<?php
}  }
?>
</table>
<table width='100%' border='0' style='margin:auto;' class="table">
<tr>
<td width="5%" >&nbsp;</td>
<td width="10%">&nbsp;</td>
<td width="10%">&nbsp;</td>
<td width="15%">&nbsp;</td>
<td width="11%">&nbsp;</td>
<td width="14%">&nbsp;</td>
<td width="9%"><?php 
$sum="SELECT SUM(inidep) FROM `single` WHERE `checkin_date`= CURDATE()";
$result1=mysql_query($sum) or die(mysql_error());

while($row=mysql_fetch_array($result1)){
echo "Total N".number_format($row['SUM(inidep)'],2);
} ?></td>
<td width="13%">&nbsp;</td>
<td width="13%">&nbsp;</td>
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
   <!------------------------------------------------CONTENT---------------------------------------------------------------->



   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">

<?php 
$object->footer($cname); 
?>			
</div><!--footer div-->
   <!------------------------------------------------FOOTER---------------------------------------------------------------->
</div>

</body>
</html>
