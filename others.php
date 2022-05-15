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
                                        <?php $object->head2("logo");?>

    		<table width="100%">
            <tr>
            <td width="15%">&nbsp;</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#FFF;" href="logout.php">logout</a></td> 
  <td width="14%"><a style="color:#FFF;" href="receptionmenu.php">HOME</a></td>

 </tr>

 </table>
 </div>
 


	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">
<table width="100%" border="1">
    <tr>
    <td width="50%" height="184"><p><center><a href="enter_event_center_details.php"><img src="images/rec8-01.png" /><br />ENTER EVENT CENTER DETAILS</a></center></p></td>
    <td width="50%"><p><center><a href="hallrental.php"><img src="images/evt-01.png" /><br>ENTER HALL RENTAL DETAILS</a></center></p></td>
  </tr>
      <tr>
    <td width="50%" height="184"><p><center><a href="viewalleventrecord.php"><img src="images/rec5-01.png" /><br />VIEW ALL EVENT DETAILS</a></center></p></td>
    <td width="50%"><p><center><a href="viewallhallrentrecord.php"><img src="images/rec9-01.png" /><br>VIEW ALL HALL RENTAL DETAILS</a></center></p></td>
  </tr>
      <tr>
    <td width="50%" height="184"><p><center><a href="todaysevent.php"><img src="images/rec6-01.png" /><br />TODAY'S EVENT CENTER DETAILS</a></center></p></td>
    <td width="50%"><p><center><a href="todayshall.php"><img src="images/rec3-01.png" /><br>TODAY'S HALL RENTAL DETAILS</a></center></p></td>
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
	header("location:index.php?access=denied");
	}
	?>