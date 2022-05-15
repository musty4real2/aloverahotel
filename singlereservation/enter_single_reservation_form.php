<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
ob_start();
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
<title>check in Single Guest here</title>
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
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="../recepmenu1.php" style="color:#FFF;">Home</a></td> 
  <td width="14%">&nbsp;</td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php
if(isset($_POST['submit'])){
$surname=mysql_real_escape_string($_POST['surname']);
$othernames=mysql_real_escape_string($_POST['othernames']);
$amount=mysql_real_escape_string($_POST['amount']);
$phonenumber=mysql_real_escape_string($_POST['phonenumber']);
$inideposit=mysql_real_escape_string($_POST['inideposit']);
$deposit=mysql_real_escape_string($_POST['deposit']);
$arrivefrom=mysql_real_escape_string($_POST['arrivefrom']);
$nextdestination=mysql_real_escape_string($_POST['nextdestination']);
$receptionist=mysql_real_escape_string($_POST['receptionist']);
$occupation=mysql_real_escape_string($_POST['occupation']);
$title=mysql_real_escape_string($_POST['title']);
$sex=mysql_real_escape_string($_POST['sex']);
$email=mysql_real_escape_string($_POST['email']);
$fulladdress=mysql_real_escape_string($_POST['fulladdress']);

$identification=mysql_real_escape_string($_POST['identification']);
$roomid2=mysql_real_escape_string($_POST['roomid']);
$billing_no="S".rand(1,1000000000)."ALO";//	   $timestamp=mysql_real_escape_string($_POST['timestamp'])=time();
	//   $billingno=mysql_real_escape_string($_POST['billnum']="S".rand(1,1000000000)."ALO";

	   	$day=mysql_real_escape_string($_POST['day']);
	$month=mysql_real_escape_string($_POST['month']);
	$year=mysql_real_escape_string($_POST['year']);
	
			$checkoutdate=$year."-".$month."-".$day;
			
			if($surname==""){$error[]="Please specify the Surname of the Guest";}
					if($phonenumber==""){$error[]="Please specify Phone number";}
			if(!is_numeric($phonenumber)){$error[]="Phone Number must be numeric";}
			
					if($inideposit==""){$error[]="Please specify Amount Collected";}
			if(!is_numeric($inideposit)){$error[]="Amount Collected must be numeric";}

			if($surname==""){$error[]="Please specify the Othername of the Guest";}
			if($occupation==""){$error[]="Please specify the Occupation of the Guest";}
				if($fulladdress==""){$error[]="Please specify the full Address of the Guest";}
					if($receptionist==""){$error[]="Please specify the Receptionist name";}

	if(!empty($error)){
		echo "<p class='msg warning'><b>Oops! ERROR:</b></p>";
		foreach($error as $oops){
			echo "<p class='msg error'>$oops</p>";
			}//foreach loop
		}//if !empty error

		//if $error variable is empty, continue with the script
		elseif(empty($error)){


$update=$object->query("UPDATE `rooms` SET `room_availability` = '1' WHERE `id` ='$roomid2'");
$auto=$object->query("SELECT `id` ,`room_number`, `room_category`,`room_location`,`cost` FROM `rooms` WHERE `id`='$roomid2'");

 while($row=mysql_fetch_array($auto)){
$roomid=$row['id'];
$roomcategory=$row['room_category'];
$roomnumber=$row['room_number'];
$roomlocation=$row['room_location'];
$roomcost1=$row['cost'];
 }

$sql=$object->query("INSERT INTO `single` (`surname`, `othername`, `phonenumber`, `inidep`, `receptionist`, `occupation`, `title`, `arrive_from`, `next_destination`, `checkin_date`, `billingno`, `checkout_date`, `sex`, `roomid`,`checkin_time`,`email`,`identification`,`fulladdress`,`room2_id`,`date_of_change`,`checkout`) VALUES ('$surname', '$othernames', '$phonenumber','$inideposit', '$receptionist', '$occupation', '$title', '$arrivefrom', '$nextdestination', NOW(),'$billing_no', '$checkoutdate', '$sex','$roomid2',NOW(),'$email','$identification','$fulladdress','','','')");

$guestid=mysql_insert_id($connection);
$sql2=$object->query("INSERT INTO `accountbalance` (`guestid`, `entrydate`, `initial_deposit`, `grand_total`, `refund`, `balance`) VALUES ('$guestid', NOW(), '$inideposit', '', '', '')");
header("location:temp_single_reservation_reciept.php?surname=$surname&othername=$othernames&phonenumber=$phonenumber&inideposit=$inideposit&receptionist=$receptionist&occupation=$occupation&arrivefrom=$arrivefrom&nextdestination=$nextdestination&billing_no=$billing_no&checkoutdate=$checkoutdate&guesttype=$sex&roomid2=$roomid2&title=$title&email=$email&identification=$identification&fulladdress=$fulladdress");

}
}
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

<table width="768" border="0">
    	<tr>
       	  <td width="195"><p class="orange">Basic Info:</p></td>
        	<td width="202"></td>
       	  <td width="357"></td>
        </tr>
           <tr>
        	<td></td>
        	<td>Title:</td>
        	<td height="29"><input class="input" type="text" size="35" name="title" value="<?php if(isset($_POST['title'])){ echo $_POST['title'];}?>"/>*</td>
        </tr>
        <tr>
        	<td></td>
        	<td>surname:</td>
        	<td height="15"><input class="input" type="text" size="35" name="surname" value="<?php if(isset($_POST['surname'])){ echo $_POST['surname'];}?>"/>*</td>
        </tr>
        <tr>
        	<td></td>
        	<td>Other names:</td>
        	<td height="36"><input class="input" type="text" size="35" name="othernames" value="<?php if(isset($_POST['othernames'])){ echo $_POST['othernames'];}?>"/>*</td>
        </tr>
        <tr>
        	<td></td>
        	<td>phone Number:</td>
        	<td height="34"><input class="input" type="text" size="35" name="phonenumber" value="<?php if(isset($_POST['phonenumber'])){ echo $_POST['phonenumber'];}?>"/></td>
        </tr>
          <tr>
        	<td></td>
        	<td>occupation:</td>
        	<td height="36"><input class="input" type="text" size="35" name="occupation" value="<?php if(isset($_POST['occupation'])){ echo $_POST['occupation'];}?>"/></td>
            
        </tr>
             <tr>
        	<td></td>
        	<td>Sex:</td>
        	<td height="36"><input class="input" type="radio" size="35" name="sex" value="Male"/>Male <input class="input" type="radio" size="35" name="sex" value="Female"/>Female </td>
            
        </tr>
                	  <tr>
        	    <td height="32"></td>
       	 	 <td>Arrive From</td>
        	<td><input type="text" class="input" name="arrivefrom" size="35" value="<?php if(isset($_POST['arrivefrom'])){ echo $_POST['arrivefrom'];}?>"/></td>
        </tr>
        	  <tr>
        	    <td height="31"></td>
       	 	 <td>Next Destination:</td>
        	<td><input type="text" class="input" name="nextdestination" size="35" value="<?php if(isset($_POST['nextdestination'])){ echo $_POST['nextdestination'];}?>"/></td>
        </tr>
           	  <tr>
        	    <td height="31"></td>
       	 	 <td>Email Address:</td>
        	<td><input type="text" class="input" name="email" size="35" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>"/></td>
        </tr>
           	  <tr>
        	    <td height="31"></td>
       	 	 <td>Form of Identification:</td>
        	<td>
            <select name="identification" >   
			<option value="">*****</option>
            <option value="School ID">School ID</option>
            <option value="Drivers License">Driver's License</option>
            <option value="National ID">National ID</option>
            <option value="International Passport">International Passport</option>
            <option value="Voters Card">Voter's Card</option>
            <option value="others">others</option>
            </select>
            
            </td>
        </tr>
	  <tr>
        	    <td height="31"></td>
       	 	 <td>Full Address:</td>
        	<td><input type="text" class="input" name="fulladdress" size="35" value="<?php if(isset($_POST['fulladdress'])){ echo $_POST['fulladdress'];}?>"/></td>
        </tr>
		        <tr>
        	<td></td>
        	<td></td>
        	<td></td>
        </tr>
       <tr>
      <tr>
        	<td></td>
        	<td></td>
        	<td></td>
      </tr>
       <tr>

      <tr>
        	<td height="17"><p class="orange">Reservation Info:</p></td>
        	<td></td>
        	<td></td>
      </tr>
<tr>              	<td></td>

<td>select room</td>
 <td height="34"><?php
 include('../connect.php');
$auto=$object->query("SELECT `id` ,`room_number`, `room_category`,`room_location` FROM `rooms` WHERE `room_availability`=0 ORDER BY 'room_category' DESC ");
 
 ?>

 <select   class="input" name='roomid'>
  <option value=''>select</option>
  <option value=''>----------</option>
  <?php 
 while($row=mysql_fetch_array($auto)){
$roomid=$row['id'];
$roomcategory=$row['room_category'];
$roomnumber=$row['room_number'];
$roomlocation=$row['room_location'];
$roomcost=$row['cost'];
echo "<option value='$roomid'> $roomnumber $roomcategory $roomlocation</option>";
}
 ?>  
 <?php if(isset($_POST['roomid'])){echo "<option  value='{$_POST['roomid']}' selected='selected'>{$_POST['roomid']}</option>"; }?>

 </select></td>       
 <tr>
       	  	<td></td>
        	<td></td>
       	 	 <td></td>
      </tr>
         <tr>
        	<td></td>
     </td>
      </tr>
        <tr>
        	    <td height="39"></td>
       	 	 <td>Initial Deposit:</td>
        	<td><input type="text" class="input" size="35" name="inideposit" value="<?php if(isset($_POST['inideposit'])){ echo $_POST['inideposit'];}?>"/></td>
        </tr>
		        <tr>
        	    <td height="34"></td>
       	 	 <td>Confirm Initial Deposit:</td>
        	<td><input type="text" class="input" size="35" name="deposit" value="<?php if(isset($_POST['deposit'])){ echo $_POST['deposit'];}?>"/></td>
        </tr>
         <tr>
        	   <td height="29"></td>
       	 	 <td>receptionist:</td>
             <td><input class="input" type="text" name="receptionist" size="35" value="<?php if(isset($_POST['receptionist'])){ echo $_POST['receptionist'];}?>"/>*</td>
        </tr>
        <tr>
        <td height="54"></td>
        <td>Date expected to checkout</td>
        <td height="54"><select name="day" class="input" id="day" ">
  <option value="">select</option>
  <option value="">............</option>
  <?php
		 $range=range(1, 31);
		 foreach($range as $r){
			 echo "<option value='$r'>$r</option>";
			 }
			 ?>
          <?php if(isset($_POST['day'])){echo "<option  value='{$_POST['day']}' selected='selected'>{$_POST['day']}</option>"; }?>
</select></label>
<select name="month" id="month" class="input">
  <option value="">select</option>
  <option value="">............</option>
  <?php
		 $range=range(1, 12);
		 foreach($range as $r){
			 echo "<option value='$r'>$r</option>";
			 }
			 ?>
  <?php if(isset($_POST['month'])){echo "<option  value='{$_POST['month']}' selected='selected'>{$_POST['month']}</option>"; }?>
</select>
<select name="year" id="year2" class="input">
  <option value="">select</option>
  <option value="">............</option>
  <?php
		 $range=range(2012, 2020);
		 foreach($range as $r){
			 echo "<option value='$r'>$r</option>";
			 }
			 ?>
  <?php if(isset($_POST['year'])){echo "<option  value='{$_POST['year']}' selected='selected'>{$_POST['year']}</option>"; }?>
</select>
              
</tr>
       <tr>
	   <td></td>
	   <td>  </td>
	   <td height="15"> <input id="button" type="submit" value="Check guest in" name="submit" /></td>
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
ob_flush();

?><?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>