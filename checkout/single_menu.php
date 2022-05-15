<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();
if($_SESSION['reception']==1){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>check out  Menu</title>
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
  <td width="14%">&nbsp;</td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<table width="100%" border="1">
  <tr>
    <td width="50%" height="184"><p><center>
      <a href="search.php"><img src="../images/images/ico_41.gif" /><br/>Initialize Checkout For Single Guest</a>
 
    </center></p></td>
    <td width="50%"><p><center>
    <a href="../groupcheckout/search.php"><img src="../images/images/ico_40.gif" /><br>Initialize Checkout For Group Guest </a>
    </center></p></td>
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