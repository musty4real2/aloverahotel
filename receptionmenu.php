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
<title>Untitled Document</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
     <center>                                   <?php $object->head2("logo");?>
</center>
    		<table width="100%">
            <tr>
            <td width="15%">&nbsp;</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#FFF;" href="logout.php">logout</a></td> 
  <td width="14%"></td>

 </tr>

 </table>
 </div>
 


	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<table width="100%" border="1">
  <tr>
    <td width="33%" height="184"><p><center><a href="recepmenu1.php"><img src="images/images/ico_41.gif" /><br />SINGLE</a></center></p></td>
    <td width="29%"><p><center><a href="groupmenu1.php"><img src="images/images/ico_40.gif" /><br>GROUP</a></center></p></td>

    <td width="38%"><p><center><a href="others.php"><img src="images/menu-01.png" /><br>OTHERS</a></center></p></td>
  </tr>
  <tr>
   <td width="38%" height="142"><p><center><a href="checkout/single_menu.php"><img src="images/chk_out-01.png" /><br>CHECKOUT GUEST</a></center></p></td>
       <td width="33%" height="184"><p><center>
      <a href="singlesssreport.php"><img src="images/sec2-01.png" /><br />
      Today's Single SSS Report</a>
    </center></p></td>
       <td width="33%" height="184"><p><center>
      <a href="groupsssreport.php"><img src="images/sss-01.png" /><br />
      Today's Group SSS Report</a>
    </center></p></td>
  </tr>
  <tr>
   <td width="33%" height="184"><p><center>
      <a href="singleguestexpectedtocheckout.php"><img src="images/rec2-01.png" /><br />
      Single Expected to Checkout Today</a>
      </center></p></td>
<td width="33%" height="184"><p><center>
      <a href="groupguestexpectedtocheckout.php"><img src="images/images/ico_39.gif" /><br />
       Group Guest Expected to Checkout Today</a>
      </center></p></td>      </tr>
</table>

</div>
<div id="footer">
  <?php $object->footer("cname");?>		
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