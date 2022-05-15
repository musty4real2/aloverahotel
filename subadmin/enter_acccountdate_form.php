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
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<title>Go to account</title>
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
if(isset($_GET['submit'])){

	   	$day=mysql_escape_string($_GET['day']);
	$month=mysql_escape_string($_GET['month']);
	$year=mysql_escape_string($_GET['year']);
	
			$checkdate=$year."-".$month."-".$day;

header("location:viewaccountrecordbydate.php?checkdate=$checkdate");
}

?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="get"/>

<table width="768" border="0">
    	<tr>
       	  <td width="195"><p class="orange">Plesse Construct a Date:</p></td>
        	<td width="202"></td>
       	  <td width="357"></td>
        </tr>
     
        <tr>
        <td height="54"></td>
        <td>Date::</td>
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
<option value="12">11</option>

  <?php if(isset($_POST['month'])){echo "<option  value='{$_POST['month']}' selected='selected'>{$_POST['month']}</option>"; }?>
</select>
<select name="year" id="year2" class="input">
  <option value="">select</option>
  <option value="">............</option>
  <?php
		 $range=range(2013, 2020);
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
	   <td height="15"> <input id="button" type="submit" value="See Account" name="submit" /></td>
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
</html><?php
}
else {
	header("location:../index.php?access=denied");
	}
	?>