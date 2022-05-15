<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
ob_start();
include("../class.php");
include("../connect.php");
$object=new hms();
if($_SESSION['auth']==1){
?>

<?php
if(isset($_POST['submit'])){	
	$pid=mysql_real_escape_string($_POST['thisID']);
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

	   	$day=mysql_real_escape_string($_POST['day']);
	$month=mysql_real_escape_string($_POST['month']);
	$year=mysql_real_escape_string($_POST['year']);
	
			$checkoutdate=$year."-".$month."-".$day;
	$sql=$object->query("UPDATE `single` SET  `surname`='$surname', `othername`='$othernames', `phonenumber`='$phonenumber', `inidep`='$inideposit', `receptionist`='$receptionist', `occupation`='$occupation', `title`='$title', `arrive_from`='$arrivefrom', `next_destination`='$nextdestination', `checkout_date`='$checkoutdate', `sex`='$sex',`email`='$email',`identification`='$identification',`fulladdress`='$fulladdress' WHERE `id`='$pid' LIMIT 1");

$guestid=mysql_insert_id($connection);
$sql2=$object->query("UPDATE `accountbalance` SET `guestid`='$guestid',`initial_deposit`='$inideposit'  WHERE `guestid`='$pid'  LIMIT 1");

header("location:singledelete.php");
	exit();
}
	?>
    <?php
if(isset($_GET['pid'])){
	$targetID=$_GET['pid'];
$sql=mysql_query("SELECT * FROM `single` WHERE `id`='$targetID' LIMIT 1");
$productCount= mysql_num_rows($sql);
if($productCount>0){
	while($row=mysql_fetch_array($sql)){
$surname=$row['surname'];
$othernames=$row['othername'];
$amount=$row['amount'];
$phonenumber=$row['phonenumber'];
$inideposit=$row['inidep'];
$arrivefrom=$row['arrive_from'];
$nextdestination=$row['next_destination'];
$receptionist=$row['receptionist'];
$occupation=$row['occupation'];
$title=$row['title'];
$sex=$row['sex'];
$email=$row['email'];
$fulladdress=$row['fulladdress'];

$identification=$row['identification'];
			$checkoutdate=$row['checkout_date'];
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
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<title>Edit Single Guest here</title>
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
  <td width="14%">&nbsp;</td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<?php
if(isset($_POST['submit'])){

	
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


}
}
?>

<form action="edit_single_reservation_details.php" method="post"  enctype="multipart/form-data" name="myForm" id="myForm">

<table width="768" border="0">
    	<tr>
       	  <td width="130"><p class="orange">Basic Info:</p></td>
        	<td width="137"></td>
       	  <td width="214"></td>
        </tr>
           <tr>
        	<td></td>
        	<td>Title:</td>
        	<td height="29"><input class="input" type="text" size="35" name="title" value="<?php echo $title; ?>"/>*</td>
        </tr>
        <tr>
        	<td></td>
        	<td>surname:</td>
        	<td height="15"><input class="input" type="text" size="35" name="surname" value="<?php echo $surname; ?>"/>*</td>
        </tr>
        <tr>
        	<td></td>
        	<td>Other names:</td>
        	<td height="36"><input class="input" type="text" size="35" name="othernames" value="<?php echo $othernames; ?>"/>*</td>
        </tr>
        <tr>
        	<td></td>
        	<td>phone Number:</td>
        	<td height="34"><input class="input" type="text" size="35" name="phonenumber" value="<?php echo $phonenumber; ?>"/></td>
        </tr>
          <tr>
        	<td></td>
        	<td>occupation:</td>
        	<td height="36"><input class="input" type="text" size="35" name="occupation" value="<?php echo $occupation; ?>"/></td>
            
        </tr>
             <tr>
        	<td></td>
        	<td>Sex:</td>
        	<td height="36"><input class="input" type="text" size="35" name="sex" value="<?php echo $sex; ?>"/> </td>
            
        </tr>
                	  <tr>
        	    <td height="32"></td>
       	 	 <td>Arrive From</td>
        	<td><input type="text" class="input" name="arrivefrom" size="35" value="<?php echo $arrivefrom; ?>"/></td>
        </tr>
        	  <tr>
        	    <td height="31"></td>
       	 	 <td>Next Destination:</td>
        	<td><input type="text" class="input" name="nextdestination" size="35" value="<?php echo $nextdestination; ?>"/></td>
        </tr>
           	  <tr>
        	    <td height="41"></td>
       	 	 <td>Email Address:</td>
        	<td><input type="text" class="input" name="email" size="35" value="<?php echo $email; ?>"/></td>
        </tr>
           	  <tr>
        	    <td height="70"></td>   
                      	 	 <td>Form of Identification:</td>

                
        	<td width="269">
            <select name="identification" >   
			<option value="">*****</option>
            <option value="<?php echo $identification ;?>" selected="selected"><?php echo $identification;?></option>
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
        	<td><input type="text" class="input" name="fulladdress" size="35" value="<?php echo $fulladdress; ?>"/></td>
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
        	<td><input type="text" class="input" size="35" name="inideposit" value="<?php echo $inideposit; ?>"/></td>
        </tr>
         <tr>
        	   <td height="29"></td>
       	 	 <td>receptionist:</td>
             <td><input class="input" type="text" name="receptionist" size="35" value="<?php echo $receptionist; ?>"/>*</td>
        </tr>
        <tr>
        <td height="54"></td>
        <td>Date expected to checkout</td>
                         <td><p class="orange"><center><?php echo $checkoutdate; ?></center></p></td>

        <td height="54">
        <select name="day" class="input" id="day" ">
  <option value="">select</option>
  <option value="">............</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
  <?php
		 $range=range(11, 31);
		 foreach($range as $r){
			 echo "<option value='$r'>$r</option>";
			 }
			 ?>
          <?php if(isset($_POST['day'])){echo "<option  value='{$_POST['day']}' selected='selected'>{$_POST['day']}</option>"; }?>
</select></label>
<select name="month" id="month" class="input">
  <option value="">select</option>
  <option value="">............</option>
  <option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
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
	   <td height="15"><input type="hidden" value="<?php echo $targetID ?>" name="thisID"/> <input id="button" type="submit" value="Check guest in" name="submit" /></td>
</tr>
 </table>



</form>
</div><!--content div-->
   <!------------------------------------------------CONTENT---------------------------------------------------------------->



   <!------------------------------------------------FOOTER---------------------------------------------------------------->

<div id="footer">
<?php 
include_once('footer.php'); 
ob_flush();

?>
    <?Php $object->footer($cname); ?>
</div><!--footer div-->
   <!------------------------------------------------FOOTER---------------------------------------------------------------->
</div>

</body>
</html>