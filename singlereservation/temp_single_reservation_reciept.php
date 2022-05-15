<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();
ob_start();
if($_SESSION['reception']==1){

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<title>check in Single Guest here</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="../recepmenu1.php" style="color:#FFF;">Home</a></td> 
  <td width="14%">&nbsp;</td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content2">

  <div class="centerdiv"><div class="reciept">&nbsp;</div></div>
<?php
$title=mysql_real_escape_string($_GET['title']);

$surname=mysql_real_escape_string($_GET['surname']);
$othernames=mysql_real_escape_string($_GET['othername']);
$amount=mysql_real_escape_string($_GET['amount']);
$phonenumber=mysql_real_escape_string($_GET['phonenumber']);
$inideposit=mysql_real_escape_string($_GET['inideposit']);
$arrivefrom=mysql_real_escape_string($_GET['arrivefrom']);
$nextdestination=mysql_real_escape_string($_GET['nextdestination']);
$receptionist=mysql_real_escape_string($_GET['receptionist']);
$occupation=mysql_real_escape_string($_GET['occupation']);
$title=mysql_real_escape_string($_GET['title']);
$guesttype=mysql_real_escape_string($_GET['guesttype']);
$email=mysql_real_escape_string($_GET['email']);
$identification=mysql_real_escape_string($_GET['identification']);

$fulladdress=mysql_real_escape_string($_GET['fulladdress']);

$roomid2=mysql_real_escape_string($_GET['roomid2']);
$billing_no="S".rand(1,1000000000)."ALO";//	   $timestamp=mysql_real_escape_string($_POST['timestamp'])=time();
	//   $billingno=mysql_real_escape_string($_POST['billnum']="S".rand(1,1000000000)."ALO";

	
			$checkoutdate=mysql_real_escape_string($_GET['checkoutdate']);

?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

<table width="768" border="0" class="table_r">
    	<tr>
       	  <td width="195"><p class="orange">Basic Info:</p></td>
        	<td width="202"></td>
       	  <td width="357"></td>
        </tr>
           <tr>
        	<td></td>
        	<td>Title:</td>
        	<td height="29"><?PHP echo $title; ?></td>
        </tr>
        <tr>
        	<td></td>
        	<td>surname:</td>
        	<td height="15"><?php echo $surname; ?></td>
        </tr>
        <tr>
        	<td></td>
        	<td>Other names:</td>
        	<td height="36"><?php echo $othernames; ?></td>
        </tr>
        <tr>
        	<td></td>
        	<td>phone Number:</td>
        	<td height="34"><?php echo $phonenumber; ?></td>
        </tr>
          <tr>
        	<td></td>
        	<td>occupation:</td>
        	<td height="36"><?php echo $occupation; ?></td>
        </tr>
        		   <tr>
        	<td></td>
        	<td>Sex:</td>
        	<td><?php echo $guesttype; ?>
           </td>
      </tr> 
       <tr>
        	    <td height="32"></td>
       	 	 <td>Arrive From</td>
        	<td><?php echo $arrivefrom; ?></td>
        </tr>
        <tr>
        	    <td height="31"></td>
       	 	 <td>Next Destination:</td>
        	<td><?php echo $nextdestination; ?></td>
        </tr>
         <tr>
        	    <td height="31"></td>
       	 	 <td>Email:</td>
        	<td><?php echo $email; ?></td>
        </tr>
         <tr>
        	    <td height="31"></td>
       	 	 <td>Form of Identification:</td>
        	<td><?php echo $identification; ?></td>
        </tr>
           <tr>
        	    <td height="31"></td>
       	 	 <td>Full Address:</td>
        	<td><?php echo $fulladdress; ?></td>
        </tr>
        
		        <tr>
        	<td></td>
        	<td></td>
        	<td></td>
        </tr>
       <tr>
      <tr>
        	<td></td>
        	<td></td>
        	<td></td>
      </tr>
       <tr>

      <tr>
        	<td height="17"><p class="orange">Reservation Info:</p></td>
        	<td></td>
        	<td></td>
      </tr>
<tr>              	<td></td>

<td> room</td>
 <td height="34"><?php
 include('../connect.php');
$auto=$object->query("SELECT `id` ,`room_number`, `room_category`,`room_location`,`cost` FROM `rooms` WHERE `id`='$roomid2'");

 while($row=mysql_fetch_array($auto)){
$roomid=$row['id'];
$roomcategory=$row['room_category'];
$roomnumber=$row['room_number'];
$roomlocation=$row['room_location'];
$roomcost=$row['cost'];

 echo " $roomnumber $roomcategory $roomlocation        ";
 echo "Room Cost: N$roomcost";
}
 ?>
</td>  
</tr>
        
     
 <tr>
 
       	  	<td></td>
        	<td></td>
       	 	 <td></td>
      </tr>
        <tr>
        	    <td height="39"></td>
       	 	 <td>Initial Deposit:</td>
        	<td><?php echo $inideposit; ?></td>
        </tr>
		        
         <tr>
        	   <td height="29"></td>
       	 	 <td>receptionist:</td>
             <td><?php echo $receptionist; ?></td>
        </tr>
        <tr>
        <td height="54"></td>
        <td>Date expected to checkout</td>
        <td height="54"><?php echo $checkoutdate; ?></td>
              
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
// End -->
</SCRIPT>
</center>  </td>
</tr>
 </table>





</form>
</div><!--content div-->
   <!------------------------------------------------CONTENT---------------------------------------------------------------->



   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">
<?Php $object->footer($cname); ?>
</div><!--footer div-->
   <!------------------------------------------------FOOTER---------------------------------------------------------------->
</div>

</body>
</html>
<?php
ob_flush();

?><?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>