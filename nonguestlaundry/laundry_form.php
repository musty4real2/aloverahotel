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
<title>outside  laundry form</title>
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
if(isset($_POST['submit'])){
$guestid=mysql_real_escape_string($_POST['name']);
$clothtype=mysql_real_escape_string($_POST['clothtype']);
$amount=mysql_real_escape_string($_POST['amount']);
$cabinetnumber=mysql_real_escape_string($_POST['cabinetnumber']);
$staff=mysql_real_escape_string($_POST['staff']);
$guesttype=mysql_real_escape_string($_POST['guesttype']);
$quantity=mysql_real_escape_string($_POST['quantity']);
if($clothtype==""){$error[]="Please Enter Cloth Type ";}
			if($amount==""){$error[]="Please specify Amount Collected";}
			if($staff==""){$error[]="Please specify the name of the Attendant";}
			if($quantity==""){$error[]="Please specify number of cloth brought";}
						if($cabinetnumber==""){$error[]="Please specify the Cabinet number";}

									
	if(!empty($error)){
		echo "<p class='msg warning'><b>Oops! ERROR:</b></p>";
		foreach($error as $oops){
			echo "<p class='msg error'>$oops</p>";
			}//foreach loop
		}//if !empty error

		//if $error variable is empty, continue with the script
		elseif(empty($error)){

$sql=$object->query("INSERT INTO `outsidelaundry` (`guestname` ,`cloth_type` ,`amount` ,`cabinetnumber` ,`entrydate` ,`staff` ,`time`,`quantity` ,`return`,`checkout`)
VALUES ('$guestid', '$clothtype', '$amount', '$cabinetnumber', NOW(), '$staff',NOW(),'$quantity','','') ");
header("location:temp_outsidelaundry_reciept.php?name=$guestid&clothtype=$clothtype&amount=$amount&cabinetnumber=$cabinetnumber&staff=$staff&guesttype=$guesttype&quantity=$quantity");
}
}
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<cener><table width="90%" border="0">
  <tr>
    <td colspan="2"><center>
      <h3>None Guest Laundry Form </h3></center></td>
    </tr> <tr class="abs">
<td width="44%" class="align">Guest name</td>
 <td width="56%"><input type="text" name="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>" placeholder=" e.g sunday "/></td>
  </tr>
  <tr>
    <td class="align">Cloth Type</td>
    <td><input type="text" class="tablerow" name="clothtype" value="<?php if(isset($_POST['clothtype'])){ echo $_POST['clothtype'];}?>"/></td>
  </tr>
  <tr>
    <td class="align">Amount</td>
    <td><input type="text" class="tablerow" name="amount" value="<?php if(isset($_POST['amount'])){ echo $_POST['amount'];}?>"/></td>
  </tr><tr>
     <td class="align">Cabinet Number</td>
    <td><input type="text"  class="tablerow" name="cabinetnumber" value="<?php if(isset($_POST['cabinetnumber'])){ echo $_POST['cabinetnumber'];}?>"/></td>
</tr><tr class="abs">
     <td class="align">Attendant's Name</td>
    <td><input type="text"  class="tablerow" name="staff" /></td>
</tr>

  <tr class="abs">
    <td class="align">Quantity</td>
<td><input type="text" class="tablerow" name="quantity" value="<?php if(isset($_POST['quantity'])){ echo $_POST['quantity'];}?>" /></td>
  </tr>
  <tr>
  <td>&nbsp;</td>
    <td><br /><input type="submit"  name="submit" value="submit"/></td>    
    </tr>
</table></center>
</form>
</div>
<?php }
?>

<div id="footer">
   <?Php $object->footer($cname);?>			</div>
            </div>
</body>
</html>
<?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>