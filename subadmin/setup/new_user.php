<?php 
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors','1');
include("../../class.php");
include("../../connect.php");
$object=new hms();
if($_SESSION['executive']==1){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>new user</title>
<link href="../../css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
  
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
                              <?php $object->head2("logo"); ?>

    		<table width="100%">
            <tr>
            <td width="15%">&nbsp;</td>
<td width="50%">	<h1>&nbsp;</h1></td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php

if(isset($_GET['deleteid'])){
echo 'Do you really want to delete user with ID of '.$_GET['deleteid'].'? <a href="new_user.php?yesdelete='.$_GET['deleteid'].'">Yes </a>| <a href="new_user.php">No</a>';
exit();

}

if(isset($_GET['yesdelete'])){
	$id_to_delete=$_GET['yesdelete'];
	$sql=mysql_query("DELETE FROM `user` WHERE `id`='$id_to_delete' limit 1") or die(mysql_error());
	
	header("location:new_user.php");
	exit();
}
	

?>
<?php
if(isset($_POST['button'])){
	$user_name=mysql_real_escape_string($_POST['username']);
		$password=mysql_real_escape_string($_POST['password']);
		$dept=mysql_real_escape_string($_POST['dept']);
		
		if($user_name==""){$error[]="Enter A username";}
			if($password==""){$error[]="Please Enter Password";}

			if($dept==""){$error[]="Please Enter User department";}
	if(!empty($error)){
		echo "<p class='msg warning'><b>Oops! ERROR:</b></p>";
		foreach($error as $oops){
			echo "<p class='msg error'>$oops</p>";
			}//foreach loop
		}//if !empty error

		//if $error variable is empty, continue with the script
		elseif(empty($error)){
include("../../connect.php");
			
	$sql=mysql_query("SELECT `id` FROM `user` WHERE `username`='$user_name' limit 1");
	$productMatch=mysql_num_rows($sql);
	if($productMatch > 0){
		echo "Sorry you tried place a duplicate username into the system, <a href='new_user.php'>Click Here!!!</a>";
		exit();
	}
	$sql=mysql_query("INSERT INTO `user`(`username`,`password`,`dept`,`entrydate`)
											 VALUES('$user_name','$password','$dept',NOW())") or die(mysql_error());

header("location:../../index.php");
	exit();
}
}
	?>


<a name="inventoryForm" id="inventoryForm"></a>
<h3>&darr; Add New User Form &darr;</h3><br/><br/>
<form action="new_user.php" method="post"  enctype="multipart/form-data" name="myForm" id="myForm">
<table width="90%" border="0" cellspacing="0" cellpadding="6">
<tr>
<td width="21%" height="53">Username</td>
<td width="79%"><input type="text" name="username" id="username" size="64"/></td>
</tr>
<tr>
<td height="39">Password</td>
<td><label><input type="text" name="password" id="password" size="12"/></label></td>
</tr>
<tr>
<td height="39">Department</td>
<td><label><input type="text" name="dept" id="dept" size="12"/></label></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><label><input type="submit" name="button" id="button" value="Add This User Now"/></label></td>
</tr>
</table>
</form>
<br/>
<br/>
<br/>


<?php
ob_flush();
?>


</div><!--content div-->
   <!------------------------------------------------CONTENT---------------------------------------------------------------->



   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">
<?php include_once('footer.php'); ?>

</div><!--footer div-->
   <!------------------------------------------------FOOTER---------------------------------------------------------------->
</div>

</body>
</html>
<?php
}
else{
	header("location:executive+login.php?access=denied");}
	?>