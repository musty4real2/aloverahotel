<?php 
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors','1');
include("../connect.php");
include("../class.php");
$object=new hms();
if($_SESSION['auth']==1){
?>



<?php
if(isset($_POST['button'])){	
	$pid=mysql_real_escape_string($_POST['thisID']);
	$user_name=mysql_real_escape_string($_POST['user_name']);
		$password=mysql_real_escape_string($_POST['password']);
		$dept=mysql_real_escape_string($_POST['dept']);
	
	$sql=mysql_query("UPDATE `user` SET `username`='$user_name',`password`='$password',`dept`='$dept',`entrydate`=NOW() WHERE `id`='$pid' ");

header("location:new_user.php");
	exit();
}
	?>
    <?php
if(isset($_GET['pid'])){
	$targetID=$_GET['pid'];
$sql=mysql_query("SELECT * FROM `user` WHERE `id`='$targetID' LIMIT 1");
$productCount= mysql_num_rows($sql);
if($productCount>0){
	while($row=mysql_fetch_array($sql)){
				$user_name=$row['username'];
				$password=$row['password'];

				$dept=$row['dept'];
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
<title>user edit</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="admin_menu.php" style="color:#FFF;">Home</a></td> 

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">

  <h2>User List</h2>
<a name="inventoryForm" id="inventoryForm"></a>
<h3>&darr; Edit New Inventory Item Form &darr;</h3>
<form action="user_edit.php" method="post"  enctype="multipart/form-data" name="myForm" id="myForm">
<table width="90%" border="0" cellspacing="0" cellpadding="6">
<tr>
<td width="21%">Userame</td>
<td width="79%"><input type="text" name="user_name" id="user_name" size="64" value="<?php echo $user_name; ?>"/></td>
</tr>
<tr>
<td>Password</td>
<td><label><input type="text" name="password" id="password" size="12" value="<?php echo $password; ?>"/></label></td>
</tr>
<tr>
<td>Department</td>
<td><label><input type="text" name="dept" id="dept" size="12" value="<?php echo $dept; ?>"/></label></td>
</tr
><tr>
<td>&nbsp;</td>
<td><label><input type="hidden" value="<?php echo $targetID ?>" name="thisID"/><input type="submit" name="button" id="button" value="Make Changes"/></label></td>
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