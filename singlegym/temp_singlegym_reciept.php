<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();
if($_SESSION['gym']==1){


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <article id="b4_head">
     <div id="head">
                              <?php $object->head("logo");?>
</div></article>
       <table width="100%">
         <tr>
            <td width="15%">&nbsp;			
</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="gymmenu1.php" style="color:#FFF;">Home</a></td> 
  <td width="14%"></td>

 </tr>

 </table>
 

 </div>
</div>
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content2"> 
<?php
$a=$object->query("SELECT * FROM `section` WHERE `section_name`='gym' AND `visibility`='1' ");
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
$numberofguest=mysql_real_escape_string($_GET['numberofguest']);
$waiter=mysql_real_escape_string($_GET['waiter']);

$cost=mysql_real_escape_string($_GET['cost']);

?>
<form name="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
<center><table width="500" border="0">
<tr class="ABS">
<td>&nbsp;</td>
<td>GYM RECIEPT

<tr>
<td height="64">Guest name</td>
<td>
<?php
$auto=$object->query("SELECT `surname`,`othername` FROM `single` WHERE `id`='$name'");
 
 while($row=mysql_fetch_array($auto)){
$surname=$row['surname'];
$othername=$row['othername'];
echo  "$surname,$othername";
 }
 ?>
</td>
</tr>

<tr class="abs" >
   	<td height="56">Number of Guests:</td>
    <td><?php echo $numberofguest; ?></td>
    </tr>
    <tr class="abs">
        	<td height="91">Attendant:</td>
        <td><?php echo $waiter; ?></td></tr>
            <tr class="abs">
        	<td height="62">Cost:</td>
        <td><?php echo $cost; ?></td></tr>
        <tr>
        <td></td>
	<td width="350"><center>   <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
if (window.print) {
document.write('<form>'
+ '<input type="button" name="print" value="  Print  " '
+ 'onClick="javascript:window.print()"></form>');
}
// End -->
</SCRIPT>
</center></td>
    </tr>

</table></center>
</form>
</fieldset>
<?php
}
?>
</div>
</div><!--content div-->
</div>

   <!------------------------------------------------CONTENT---------------------------------------------------------------->



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
	header("location:index.php?access=denied");
	}
	?>
	