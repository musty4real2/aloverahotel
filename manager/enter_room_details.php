<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();

if($_SESSION['auth']==1){
?>?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>enter room details</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
                              <?php $object->head("logo");?>

    		<table width="100%">
            <tr>
            <td width="15%">			
</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="admin_menu.php" style="color:#FFF;">Home</a></td> 

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php
if(isset($_POST['submit'])){
$roomname=mysql_real_escape_string($_POST['roomname']);
$roomcost=mysql_real_escape_string($_POST['roomcost']);
$roomcategory=mysql_real_escape_string($_POST['roomcategory']);
$roomlocation=mysql_real_escape_string($_POST['roomlocation']);
$roomtype=mysql_real_escape_string($_POST['roomtype']);

if($roomname==""){$error[]="Enter A Room Number";}
			if($roomcost==""){$error[]="Please specify Room Cost";}
			if(!is_numeric($roomcost)){$error[]="Room cost  must be in numeric characters";}
			if($roomcategory==""){$error[]="Enter Room category";}

			if($roomlocation==""){$error[]="Enter Room Location";}
			if($roomtype==""){$error[]="Enter Room Type";}

	if(!empty($error)){
		echo "<p class='msg warning'><b>Oops! ERROR:</b></p>";
		foreach($error as $oops){
			echo "<p class='msg error'>$oops</p>";
			}//foreach loop
		}//if !empty error

		//if $error variable is empty, continue with the script
		elseif(empty($error)){
$a=$object->query("INSERT INTO `rooms` (`room_number`, `cost`, `room_category`, `room_location`, `room_type`, `room_availability`) VALUES ('$roomname', '$roomcost', '$roomcategory', '$roomlocation', '$roomtype', '')");

 header("location:enter_room_details.php?enter=1");
}
}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
<center><table width="500" border="0">
<h1><?php if($_GET['enter']==1){
	
echo " Room Has Been Successfully Added";	
}?></h1>
<tr>
<td>Room Number</td>
<td>
<input type="text" name="roomname" placeholder="E.g Alovera hotels" /></td>
  <tr>              
<td height="54">Room Cost</td>
 <td>
<input type="text" name="roomcost"/></td>       
</tr>	
    <tr>
    <td height="46">Room Category</td>
    <td><input type="text" name="roomcategory"/></td>
    </tr>
	
      <tr>
    <td height="64">Room Location</td>
    <td><input type="text" name="roomlocation" /></td>
    </tr>

    <tr>
    	<td height="38">Room Type:</td>
        <td><input type="text" size="35" class="input" name="roomtype" /></td>
  </tr>
        	<tr>
            <td></td>
            <td><input name="submit" id="button" type="submit" value="submit"/></td>
</tr>
</table></center>
</form>
</div><!--content div-->

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