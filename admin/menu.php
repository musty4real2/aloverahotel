<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
          <?php $object->head("logo");?>
    <center>		<table width="100%">
            <tr>
            <td width="15%">			
</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#FFF;" href="logout.php">logout</a>  | <a style="color:#FFF;" href="admin_menu.php">Home</a></td> 
  <td width="14%"></td>

 </tr>

 </table></center>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">

<table width="100%" border="1">
  <tr>
    <td width="50%" height="184"><p><center><a href="singlemenu.php"><img src="../images/images/ico_41.gif" /><br /> 
      SINGLE</a></center></p></td>
    <td width="50%"><p><center><a href="../grouplaundry/groupmenu.php"><img src="../images/images/ico_40.gif" /><br />GROUP</a></center></p></td>
  </tr>
</table>
</div>
</div>
<div id="footer">
    		<p>&copy;Copyrights2010. All Rights reserved. Alovera Hotels International, Minna Niger State.</p>
			</div>
</body>
</html>