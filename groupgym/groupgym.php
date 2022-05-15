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
<title>Enter Gym</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="gymmenu1.php" style="color:#FFF;">Home</a></td> 
  <td width="14%"></td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
	<?php
$a=$object->query("SELECT * FROM `section` WHERE `section_name`='gym' AND `visibility`='1' ");
?>
<?php
if(mysql_num_rows($a)==0){echo "This Module Wasn't Installed";}
elseif(mysql_num_rows($a)>0){
?>

<?php
if(isset($_POST['submit'])){
$name=mysql_real_escape_string($_POST['name']);
$numberofguest=mysql_real_escape_string($_POST['numguest']);
$guest=mysql_real_escape_string($_POST['guest']);
$waiter=mysql_real_escape_string($_POST['attendant']);

$cost=$guest * 500;
if($numberofguest != $guest){
	$error[]="the number of guest selected doesn't correspond to the comfirmation made";
}
			if($numberofguest==""){$error[]="Please specify Number of Guest";}
			if($waiter==""){$error[]="Please specify the name of the Attendant";}

	if(!empty($error)){
		echo "<p class='msg warning'><b>Oops! ERROR:</b></p>";
		foreach($error as $oops){
			echo "<p class='msg error'>$oops</p>";
			}//foreach loop
		}//if !empty error

		//if $error variable is empty, continue with the script
		elseif(empty($error)){
$a=$object->query("INSERT INTO `groupgym` (`guestid` ,`entrydate` ,`time` ,`num` ,`cost` ,`attendant`)VALUES ('$name', NOW(), NOW(), '$guest', '$cost', '$waiter')");

header("location:temp_groupgym_reciept.php?name=$name&numberofguest=$numberofguest&waiter=$waiter&cost=$cost");
}

}
?>
<form name="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<center><table width="500" border="0">
<tr>
<td>&nbsp;</td>
<td>
 <?php
$auto=$object->query("SELECT `id` ,`companyname`, `surname` ,  `othername` FROM `group` WHERE `checkout`='0' ORDER BY
 `surname`  DESC");
?>
<tr>
<td height="59">Guest name</td>
<td>


 <select class="input" name='name'>
  <option value=''>select</option>
  <option value=''>----------</option>
  <?php 
 while($row=mysql_fetch_array($auto)){
$id=$row['id'];
$surname=$row['surname'];
$oname=$row['othername'];
$companyname=$row['companyname'];
echo "<option value='$id'>$surname, $oname, from ($companyname)</option>";
}
 ?>
 </select>
</td>
</tr>

<tr >
   	<td height="69">Number of Guests:</td>
    <td><select name="numguest" class="input" id="day" ">
            <option value="">select</option>
            <option value="">............</option>
            <?php
		 $range=range(1, 100);
		 foreach($range as $r){
			 echo "<option value='$r'>$r</option>";
			 }
			 ?>
            <?php if(isset($_POST['numguest'])){echo "<option  value='{$_POST['numguest']}' selected='selected'>{$_POST['numguest']}</option>"; }?>
  </select></td>
    </tr>
	   <tr>
   	<td>Confirm number of Guests:</td>
    <td><select name="guest" class="input" id="day" ">
            <option value="">select</option>
            <option value="">............</option>
            <?php
		 $range=range(1, 100);
		 foreach($range as $r){
			 echo "<option value='$r'>$r</option>";
			 }
			 ?>
            <?php if(isset($_POST['guest'])){echo "<option  value='{$_POST['guest']}' selected='selected'>{$_POST['guest']}</option>"; }?>
  </select></td>    </tr>

    <tr>
        	<td height="54">Attendant:</td>
        <td><input class="input" type="text" size="35" name="attendant" /></td></tr>
        <tr>
        <td></td>
	<td>  <input type="submit" id="button" name="submit" value="submit"/></td>
    </tr>

</table></center>
</form>
</div><!--content div-->
<?php
}
?>
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
}
else {
	header("location:../index.php?access=denied");
	}
	?>