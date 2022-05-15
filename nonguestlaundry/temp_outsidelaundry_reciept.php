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
<title>outside laundry temp reciept</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="singlemenu.php" style="color:#FFF;">Home</a></td>

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

<?php
$guestid=mysql_real_escape_string($_GET['name']);
$clothtype=mysql_real_escape_string($_GET['clothtype']);
$amount=mysql_real_escape_string($_GET['amount']);
$cabinetnumber=mysql_real_escape_string($_GET['cabinetnumber']);
$staff=mysql_real_escape_string($_GET['staff']);
$guesttype=mysql_real_escape_string($_GET['guesttype']);
$quantity=mysql_real_escape_string($_GET['quantity']);

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<cener><table width="90%" border="0">
  <tr>
    <td colspan="2"><center>
      <h3>Outside Laundry Temporary Reciept</h3></center></td>
    </tr> <tr class="abs">
<td width="44%" class="align">Guest name</td>
 <td width="56%"><?php
 echo $guestid;
 ?>
 </select></td>
  </tr>
  <tr>
    <td class="align">Cloth Type</td>
    <td><?PHP echo $clothtype; ?></td>
  </tr>
  <tr>
    <td class="align">Amount</td>
    <td><?php echo $amount; ?></td>
  </tr><tr>
     <td class="align">Cabinet Number</td>
    <td><?php echo $cabinetnumber; ?></td>
</tr><tr class="abs">
     <td class="align">Attendant's Name</td>
    <td><?php echo $staff; ?></td>
</tr>

  <tr class="abs">
    <td class="align">Quantity</td>
<td><?php echo $quantity; ?></td>
  </tr>

  <tr>
  <td>&nbsp;</td>
    <td><br /><center>   <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
if (window.print) {
document.write('<form>'
+ '<input type="button" name="print" value="  Print  " '
+ 'onClick="javascript:window.print()"></form>');
}
// End -->
</SCRIPT>
</center>
</td>    
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td><input type="hidden" value"<?php echo $object->selectGuestType('single', $id); ?>" name="guesttype"/></td>
  </tr>
</table></center>
</form><?php
}
?>
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
