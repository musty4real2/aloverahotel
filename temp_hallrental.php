<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("class.php");
include("connect.php");
$object=new hms();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/main.css" rel="stylesheet" type="text/css" />

<title>Hall Rental</title>
</head>

<body>
 <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
                                        <?php $object->head2("logo");?>

    		<table width="100%">
            <tr>
            <td width="15%">&nbsp;</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#FFF;" href="logout.php">logout</a>  | <a href="others.php" style="color:#FFF;">Home</a></td> 
  <td width="14%"></td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content2">

  <div class="centerdiv"></div>
<?php
$name=mysql_real_escape_string($_GET['name']);
$address=mysql_real_escape_string($_GET['address']); 
$money=mysql_real_escape_string($_GET['money']);
$session=mysql_real_escape_string($_GET['session']); 
$attendant=mysql_real_escape_string($_GET['attendant']); 
$eventdate=mysql_real_escape_string($_GET['eventdate']); 
$phone=mysql_real_escape_string($_GET['phone']);
$time=mysql_real_escape_string($_GET['time']);
$date=mysql_real_escape_string($_GET['date']);


?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<center><table width="90%" border="1" cellspacing="1" cellpadding="10px">
<tr class="thead">
  <td colspan="2" valign="middle">HALL RENTAL RECIEPT </td></tr>
	<tr>

<td width="38%" height="31">Name</td>
    <td width="62%"><?php echo $name; ?></td>
</tr>
   <tr >
   	<td height="30">Address</td>
    <td><?php echo $address; ?></td>
    </tr>
	   <tr >
   	<td height="34">Amount Paid</td>
    <td><?php echo $money;     ?></td>
    </tr>

    <tr>
        	<td height="32">session</td>
      <td><?php echo $session;     ?></td></tr>
        <tr>
        	<td height="30">Attendant</td>
      <td><?php echo $attendant;     ?></td></tr>
      <tr>
        	<td height="35">event Date</td>
        <td>
        
        
 <?php echo $eventdate;     ?></td></tr>
            <tr>
        	<td height="36">Phone Number</td>
      <td><?php echo $phone;     ?></td></tr>
             <tr>
        	<td height="46">Time</td>
      <td><?php echo $time;     ?></td></tr>
       
        <tr>
       	  <td height="43">Entry Date</td>
      <td><?php echo $date;     ?></td></tr>
       
        <tr>
        <td></td>
	<td> <center>   <SCRIPT LANGUAGE="JavaScript">
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

</table>
</form>
<div id="footer">

<p>&copy;Copyrights2010. All Rights reserved. Alovera Hotels International, Minna Niger State.</p>
</div><!--footer div-->
</div>
</body>
</html>