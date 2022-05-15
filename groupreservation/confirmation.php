<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$cname=$_GET['cname'];
$object=new hms();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>group confirmaton</title>
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
<td width="50%">&nbsp;</td>
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="../receptionmenu.php" style="color:#FFF;">Home</a></td> 

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<h1><?php echo "Temporary Reciept For ".$cname." Group"; ?></h1><br/>

<center><form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
   <fieldset>
   <?php
   
   		$group=$object->query("SELECT * FROM `group` WHERE `companyname` ='{$_GET['cname']}'");

   
   ?>

<table width="100%" border="1" cellspacing="1" cellpadding="50px">


<tr>
<th width="8%">NAME</th>
<th width="9%">OCCUPATION</th>
<th width="7%">ARRIVE FROM</th>
<th width="9%">NEXT DESTINATION</th>
<th width="6%">CHECK IN TIME</th>
<th width="7%">CHECK IN DATE</th>
<th width="8%">INITIAL DEPOSIT</th>
<th width="8%">BILLING NUMBER</th>
<th width="7%">PHONE NUMBER</th>
<th width="9%">RECEPTIONIST</th>
<th width="6%">ROOM NUMBER</th>
<th width="8%">ROOM CATEGORY</th>
<th width="8%">ROOM LOCATION</th>
<th width="8%">ROOM COST</th>
</tr>
<?php

//FETCH AND SPIT IT OUT
while($row=mysql_fetch_array($group)){
$bg = ($bg=='#cfebf2' ? '#f6f6f6' :
'#cfebf2'); // Switch the background
 echo "<tr bgcolor='$bg' class='trs'>";  ?>

<td><center><?php echo $row['title'] ." ". $row['surname'] .", ". $row['othername'];?></center></td>
<td><center><?php echo $row['occupation'];?></center></td>
<td><center><?php echo $row['arrive_from'];?></center></td>
<td><center><?php echo $row['next_destination'];?></center></td>
<td><center><?php echo $row['checkin_time'];?></center></td>
<td><center><?php echo $row['checkin_date'];?></center></td>
<td><center><?php echo $row['inidep'];?></center></td>
<td><center><?php echo $row['billingno'];?></center></td>
<td><center><?php echo $row['phonenumber'];?></center></td>
<td><center><?php echo $row['receptionist'];?></center></td>
<td><center><?php echo $object->getRoomNumber($row['roomid']);?></center></td>
<td><center><?php echo $object->getRoomCat($row['roomid']);?></center></td>
<td><center><?php echo $object->getRoomLocation($row['roomid']);?></center></td>
<td><center><?php echo $object->getRoomCost($row['roomid']);?></center></td>
</tr>

<?php
  }
?>
<table border="0"/>
<tr>
<td><?php 
$sum="SELECT SUM(inidep) FROM `group` WHERE `companyname` ='{$_GET['cname']}' ";
$result1=mysql_query($sum) or die(mysql_error());

while($row=mysql_fetch_array($result1)){
echo "Total N".number_format($row['SUM(inidep)'],2);
} ?>
</td>
</tr>
</table>
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


  </fieldset>
	</form></center>
    </div>
    </div>

</body>
</html>