<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();
if($_SESSION['auth']==1){
?>

<?php
if(isset($_POST['submit'])){
		$pid=mysql_real_escape_string($_POST['thisID']);
	
$id=mysql_real_escape_string($_POST['name']);
$n=mysql_real_escape_string($_POST['numguest']);
$w=mysql_real_escape_string($_POST['attendant']);

$co=$n * 500;
	
	$sql=$object->query("UPDATE `groupgym` SET `guestid`='$id',`num`='$n',`attendant`='$w',`cost`='$co' WHERE `guestid`='$pid' limit 1 ");
	
header("location:group_gym_delete.php");
	exit();
}
	?>
    <?php
if(isset($_GET['pid'])){
	$targetID=$_GET['pid'];
$sql=$object->query("SELECT * FROM `groupgym` WHERE `guestid`='$targetID' LIMIT 1");
$productCount= mysql_num_rows($sql);
if($productCount>0){
	while($row=mysql_fetch_array($sql)){
		$name=$row['guestid'];
$numberofguest=$row['num'];
$waiter=$row['attendant'];
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="edit_menu2.php" style="color:#FFF;">Home</a></td> 
  <td width="14%"></td>

 </tr>

 </table>
 

 </div>
</div>
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php
if(isset($_POST['submit'])){

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


}
}
?>
<form action="groupgym_edit_details.php" method="post"  enctype="multipart/form-data" name="myForm" id="myForm">
<center><table width="500" border="0">
<tr class="table">
<td>&nbsp;</td>
<td>
 <?php
$auto=$object->query("SELECT `id` , `surname` ,  `othername` FROM `group` WHERE `checkout`='0' ORDER BY
 `surname` DESC");
?>
      <tr class="treven">
<td>Guest name</td>
<td><?php echo $object->getGuestName2($name);?> </td>
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

      <tr class="treven">
   	<td>Number of Guests:</td>
    <td><?php echo $numberofguest; ?></td>
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

      <tr class="treven">
        	<td>Attendant:</td>
            <td></td>

        <td><input class="input" style="width:200px;" type="text" size="35" name="attendant" value="<?php echo $waiter; ?>"/></td></tr>
        <tr class="table2">
        <td></td>
	<td width="350"> <br /> <input type="hidden" value="<?php echo $targetID ?>" name="thisID"/><input type="submit" id="button" name="submit" value="submit"/></td>
    </tr>

</table></center>
</form>
</div><!--content div-->
   <!------------------------------------------------CONTENT---------------------------------------------------------------->



   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">
<?php 
}
    $object->footer($cname); ?>


</div><!--footer div-->
   <!------------------------------------------------FOOTER---------------------------------------------------------------->
</div>
</body>
</html>