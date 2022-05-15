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
<title>Non guest Resturant</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="../singleresturant/resmenu.php" style="color:#FFF;">Home</a></td> 
  <td width="14%"></td>

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
<table width="100%" border="1">
  <tr>
    <td width="26%" height="184"><p><center>
    <a href="enter_nonguest_resturant_details.php"><img src="../images/images/icons_42.gif" /><br />
    Enter Non Guest Resturant Details</a>
    </center></p></td>
    <td width="36%"><p><center><a href="viewtodaysrecord.php"><img src="../images/restaurant2-01.png" /><br />View Today's Resturant</a></center></p></td>
    <td width="38%"><p><center><a href="viewallrecord.php"><img src="../images/restaurant-03-01.png" /><br />View All Resturant</a></center></p></td>
  </tr>
</table>
<?php
}
?>
</div>
<div id="footer">
   <?Php $object->footer($cname);?>			</div>

</body>
</html>
<?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>