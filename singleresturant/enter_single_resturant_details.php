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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="singleresmenu.php" style="color:#FFF;">Home</a></td> 

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
	<?php
$a=$object->query("SELECT * FROM `section` WHERE `section_name`='restaurant' AND `visibility`='1' ");
?>
<?php
if(mysql_num_rows($a)==0){echo "This Module Wasn't Installed";}
elseif(mysql_num_rows($a)>0){
?>

<?php
if(isset($_POST['submit'])){
$name=mysql_real_escape_string($_POST['name']);
$idfood=mysql_real_escape_string($_POST['foodid']);
$plate=mysql_real_escape_string($_POST['plate']);
$waiter=mysql_real_escape_string($_POST['waiter']);
$foodcost=mysql_real_escape_string($_POST['foodcost']);
$cost=$foodcost * $plate;

if($name==""){$error[]="Please Select A Name ";}
			if($plate==""){$error[]="Please specify number of plate";}
			if($waiter==""){$error[]="Please specify the name of the waiter";}
									
	if(!empty($error)){
		echo "<p class='msg warning'><b>Oops! ERROR:</b></p>";
		foreach($error as $oops){
			echo "<p class='msg error'>$oops</p>";
			}//foreach loop
		}//if !empty error

		//if $error variable is empty, continue with the script
		elseif(empty($error)){


$a=$object->query("INSERT INTO `singleresturant` (`guestid`, `food_id`, `plate`, `cost`, `entrydate`, `time`, `waiter`) 
VALUES('$name', '$idfood', '$plate', '$cost',NOW(), NOW(),'$waiter')");

 header("location:temp_single_resturant_reciept.php?name=$name&foodid=$idfood&plate=$plate&waiter=$waiter&cost=$cost");
}
}
?>
 <?php
$auto=$object->query("SELECT `id` , `surname` ,  `othername` FROM `single` WHERE `checkout`='0' ORDER BY
 `surname` DESC");
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
<center><table width="500" border="0">
<tr>
<td>Guest name</td>
<td>
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
 <td><?php
 include('connect.php');
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
    <td>Confirm Plate quantity:</td>
    <td><select name="plt" class="input">
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
    	<td>Waiter:</td>
        <td><input type="text" size="35" class="input" name="waiter" /></td>
  </tr>
        	<tr>
            <td></td>
            <td><input name="submit" id="button" type="submit" value="submit"/></td>
</tr>
</table></center>
</form>
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