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
$name=mysql_real_escape_string($_POST['name']);
$idfood=mysql_real_escape_string($_POST['foodid']);
$plate=mysql_real_escape_string($_POST['plate']);
$waiter=mysql_real_escape_string($_POST['waiter']);
$foodcost=mysql_real_escape_string($_POST['foodcost']);
$cost=$foodcost * $plate;
	
	$sql=$object->query("UPDATE `groupresturant` SET `guestid`='$name',`food_id`='$idfood',`plate`='$plate',`cost`='$cost'  WHERE `guestid`='$pid' Limit 1");
	
header("location:group_resturant_delete.php");
	exit();
}
	?>
    <?php
if(isset($_GET['pid'])){
	$targetID=$_GET['pid'];
$sql=mysql_query("SELECT * FROM `groupresturant` WHERE `guestid`='$targetID' LIMIT 1");
$productCount= mysql_num_rows($sql);
if($productCount>0){
	while($row=mysql_fetch_array($sql)){
		$name=$row['guestid'];
$idfood=$row['food_id'];
$plate=$row['plate'];
$waiter=$row['waiter'];
$foodcost=$row['cost'];
	}
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
<title>Single Resturant</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="edit_menu2.php" style="color:#FFF;">Home</a></td> 

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php
if(isset($_POST['submit'])){

if($name==""){$error[]="Please Select A Name ";}
			if($plate==""){$error[]="Please specify number of plate";}
									
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
 <?php
$auto=$object->query("SELECT `id` , `surname` ,  `othername` FROM `group` WHERE `checkout`='0' ORDER BY
 `surname` DESC");
?>
<form action="edit_groupres_details.php" method="post"  enctype="multipart/form-data" name="myForm" id="myForm">
<center><table width="600" border="0">
<tr>
<td width="174">Name</td>
<td width="202"><?php echo $object->getGuestName2($name); ?></td>
<td width="110">
 <select class="input" name='name'>
  <option value=''>select</option>
  <option value=''>----------</option>
  <?php 
 while($row=mysql_fetch_array($auto)){
$id=$row['id'];
$surname=$row['surname'];
$oname=$row['othername'];
echo "<option value='$id'>$surname, $oname</option>";
}
 ?>
 </select>



  <tr>              
<td>select Food</td>
<td><?php echo $object->getFoodname($idfood); ?></td>

 <td><?php
 include('../connect.php');
$food=$object->query("SELECT `id`,`cost`,`category`,`food_name` FROM `food` ORDER BY 
`food_name` ASC");
 
 ?>

 <select   class="input" name='foodid'>
  <option value=''>select</option>
  <option value=''>----------</option>
  <?php 
 while($row=mysql_fetch_array($food)){
$foodid=$row['id'];
$foodcategory=$row['category'];
$foodcost=$row['cost'];
$foodname=$row['food_name'];

echo "<option value='$foodid'> $foodname $foodcategory </option>";
}
 ?>
 </select> <input type="hidden" value="<?php echo $foodcost; ?>" name="foodcost"/>
</td>       
</tr>	
    <tr>
    <td>Plate quantity:</td>
    <td>&nbsp;<?php echo $plate; ?></td>
    <td><select name="plate" class="input">
      <option value="">seclect</option>
      <option value="">-------</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select></td>
    </tr>
	
        	<tr>
            <td></td>
            <td><input type="hidden" value="<?php echo $targetID ?>" name="thisID"/><input name="submit" id="button" type="submit" value="submit"/></td>
</tr>
</table></center>
</form>
</div><!--content div-->
   <!------------------------------------------------CONTENT---------------------------------------------------------------->



   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">
<?php }
   $object->footer($cname); ?>

</div><!--footer div-->
   <!------------------------------------------------FOOTER---------------------------------------------------------------->
</div>

</body>
</html>