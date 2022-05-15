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
	 <article id="b4_head">
     <div id="head">
                         <?php $object->head("logo");?>
     </div></article>
       <table width="100%">
         <tr>
            <td width="15%">			
<td width="50%">&nbsp;
</td>
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="gymmenu1.php" style="color:#FFF;">Home</a></td> 
  <td width="14%"></td>

 </tr>

 </table>
 

 </div>
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


$a=$object->query("INSERT INTO `singlegym` (`guestid` ,`entrydate` ,`time` ,`num` ,`cost` ,`attendant`)VALUES ('$name', NOW(), NOW(), '$guest', '$cost', '$waiter')");


header("location:temp_singlegym_reciept.php?name=$name&numberofguest=$numberofguest&waiter=$waiter&cost=$cost");
}
}
?>
<form name="" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<center><table width="500" border="0">
<tr class="table">
<td>&nbsp;</td>
<td>
 <?php
$auto=$object->query("SELECT `id` , `surname` ,  `othername` FROM `single` WHERE `checkout`='0' ORDER BY
 `surname` DESC");
?>
<tr class="table2">
<td>Guest name</td>
<td>


 <select class="input" style="width:200px;" name='name'>
  <option value='' >select</option>
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
</td>
</tr>

<tr class="table" >
   	<td>Number of Guests:</td>
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
	   <tr class="table2" >
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
  </select></td>
    </tr>

    <tr class="table">
        	<td>Attendant:</td>
        <td><input class="input" style="width:200px;" type="text" size="35" name="attendant" value="<?php if(isset($_POST['attendant'])){ echo $_POST['attendant'];}?>"/></td></tr>
        <tr class="table2">
        <td></td>
	<td width="350"> <br /> <input type="submit" id="button" name="submit" value="submit"/></td>
    </tr>

</table></center>
</form>
</div><!--content div-->
   <!------------------------------------------------CONTENT---------------------------------------------------------------->



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
?>
<?php
}
else {
	header("location:index.php?access=denied");
	}
	?>
	