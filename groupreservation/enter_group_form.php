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
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<title>check in Group Guest here</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="../groupmenu1.php" style="color:#FFF;">Home</a></td> 
  <td width="14%">&nbsp;</td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php
if(isset($_GET['submit'])){
$cname=mysql_real_escape_string($_GET['cname']);
$num=mysql_escape_string($_GET['num']);

header("location:enter_group_reservation_form.php?cname={$_GET['cname']}&num={$_GET['num']}");
}

?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="get"/>

<table width="768" border="0">
    	<tr>
       	  <td width="195"><p class="orange">Company Info:</p></td>
        	<td width="202"></td>
       	  <td width="357"></td>
        </tr>
           <tr>
        	<td></td>
        	<td>Group Name:</td>
        	<td height="29"><input class="input" type="text" size="35" name="cname" value="<?php if(isset($_POST['cname'])){ echo $_POST['cname'];}?>" />*</td>
        </tr>
        <tr>
          <td height="54"></td>
          <td>Number of Guest</td>
          <td height="54"><select name="num" class="input" id="day" ">
            <option value="">select</option>
            <option value="">............</option>
            <?php
		 $range=range(1, 500);
		 foreach($range as $r){
			 echo "<option value='$r'>$r</option>";
			 }
			 ?>
            <?php if(isset($_GET['num'])){echo "<option  value='{$_GET['num']}' selected='selected'>{$_GET['num']}</option>"; }?>
  </select></label></tr>
       <tr>
	   <td></td>
	   <td>  </td>
	   <td height="15"> <input id="button" type="submit" value="Next" name="submit" /></td>
</tr>
 </table>





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