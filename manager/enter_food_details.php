<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();

if($_SESSION['auth']==1){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>enter Food details</title>
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
<?php
if(isset($_POST['submit'])){
$foodname=mysql_real_escape_string($_POST['foodname']);
$foodcost=mysql_real_escape_string($_POST['foodcost']);
$foodcategory=mysql_real_escape_string($_POST['foodcategory']);

if($foodname==""){$error[]="Enter A food name";}
			if($foodcost==""){$error[]="Please specify amount";}
			if(!is_numeric($foodcost)){$error[]="Food cost  must be in numeric characters";}
			if($foodcategory==""){$error[]="Enter A food name";}

	if(!empty($error)){
		echo "<p class='msg warning'><b>Oops! ERROR:</b></p>";
		foreach($error as $oops){
			echo "<p class='msg error'>$oops</p>";
			}//foreach loop
		}//if !empty error

		//if $error variable is empty, continue with the script
		elseif(empty($error)){
			
$a=$object->query("INSERT INTO `food` (`food_name`, `cost`, `category`) VALUES ('$foodname', '$foodcost', '$foodcategory')");

 header("location:enter_food_details.php?enter=1");
}
}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
<center><table width="500" border="0">
<h1><?php if($_GET['enter']==1){
	
echo " Food Has Been Successfully Added";	
}?></h1>
<tr>
<td height="55">Food Name</td>
<td>
<input type="text" name="foodname" placeholder="E.g Eba" /></td>
  <tr>              
<td height="50">Food Cost</td>
 <td>
<input type="text" name="foodcost"/></td>       
</tr>	
    <tr>
    <td height="36">Food Category</td>
    <td><input type="text" name="foodcategory"/></td>
    </tr>
	
       	  <tr>
            <td></td>
            <td><br/><input name="submit" id="button" type="submit" value="submit"/></td>
</tr>
</table></center>
</form>
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