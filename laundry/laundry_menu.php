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
<title>laundry Menu</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a></td> 
  <td width="14%"></td>

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
    <td width="33%" height="184"><p><center><a href="singlemenu.php"><img src="../images/images/ico_41.gif" /><br /> 
      SINGLE</a></center></p></td>
    <td width="26%"><p><center><a href="../grouplaundry/groupmenu.php"><img src="../images/images/ico_40.gif" /><br />GROUP</a></center></p></td>
        <td width="41%"><p><center><a href="../nonguestlaundry/singlemenu.php"><img src="../images/images/ico_40.gif" /><br />NON GUEST </a></center></p></td>
  </tr>
</table>
<?php 
}
?>
</div>
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