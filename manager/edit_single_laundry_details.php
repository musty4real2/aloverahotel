<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ob_start();
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();
if($_SESSION['auth']==1){
?>
<?php
if(isset($_POST['submit'])){	
	$pid=mysql_real_escape_string($_POST['thisID']);

$guestid=mysql_real_escape_string($_POST['name']);
$clothtype=mysql_real_escape_string($_POST['clothtype']);
$amount=mysql_real_escape_string($_POST['amount']);
$cabinetnumber=mysql_real_escape_string($_POST['cabinetnumber']);
$staff=mysql_real_escape_string($_POST['staff']);
$guesttype=mysql_real_escape_string($_POST['guesttype']);
$quantity=mysql_real_escape_string($_POST['quantity']);

	$sql=$object->query("UPDATE `singlelaundry` SET `guestid`='$guestid',`cloth_type`='$clothtype',`amount`='$amount',`cabinetnumber`='$cabinetnumber',`quantity`='$quantity'  WHERE `guestid`='$pid' LIMIT 1");
	
header("location:single_laundry_delete.php");
	exit();
}
	?>
    <?php
if(isset($_GET['pid'])){
	$targetID=$_GET['pid'];
$sql=mysql_query("SELECT * FROM `singlelaundry` WHERE `guestid`='$targetID' LIMIT 1");
$productCount= mysql_num_rows($sql);
if($productCount>0){
	while($row=mysql_fetch_array($sql)){
$guestid=$row['guestid'];
$clothtype=$row['cloth_type'];
$amount=$row['amount'];
$cabinetnumber=$row['cabinetnumber'];
$staff=$row['staff'];
$guesttype=$row['guesttype'];
$quantity=$row['quantity'];	}
	}else{
echo "that does not exist";
exit();

}

}
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit single laundry form</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="edit_menu.php" style="color:#FFF;">Home</a></td> 
 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">

<?php
if(isset($_POST['submit'])){

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
}
}
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<cener><table width="90%" border="0">
  <tr>
    <td colspan="2"><center><h3>Single Laundry Edit Form </h3></center></td>
    </tr> <tr class="abs">
<td width="44%" class="align">Guest name</td>
 <td><?php echo  $object->getGuestName($guestid); ?></td>
 <td width="56%"><?php
 include('../connect.php');
$auto=$object->query("SELECT `id` , `surname`,`othername` FROM `single` WHERE `checkout`='0' ORDER BY 'surname' DESC ");
 
 ?>

 <select    class="tablerow" name='name'>
  <option value=''>select</option>
  <option value=''>----------</option>
  <?php 
 while($row=mysql_fetch_array($auto)){
$id=$row['id'];
$surname=$row['surname'];
$othername=$row['othername'];
echo "<option value='$id'>$surname,$othername </option>";
}
 ?>
 </select></td>
  </tr>
  <tr>
    <td class="align">Cloth Type</td>
    
    <td><input type="text" class="tablerow" name="clothtype" value="<?php echo $clothtype; ?>"/></td>
  </tr>
  <tr>
    <td class="align">Amount</td>
    <td><input type="text" class="tablerow" name="amount" value="<?php echo $amount; ?>"/></td>
  </tr><tr>
     <td class="align">Cabinet Number</td>
    <td><input type="text"  class="tablerow" name="cabinetnumber" value="<?php echo $cabinetnumber; ?>"/></td>
</tr><tr class="abs">
     <td class="align">Attendant's Name</td>
    <td><input type="text"  class="tablerow" name="staff"  value="<?php echo $staff; ?>"/></td>
</tr>

  <tr class="abs">
    <td class="align">Quantity</td>
<td><input type="text" class="tablerow" name="quantity" value="<?php echo $quantity; ?>" /></td>
  </tr>

  <tr>
  <td>&nbsp;</td>
    <td><br /><input type="hidden" value="<?php echo $targetID ?>" name="thisID"/><input type="submit"  name="submit" value="submit"/></td>    
    </tr>
    <tr>
    <td>&nbsp;</td>
  </tr>
</table></center>
</form>

<div id="footer">
<?php
}
?>
    <?Php $object->footer($cname); ?>
			</div>
</body>
</html>