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
<title>Untitled Document</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
    		<center>                         <?php $object->head("logo");?>
</center>
            <table width="100%">
            <tr>
            <td width="15%">&nbsp;</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="admin_menu.php" style="color:#FFF;">Home</a></td> 
  <td width="14%"></td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<table width="100%" border="1">
  <tr>
    <td width="33%" height="184"><p><center><a href="edit_menu.php"><img src="../images/images/ico_41.gif" /><br/>SINGLE</a></center></p></td>
    <td width="27%"><p><center><a href="edit_menu2.php"><img src="../images/images/ico_40.gif" /><br>GROUP</a></center></p></td>
    <td width="40%"><p><center><a href="edit_menu3.php"><img src="../images/images/ico_40.gif" /><br>NON GUEST</a></center></p></td>

  </tr>
</table>
</div>
<div id="footer">
    <?Php $object->footer($cname); ?>

</div>
</div>

</body>
</html>
<?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>