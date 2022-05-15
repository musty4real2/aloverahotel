<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("class.php");
include("connect.php");
$object=new hms();
if($_SESSION['reception']==1){

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/main.css" rel="stylesheet" type="text/css" />

<title>Event Cener</title>
</head>

<body>
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
                                   <?php $object->head2("logo");?>


         		<table width="100%">
            <tr>
            <td width="15%">&nbsp;</td>
<td width="50%">	<h1>
	</h1></td>
 <td width="21%"><a style="color:#FFF;" href="logout.php">logout</a>  | <a href="others.php" style="color:#FFF;">Home</a></td> 
 </tr>
 </table>
 </div>   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">

<?php
       
        if(isset($_POST['submit'])){
		$name=mysql_real_escape_string($_POST['name']);
		if(strlen($name)==0){
		echo "<p class=\"error\">No guest name was specified</p>";
		}
		
		$attendant=mysql_real_escape_string($_POST['attendant']);
		if(strlen($attendant)==0){
		echo "<p class=\"error\">No attendant specified</p>";
		}
	
		
		$phone=mysql_real_escape_string($_POST['phone']);
		$date=mysql_real_escape_string(date('D, d M Y'));

$address=mysql_real_escape_string($_POST['address']);
$money=mysql_real_escape_string($_POST['money']);
$session=mysql_real_escape_string($_POST['session']);
	   	$time=mysql_real_escape_string(date('g:h:i A'));
		
	   
	   	$day=mysql_escape_string($_POST['day']);
	$month=mysql_escape_string($_POST['month']);
	$year=mysql_escape_string($_POST['year']);
	
			$eventdate=$year."-".$month."-".$day;		
		if($name && $attendant){
			
	
		
		$sql="INSERT INTO `event_centre` ( `name`, `address`, `phone`, `session`, `amount_paid`, `event_date`, `entry_date`, `entry_time`, `attendant`) VALUES ('$name', '$address', '$phone', '$session', '$money', '$eventdate', NOW(), '$time', '$attendant')";
				$result=mysql_query($sql);
		if(!$result){
	   	   echo "<p class=\"error\">Sorry could insert record at this time:".mysql_error()." please try again</p>";
		
		}
		}		
		header("location:temp_eventrental.php?name=$name&address=$address&phone=$phone&session=$session&money=$money&eventdate=$eventdate&date=$date&time=$time&attendant=$attendant");

		}
		?>
<form name=""action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<center><table width="500" border="0">
<tr>
<td>Name</td>
    <td><input class="input" type="text" size="30" name="name" /></td>

   <tr >
   	<td>Address</td>
    <td><input class="input" type="text" size="30" name="address" /></td>
    </tr>
	   <tr >
   	<td>Amount Paid</td>
    <td><input class="input" type="text" size="35" name="money" /></td>
    </tr>

    <tr>
        	<td>Session</td>
        <td><select name="session" >
        <option value="">****</option>
        <option value="morning">Morning</option>
                <option value="Afternoon">Afternoon</option>
        <option value="Evening">Evening</option>
        <option value="Night">Night</option>
        </select>
        </td></tr>
        <tr>
        <tr>
        	<td>Attendant</td>
        <td><input class="input" type="text" size="35" name="attendant" /></td></tr>
        <tr>

    <tr>
        	<td>Event Date</td>
        <td>
        
        
        <select name="day" class="input" id="day" ">
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
		 $range=range(2014, 2020);
		 foreach($range as $r){
			 echo "<option value='$r'>$r</option>";
			 }
			 ?>
  <?php if(isset($_POST['year'])){echo "<option  value='{$_POST['year']}' selected='selected'>{$_POST['year']}</option>"; }?>
</select></td></tr>
            <tr>
        	<td>Phone Number</td>
        <td><input class="input" type="text" size="35" name="phone" /></td></tr>
       
        <tr>
        <td></td>
	<td>  <input type="submit" id="button" name="submit" value="submit"/></td>
    </tr>

</table></center>
</form>
    </div>
    <div id="footer">
    <?Php $object->footer($cname); ?>
</div>
    </div>

</body>
</html>
<?php
}
else {
	header("location:index.php?access=denied");
	}
	?>