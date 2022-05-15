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
<title>Untitled Document</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="../laundry/laundry_menu.php" style="color:#FFF;">Home</a></td> 
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

<table width="100%" border="1">
  <tr>
    <td width="33%" height="184"><p><center>
      <a href="laundry_form.php"><img src="../images/images/icons_09.gif" /><br />Enter Record</a>
    </center></p></td>
      <td width="33%" height="184"><p><center>
      <a href="viewallrecord.php"><img src="../images/images/icons_31.gif" /><br />View All Record</a>
      </center></p></td>
     <td width="33%" height="184"><p><center>
      <a href="viewtodaysrecord.php"><img src="../images/images/icons_12.gif" /><br />View Today's Record</a>
     </center></p></td>
  </tr>
</table>
</div>
<?php } ?>
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
