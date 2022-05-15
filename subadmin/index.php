<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:::::::::::: Administrative Login ::::::::::::</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
          <?php $object->head("logo");?>

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content_login">
<?php   
          if ($_POST['login']){
		  $username=$_POST['username'];
		  $password=$_POST['password'];
		  
		  
		  if(strlen($username)==0){
		  echo "<p class=\"error\">Sorry, no Username specified</p>";
		  }
		  if(strlen($password)==0){
		  echo "<p class=\"error\">Sorry,no Password specified</p>";
		  }
		  $select="SELECT `username`, `password` FROM `user2` WHERE `username`='$username' AND `password`='$password' AND `dept`='subadmin'";
	$query=mysql_query($select) or die("ERROR:".mysql_error());
	
	if(mysql_num_rows($query)>0){
					$_SESSION['auth']=1;
	header("location:admin_menu.php");
	}
	
else {echo "<p style='color:#F00;'>Invalid Username or Password</p>";
}

}

 
?>
<center><form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
   <fieldset>
  <div id="bar"><h3>Login here</h3></div>

        <table border="0" width="398" height="255px">
        <tr><td>&nbsp;</td></tr>
        	<tr>
            	<td height="37" ><p>Username:</p></label></td>
              <td ><input class="abs" id="input" type="text" size="40"maxlength="15" width="30" name="username" /></td>
            </tr>
            <tr>
            	<td height="36"><p>Password:</p></td>
              <td><input id="input" class="abs" type="password" size="40" maxlength="15" name="password" /></td>
            </tr>
            <tr>
            	<td><label></label></td>
               
                <td align="justify"><input id="button" type="submit" value="Login" name="login"  /></td>
            </tr>
        </table>
  </fieldset>
	</form></center>
    </div>

</body>
</html>