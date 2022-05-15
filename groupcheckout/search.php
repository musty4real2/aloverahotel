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
<title>initiate checkout</title>
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
<td width="50%"></td>
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="../checkout/single_menu.php" style="color:#FFF;">Home</a></td> 
  <td width="14%"></td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<h1 style="color:#F00"> Search  Records by Billing no.</h1>
<center>
<p>&nbsp;</p>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" autocomplete="off" method="get"/>

<table width="714" border="1" >
<tr>
  <td>
<input type="text" name="wname" id="area" onkeypress="autocomplete(this.value, event)" maxlength="30"size="40" value="<?php if(isset($_GET['wname'])){echo $_GET['wname'];} ?>" /><img src="loading.gif" alt="" width="19" height="27" id="loading" style="margin:0;"/><br/>
 <div id="ajax_response" ></div></td>
<td>
<input type="submit" name="search" id="button2" value="Search" />
</td>
</tr>
</table>
</form>
</center>








<?php

if(isset($_GET['search'])){
$billingnumber=addslashes($_GET['wname']);

	if(empty($billingnumber)){$error[]="Please enter a Billing no. to search with";}

	if(!empty($error)){
		echo "<p class='msg warning'><b>Oops! ERROR:</b></p>";
		foreach($error as $oops){
			echo "<p class='msg error'>$oops</p>";
			}//foreach loop
		}//if !empty error

		//if $error variable is empty, continue with the script
		elseif(empty($error)){

/*********************** *****************************************************************************************************************
************************************************************************************************************************************************************/

		$select=$object->query("SELECT * FROM `group` WHERE `checkout`='0' AND `billingno` LIKE '$billingnumber%'");

if(mysql_num_rows($select)==0){ echo "<p class='msg warning'>Sorry, No Match found!</p>";}

elseif(mysql_num_rows($select)>0){?>


<p>&nbsp;</p>

<fieldset style="height:auto; margin:0px 0px 30px 0px;">
<legend><?php echo mysql_num_rows($select);?> Result(s) found</legend>


<center>
<table border="1" class="searchrestable" width="100%" style="color:#646262; border-collapse:collapse; font-size:14px;">
  <tr class="listtabletr" style="text-align:center; font-weight:bold;">
    <td>S/N</td>
    <td>Guest name</td>
    <td>Initial deposit</td>
    <td>Check in date</td>
        <td>Check out date</td>
    <td>Billing no</td>
    <td>Room Category</td>
    <td>Room Number</td>
    <td>Room Cost</td>
    <td>Room Location</td>
    <td></td>
    
    </tr>


  <?php
	$serial=1;
  	while($row=mysql_fetch_array($select)){?>
	<?php $id=$row['id'];
	$surname=$row['surname'];
	$roomid=$row['roomid'];
	?>
      <tr class="treven">

    <td><?php echo $serial++; ?></td>
    <td><?php echo $surname.", ".$row['othername'];?></td>
    <td><?php echo "N".$row['inidep']." .00" ;?></td>
    <td><?php echo $row['checkin_date'] ;?></td>
    <td><?php echo $row['checkout_date'] ;?></td>
    <td><?php echo $row['billingno'] ;?></td>
    <td><?php echo $object->getRoomCat($roomid); ?></td>
    <td><?php echo $object->getRoomNumber($roomid); ?></td>
    <td><?php echo $object->getRoomCost($roomid); ?></td>
    <td><?php echo $object->getRoomLocation($roomid); ?></td>
<?php $id=$row['id']; ?>
<?php echo "<td><a href='single_records.php?id=$id&roomid=$roomid'>Initiate Checkout</a></td>"; ?>  
  </tr>

<?php } } } }?>

</table></center>
</fieldset>
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