<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("class.php");
include("connect.php");
$object=new hms();

//redirect to setup if system not setup!!!!
$getit=$object->query("SELECT * FROM `companysetup`");
if(mysql_num_rows($getit)==0){
	//redirect
	header("location:subadmin/setup/executive+login.php");
	}
//

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::::::::::::  Login ::::::::::::</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
     <?php $object->head2("logo");?>
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
<?php   
          if ($_POST['login']){
		  $username=$_POST['username'];
		  $password=$_POST['password'];
		  
		  $fetch=$object->query("SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password'");

		  $fetch2=$object->query("SELECT * FROM `section`");
		  
		  //if user exist
		  if(mysql_num_rows($fetch)!=0){
			
			//inside this block means user exists
			
			//fetch user details from dbase query
			while($row=mysql_fetch_array($fetch)){
				$uname=$row['username'];
				$pword=$row['password'];
				$dept=$row['dept'];
			
			
			
//***********************************************************************************************************************				
			//Now check using username and department to redirect this user
			if($dept=='reception'){
				//create session
				$_SESSION['reception']=1;
				//redirect
				header("location:receptionmenu.php");
				
			}//IF department
			
				if($dept=='gym'){
				//create session
				$_SESSION['gym']=1;
				//redirect
				header("location:singlegym/gymmenu.php");
					

			}//IF department
					if($dept=='resturant'){
				//create session
				$_SESSION['resturant']=1;
				//redirect
				header("location:singleresturant/resmenu.php");
			}//IF department
			
					if($dept=='laundry'){
				//create session
				$_SESSION['laundry']=1;
				//redirect
				header("location:laundry/laundry_menu.php");
			}//IF department
			
				
					if($dept=='manager'){
				//create session
				$_SESSION['auth']=1;
				//redirect
				header("location:manager/admin_menu.php");
			}//IF department
			
//***********************************************************************************************************************			
			
			
				}//while  
			  
		  }//if LOGIN
		  
		  if(strlen($username)==0){
		  echo "<p class=\"error\">Sorry, no Username specified</p>";
		  }
		  if(strlen($password)==0){
		  echo "<p class=\"error\">Sorry,no Password specified</p>";
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
              <td ><input class="abs" id="input" type="text" size="40"maxlength="15" width="30" name="username" autosuggest="off"/></td>
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