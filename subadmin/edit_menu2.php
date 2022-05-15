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
<title>Admin Menu</title>
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
  <td width="14%">&nbsp;</td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">

<table width="100%" border="1">
  <tr>
    <td width="33%" height="184"><p><center>
      <a href="groupdelete.php"><img src="../images/sec2-01.png" /><br />
      Edit And Delete Group Guest Record</a>
    </center></p></td>
     <td width="33%" height="184"><p><center>
      <a href="group_resturant_delete.php">
   <img src="../images/rec11-01.png" /><br />
   Edit Restaurant Details</a> </center></p></td>
      <td width="33%" height="184"><p><center>
      <a href="group_gym_delete.php"><img src="../images/rec2-01.png" /><br />
      Edit Gym Details</a>
      </center></p></td>
  </tr>
   <tr>
    <td width="33%" height="184"><p><center>
      <a href="grouproom_occupants.php"><img src="../images/sss-01.png" /><br />
      Change Room</a>
    </center></p></td>
    <td width="33%" height="184"><p><center>
      <a href="group_laundry_delete.php"><img src="../images/sss-01.png" /><br />
      Edit Laundry Details</a>
    </center></p></td>
      <td></td>
      </tr>

      </table>
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
	header("location:../index.php?access=denied");
	}
	?>