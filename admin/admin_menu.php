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
      <a href="singlesssreport.php"><img src="../images/sec2-01.png" /><br />
      Today's Single SSS Report</a>
    </center></p></td>
     <td width="33%" height="184"><p><center>
      <a href="todayssingleaccountrecord.php">
   <img src="../images/rec11-01.png" /><br />
   View Todays Account</a> </center></p></td>
      <td width="33%" height="184"><p><center>
      <a href="singleguestexpectedtocheckout.php"><img src="../images/rec2-01.png" /><br />
      Single Expected to Checkout Today</a>
      </center></p></td>
  </tr>
   <tr>
    <td width="33%" height="184"><p><center>
      <a href="groupsssreport.php"><img src="../images/sss-01.png" /><br />
      Today's Group SSS Report</a>
    </center></p></td>
      <td width="33%" height="184"><p><center>
      <a href="groupguestexpectedtocheckout.php"><img src="../images/images/ico_39.gif" /><br />
       Group Guest Expected to Checkout Today</a>
      </center></p></td>
     <td width="33%" height="184"><p><center>
      <a href="singleguesthistory.php"><img src="../images/records-01.png" /><br />
       Single  Checked Out History Record</a>
     </center></p></td>
  </tr>
  <tr>
       <td width="33%" height="184"><p><center>
      <a href="singleguestyettocheckout.php"><img src="../images/rec-01.png" /><br />
      Single Yet To Check out Record</a>
       </center></p></td>
    <td width="33%" height="184"><p><center>
      <a href="groupguesthistory.php"><img src="../images/rec3-01.png" /><br />
       Group Guest Checked Out History Record</a>
     </center></p></td>
 
       <td width="33%" height="184"><p><center>
      <a href="groupguestyettocheckout.php"><img src="../images/record2-01.png" /><br />
       Group Yet To Check out Record</a>
       </center></p></td>
      </tr>
  </table>
</div>

<div id="footer">
    		<p>&copy;Copyrights2010. All Rights reserved. Alovera Hotels International, Minna Niger State.</p>
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