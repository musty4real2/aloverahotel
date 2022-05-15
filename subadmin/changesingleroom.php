<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
ob_start();
include("../class.php");
include("../connect.php");
$object=new hms();
if($_SESSION['auth']==1){
?>

<?php
if(isset($_POST['submit'])){	

	$pid=mysql_real_escape_string($_POST['thisID']);
$roomidup=mysql_real_escape_string($_POST['roomid']);

	$sql=$object->query("UPDATE `single` SET  `room2_id`='$roomidup', `date_of_change`=NOW() WHERE `id`='$pid' LIMIT 1");

if($sql){
		$abdul=$object->query("UPDATE `rooms` SET  `room_availability`='1' WHERE `id`='$roomidup' LIMIT 1");
}

header("location:singleroom_occupants.php");
	exit();
}
	?>
    <?php
if(isset($_GET['pid'])){
	$targetID=$_GET['pid'];
$sql=mysql_query("SELECT * FROM `single` WHERE `id`='$targetID' LIMIT 1");
$productCount= mysql_num_rows($sql);
if($productCount>0){
	while($row=mysql_fetch_array($sql)){
$roomid2=$row['roomid'];
			$checkoutdate=$row['checkout_date'];
			$room2_id=$row['room2_id'];
	}
	}else{
echo "that does not exist";
exit();

}

}
	
if($roomup!=$roomid2){
		$eli=$object->query("UPDATE `rooms` SET  `room_availability`='0' WHERE `id`='$roomid2' LIMIT 1");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<title>Edit Single Guest Room here</title>
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
  <td width="14%">&nbsp;</td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php
if(isset($_POST['submit'])){

	

	if(!empty($error)){
		echo "<p class='msg warning'><b>Oops! ERROR:</b></p>";
		foreach($error as $oops){
			echo "<p class='msg error'>$oops</p>";
			}//foreach loop
		}//if !empty error


}
}
?>

<form action="changesingleroom.php" method="post"  enctype="multipart/form-data" name="myForm" id="myForm">

<tr>              	<td></td>

<td>Current Room</td>
</tr>
<tr>
                 <td><p class="orange"><center>Current Room Number:
                  <?php
			

					 echo $object->getRoomNumber($roomid2);
				 
				 
				 ?></center></p></td>
                 </tr>
                 <tr>
                 <td>Current Room Category: <?php echo $object->getRoomCat($roomid2); ?><br/><br/></td>
                 </tr>
     
    <tr>
    <td>Current Room Cost: <?php echo $object->getRoomCost($roomid2); ?><br/><br/></td>
    </tr>
    <tr>              	<td></td>

<td>Room 2</td>
</tr>
<tr>
                 <td><p class="orange"><center>Room2 Number:
                  <?php
			

					 echo $object->getRoomNumber($room2_id);
				 
				 
				 ?></center></p></td>
                 </tr>
                 <tr>
                 <td>Room2 Category: <?php echo $object->getRoomCat($room2_id); ?><br/><br/></td>
                 </tr>
     
    <tr>
    <td> Room2 Cost: <?php echo $object->getRoomCost($room2_id); ?><br/><br/></td>
    </tr>
    <tr>

 <td height="34"><?php
 include('../connect.php');
$auto=$object->query("SELECT `id` ,`room_number`, `room_category`,`room_location` FROM `rooms` WHERE `room_availability`=0 ORDER BY 'room_category' DESC ");
 
 ?>

 <select   class="input" name='roomid'>
  <option value=''>select</option>
  <option value=''>----------</option>
  <?php 
 while($row=mysql_fetch_array($auto)){
$roomid=$row['id'];
$roomcategory=$row['room_category'];
$roomnumber=$row['room_number'];
$roomlocation=$row['room_location'];

echo "<option value='$roomid'> $roomnumber $roomcategory $roomlocation</option>";
}
 ?>  
 <?php if(isset($_POST['roomid'])){echo "<option  value='{$_POST['roomid']}' selected='selected'>{$_POST['roomid']}</option>"; }?>

 </select></td>       
 
</tr>
<tr>
	   <td height="15"><input type="hidden" value="<?php echo $targetID ?>" name="thisID"/> <input id="button" type="submit" value="Change Room" name="submit" /></td>
</tr>


</form>
</div><!--content div-->
   <!------------------------------------------------CONTENT---------------------------------------------------------------->



   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">
<?php 
include_once('footer.php'); 
ob_flush();

?>
    <?Php $object->footer($cname); ?>
</div><!--footer div-->
   <!------------------------------------------------FOOTER---------------------------------------------------------------->
</div>

</body>
</html>