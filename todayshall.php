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
<title>view all event center record</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
                                        <?php $object->head2("logo");?>

    		<table width="100%">
            <tr>
            <td width="15%"></td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#FFF;" href="logout.php">logout</a>  | <a href="others.php" style="color:#FFF;">Home</a></td>

 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">

<?php
$laund=$object->query("SELECT *  FROM `hallrental` WHERE `event_date`=CURDATE()");
?>
<legend><b>Today's Hall Events Programs</b></legend>
<?php
if(mysql_num_rows($laund)==0){echo "No Event Records";}
elseif(mysql_num_rows($laund)>0){
?>
<center><table width="90%" border="1" cellspacing="1">
	<tr class="thead">
    <td>S/N</td>
        <td>NAME</td>
    <td>ADDRESS</td>
    <td>PHONE NUMBER</td>
    <td>SESSION</td>
    <td>AMOUNT PAID</td>
    <td>EVENT DATE</td>
        <td>ENTRY DATE</td>

    <td>ATTENDANT</td>
    
    </tr>
  <?php
  $serial=1;
  	while($l=mysql_fetch_array($laund)){
	echo "<tr class= \"trodd\">";
	?>
        <td><?php echo $serial++; ?></td>

    <td><?php echo $l['name'];?></td>

    <td><?php echo $l['address'];?></td>
    <td><?php echo $l['phone'];?></td>
        <td><?php echo $l['session'];?></td>

    <td><?php echo "N".number_format($l['amount_paid'], 2) ;?></td>
    <td><?php echo $l['event_date'] ;?></td>
    <td><?php echo $l['entry_date'] ;?></td>
    <td><?php echo $l['attendant'] ;?></td>
  </tr>
 <?php 
 $laundrytotal+=$l['amount_paid'];
}?>		 
</table></center>

<br/><br/>
<center><table width="800" border="0" cellspacing="1">
        <tr>
<td><center><p>Number of people that have Rented our Event center so far:</p></center></td>
<td><center><b><?php echo mysql_num_rows($laund);?></b></center></td>
<td><center>Event Center Total:</center></td>
<td><center><b><?php echo "<p class='orange'>".N.number_format($laundrytotal, 2)."</p>" ;?></b></center></td>
<td></td>
</tr>
</table></center>
<?php }//ELSE IF   ?>
  </tr>
</table></div>
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