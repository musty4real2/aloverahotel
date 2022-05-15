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
<title>non guest resturant</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
                              <?php $object->head("logo");?>

    		<table width="100%">
            <tr>
            <td width="15%">			
</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="nonguestresmenu.php" style="color:#FFF;">Home</a></td> 
 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content2"> 
	<?php
$a=$object->query("SELECT * FROM `section` WHERE `section_name`='restaurant' AND `visibility`='1' ");
?>
<?php
if(mysql_num_rows($a)==0){echo "This Module Wasn't Installed";}
elseif(mysql_num_rows($a)>0){
?>
<fieldset>
<center>
<div class="reciept"> </div></center>
<?php
$name=mysql_real_escape_string($_GET['name']);
$foodid=mysql_real_escape_string($_GET['foodid']);
$plate=mysql_real_escape_string($_GET['plate']);
$waiter=mysql_real_escape_string($_GET['waiter']);
?>

<form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>" >
<center><table width="500" border="0.5" class=""  >
<tr>
<td width="162" height="53">Guest name</td>
<td width="328">

 <?php
 echo $name; ?>
 </td>



  <tr>              
<td height="49">Food </td>
 <td><?php
 include('connect.php');
$food=$object->query("SELECT `id`,`cost`,`category`,`food_name` FROM `food` WHERE `id`='$foodid'");
  
 while($row=mysql_fetch_array($food)){
$category=$row['category'];
$foodname=$row['food_name'];
$cost=$row['cost'];

echo  "$category , $foodname,";
 }
 ?>

 </td>       
</tr>	
    <tr>
    <td height="39">Plate quantity:</td>
    <td><?php echo $plate; ?></td>
    </tr>
	<tr>
    <td height="39">cost:</td>
    <td><?php echo $cost * $plate ; ?></td>
    </tr>
    <tr>
    	<td height="48">Waiter:</td>
        <td><?php echo $waiter ?></td>
  </tr>
        	<tr>
            <td></td>
            <td><center>   <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
if (window.print) {
document.write('<form>'
+ '<input type="button" name="print" value="  Print  " '
+ 'onClick="javascript:window.print()"></form>');
}
// End -->n
</SCRIPT>
</center></td>
</tr>
</table></center>
</form>
</fieldset>
</div><!--content div-->
   <!------------------------------------------------CONTENT---------------------------------------------------------------->

<?php
}
?>

   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">
   <?Php $object->footer($cname);?>
</div><!--footer div-->
   <!------------------------------------------------FOOTER---------------------------------------------------------------->
</div>

</body>
</html>
<?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>