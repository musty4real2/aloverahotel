<?php 
ob_start();
session_start();
include("../../class.php");
$object=new hms();
$object=new hms();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

include("../../connect.php");

//ensure that executive session is ON
if($_SESSION['executive']==1){

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:::::::::::: Setup Hotel::::::::::::</title>
<link href="../../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
     
	   <table width="100%">
            <tr>
            <td width="15%">			
</td>
<td width="50%">	<h1>&nbsp;</h1></td>
  <td width="14%"></td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php
if(isset($_POST['submit'])){
$res=mysql_real_escape_string($_POST['res']);
$laund=mysql_real_escape_string($_POST['laund']);
$gym=mysql_real_escape_string($_POST['gym']);


if($res==0){	
$update=$object->query("UPDATE `section` SET `visibility` = '0' WHERE `section_name`='restaurant' LIMIT 1 ");
}
if($res==1){
	
$update=$object->query("UPDATE `section` SET `visibility` = '1' WHERE `section_name`='restaurant' LIMIT 1 ");
}

if($laund==0){	
$update=$object->query("UPDATE `section` SET `visibility` = '0' WHERE `section_name`='laundry' LIMIT 1 ");
}
if($laund==1){
	
$update=$object->query("UPDATE `section` SET `visibility` = '1' WHERE `section_name`='laundry' LIMIT 1 ");
}

if($gym==0){	
$update=$object->query("UPDATE `section` SET `visibility` = '0' WHERE `section_name`='gym' LIMIT 1 ");
}
if($gym==1){
	
$update=$object->query("UPDATE `section` SET `visibility` = '1' WHERE `section_name`='gym' LIMIT 1 ");
}
header("location:new_user.php");
}
?>
  <div id="bar"><h3>Setup Hotel </h3></div>
<p>Please Choose the Module You Wish to install for your Hotel</p>


<?php

		$rest=$object->query("SELECT *  FROM `section`");
		


?>
<center>
<fieldset>
<legend><b>View All Hotel Modules</b>
</legend>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<table width="100%" border="1"  id="box-table-a">
    
    	<tr class="thead">
    <td>Module Name</td>
    <td>Remove</td>
    <td>Add</td>    
    </tr>
 <tr>
 <td height="47"><center>Restaurant</center></td>
 <td><center><input type="radio" name="res"  value="0"/></center></td>
 <td><center><input type="radio" name="res" value="1"/> </center></td>
 </tr>
 
  <tr>
 <td height="38"><center>Laundry</center></td>
 <td><center><input type="radio" name="laund"  value="0"/></center></td>
 <td><center><input type="radio" name="laund" value="1"/></center> </td>
 </tr>
  <tr>
 <td height="35"><center>Gym</center></td>
 <td><center><input type="radio" name="gym"  value="0"/></center> </td>
 <td><center><input type="radio" name="gym" value="1"/></center> </td>
 </tr>
 <tr>
 <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="save" value="SAVE" /></td>
  </table>
  </form>
  </fieldset></center>
</div>

</body>
</html>
<?php
}
else{
	header("location:executive+login.php?access=denied");}
	?>