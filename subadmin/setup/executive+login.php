<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../../class.php");
include("../../connect.php");
$object=new hms();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::::::::::::  Login ::::::::::::</title>
<link href="../../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
	   <table width="100%">
         <tr>
            <td width="15%">			
</td>
<td width="50%">	<h1>&nbsp;</h1></td>
  <td width="14%"></td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content_login">
  <div id="bar"><h3>Login here to Setup Hotel </h3></div>

  <?php 
if(isset($_POST['login'])){

	$uname=addslashes($_POST['uname']);
	$pword=addslashes($_POST['pword']);
	
	if(empty($uname)){$error[]="Please enter your Username";}
	
	if(empty($pword)){$error[]="Please enter your Password";}
	
	if(!empty($error)){
		echo "
		<p class='info' id='error'><span class='info_inner'><b>Oops! ERROR: Missing fields</b></span></p>";
		foreach($error as $oops){
			echo "<p class='msg error'>$oops</p>";
			}//foreach loop
		}//if !empty error

		//if $error variable is empty, continue with the script
		elseif(empty($error)){

/*********************** *****************************************************************************************************************
************************************************************************************************************************************************************/

$check=$object->query("SELECT `username`,`password` FROM `admin` WHERE `username`='$uname' AND `password`=SHA1('$pword')");

if(mysql_num_rows($check)==1){
	$_SESSION['executive']=1;
	header("location:company+setup.php");
	}
	
	
	
else {echo "<p class='msg error'>Invalid Administrator Username or Password</p>";}

}
}

?>
  
  
  <fieldset style=" margin:auto; width:500px;">
  <legend><strong>LOGIN</strong></legend>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <table id="box-table-a" width="400" height="200" border="0"  style="margin:auto;">
    <tr>
      <td>Username:</td>
      <td><label>
        <input class="smallInput" type="text" name="uname" value="<?php if(isset($_POST['uname'])){echo $_POST['uname'];}?>" id="textfield" size="50" />
        </label></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>Password:</td>
      <td><input class="smallInput" type="password"  maxlength="15" name="pword" id="textfield2" value="<?php if(isset($_POST['pword'])){echo $_POST['pword'];}?>" size="50"/></td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="login" id="button" value="Login" />
        </label></td>
      <td>&nbsp;</td>
      </tr>
  </table>
  </form></center>
  </fieldset>
</center>
    </div>

</body>
</html>