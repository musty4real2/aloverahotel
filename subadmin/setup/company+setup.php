<?php 
ob_start();
session_start();
include("../../class.php");
$object=new hms();
$object=new hms();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

include("../../connect.php");

//ensure that executive session is ON
if($_SESSION['executive']==1){

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:::::::::::: Setup Hotel::::::::::::</title>
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
<div id="content">

  <div id="bar"><h3>Setup Hotel </h3></div>
<p>Fill the form below to setup  your Hotel</p>
	
<?Php
if($_POST && isset($missing) && !empty($missing)){?>

	<fieldset class="errorfield">		<p class='info' id='error'><span class='info_inner'><b>Oops! ERROR: Complete the Missing fields</b></span></p>
	  </fieldset>
	<?php }
	



//PROCESS FORM====================================*********************************++++++++++++++++


if($_POST['save'] && empty($missing)){

$cname=mysql_real_escape_string($_POST['cname']);
$add=mysql_real_escape_string($_POST['add']);
$email=mysql_real_escape_string($_POST['email']);
$tel=mysql_real_escape_string($_POST['tel']);




//INSERT INTO DATABASE

$insert=$object->query("INSERT INTO `companysetup` (
`company` ,`date` ,`address` ,`email` ,`tel`) VALUES ('$cname', NOW(), '$add', '$email', '$tel')");



$id=mysql_insert_id($connection);


//++++++++++++++++++++=========================UPLOAD LOGO +============================================
//++++++++++++++++++++=========================UPLOAD LOGO +============================================
//++++++++++++++++++++=========================UPLOAD LOGO +============================================
//++++++++++++++++++++=========================UPLOAD LOGO +============================================
$path = "../../logo/";



	$valid_formats = array("jpg", "png", "gif", "bmp");
			$name1 = $_FILES['logo']['name'];
			$size1 = $_FILES['logo']['size'];
			
	
	
	
			if(strlen($name1))
				{
					list($txt, $ext) = explode(".", $name1);
					if(in_array($ext,$valid_formats))
					{
					if($size1<(1024*1024))
						{
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES['logo']['tmp_name'];
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
									
		$object->query("UPDATE  `companysetup` SET  `logo`='$actual_image_name' WHERE `id`='$id'");
								}
							else
								header("location:company+setup.php?status=Failed to Upload Image");
						}
						else
						header("location:company+setup.php?status=Image file size too large:  maximum size 1 MB");					
						}
						else
						header("location:company+setup.php?status=Invalid file format. Please Upload a jpg, gif or png image");	
				}
				
			else{
				header("location:company+setup.php?status=Please select image to upload!");
			}
		
//++++++++++++++++++++=========================UPLOAD LOGO +============================================
//++++++++++++++++++++=========================UPLOAD LOGO +============================================
//++++++++++++++++++++=========================UPLOAD LOGO +============================================
//++++++++++++++++++++=========================UPLOAD LOGO +============================================



//redirect to next 
header("location:sections+setup.php");

}


//////=============================END==================================*****************************
?>


<?php
if($_GET['status']){echo $_GET['status'];}
?>

<form action="<?php echo $_SERVER['setup/PHP_SELF'];?>" method="post" enctype="multipart/form-data"><table width="100%" border="1"  id="box-table-a">
  <tr>
    <td height="98">Company Name:</td>
    <td><label for="cname"></label>
      <input type="text"  size="40" class="smallInput" name="cname" id="cname" value="<?php if ($_POST['cname']){echo $_POST['cname'];}?>" />
  <span class="warning">*</span><?php if (isset($missing) && in_array('cname', $missing)) { ?>
  <span class="warning">Company's name is required.</span><?php } ?>      
      </td>
    </tr>
  <tr>
    <td height="80">Address:</td>
    <td><input type="text" size="60" class="smallInput" name="add" id="add" value="<?php if ($_POST['add']){echo $_POST['add'];}?>" />
  <span class="warning">*</span><?php if (isset($missing) && in_array('add', $missing)) { ?>
  <span class="warning">Company's office address is required.</span><?php } ?> </td>
    </tr>
  <tr>
    <td height="77">email:</td>
    <td><input type="text" size="40" class="smallInput" name="email" id="email"  value="<?php if ($_POST['email']){echo $_POST['email'];}?>" />
  <span class="warning">*</span><?php if (isset($missing) && in_array('email', $missing)) { ?>
  <span class="warning">Company's email address is required.</span><?php } ?> </td>
    </tr>
  <tr>
    <td>Tel:</td>
    <td><input type="text" size="40" class="smallInput" name="tel" id="tel"  value="<?php if ($_POST['tel']){echo $_POST['tel'];}?>" />
  <span class="warning">*</span><?php if (isset($missing) && in_array('tel', $missing)) { ?>
  <span class="warning">Company's Telephone is required.</span><?php } ?> </td>
    </tr>
  <tr>
    <td height="59">Logo:</td>
    <td> <input type="file" class="multi" maxlength="1" name="logo"/>
      
      </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="save" id="save" value="SAVE" /></td>
    </tr>
  </table>
</form>    
</div>

</body>
</html>
<?php
}
else{
	header("location:executive+login.php?access=denied");}
	?>