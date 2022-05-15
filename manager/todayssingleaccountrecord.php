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
<title>account</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

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

<center><table width="90%" border="1" cellspacing="1" cellpadding="10px">
	<tr class="thead">  <td>HOTEL POINT</td><td>AMOUNT</td> 
 </tr>
      <tr class="treven">
  <td height="64"> SINGLE RESERVATION</td>
  <td><?php $single=$object->query("SELECT * FROM `accountbalance` WHERE `entrydate`=CURDATE() AND `checkout`='0'"); 
  while($l=mysql_fetch_array($single))
  { $singletotal+=$l['initial_deposit'];
  }
?>
<?php $refund=$object->query("SELECT * FROM `accountbalance` WHERE `entrydate`=CURDATE() AND `checkout`='1'"); 
  while($l=mysql_fetch_array($refund))
  { $singlerefundtotal+=$l['refund'];
  }
  ?>
  <?php $balance=$object->query("SELECT * FROM `accountbalance` WHERE `entrydate`=CURDATE() AND `checkout`='1'"); 
  while($l=mysql_fetch_array($balance))
  { $singlebalancetotal+=$l['balance'];
  }
      echo "Total initial deposit today  =  ".N.number_format($singletotal, 2)."<br/><br/>"."</p>";
  echo "Total Balance paid by guest to hotel =  ".N.number_format($singlebalancetotal, 2)."<br/><br/>"."</p>";
     echo "Total Refund paid by hotel to guest =  ".N.number_format($singlerefundtotal, 2)."</p>"

  ?>
<br/><?php $total= $singletotal+$singlebalancetotal-$singlerefundtotal; 
echo"<p class='orange'>"."Single Reservation hotel point today's total is = "."N".number_format($total, 2);

?>
  </tr>
  <tr class="treven">
  <td height="64"> GROUP RESERVATION</td>
  <td><?php $group=$object->query("SELECT * FROM `groupaccountbalance` WHERE `entrydate`=CURDATE() AND `checkout`='0'"); 
  while($gl=mysql_fetch_array($group))
  { $grouptotal+=$gl['initial_deposit'];
  }
?>
<?php $grouprefund=$object->query("SELECT * FROM `groupaccountbalance` WHERE `entrydate`=CURDATE() AND `checkout`='1'"); 
  while($rl=mysql_fetch_array($grouprefund))
  { $grouprefundtotal+=$rl['refund'];
  }
  ?>
  <?php $groupbalance=$object->query("SELECT * FROM `groupaccountbalance` WHERE `entrydate`=CURDATE() AND `checkout`='1'"); 
  while($bl=mysql_fetch_array($groupbalance))
  { $groupbalancetotal+=$bl['balance'];
  }
      echo "Total initial deposit today  =  ".N.number_format($grouptotal, 2)."<br/><br/>"."</p>";
  echo "Total Balance paid by guest to hotel =  ".N.number_format($groupbalancetotal, 2)."<br/><br/>"."</p>";
     echo "Total Refund paid by hotel to guest =  ".N.number_format($grouprefundtotal, 2)."</p>"

  ?>
<br/><?php $grouptotalcpm= $grouptotal+$groupbalancetotal-$grouprefundtotal; 
echo"<p class='orange'>"."Group Reservation hotel point today's total is = "."N".number_format($grouptotalcpm, 2);

?>
  </tr>
      <tr class="treven">
  <td height="53"><p> RESTURANT</p></td>
  <td>
<?php $resturant=$object->query("SELECT * FROM `singleresturant` WHERE `entrydate`=CURDATE()"); 
  while($l=mysql_fetch_array($resturant))
  { $resturanttotal+=$l['cost'];
  }
    $groupresturant=$object->query("SELECT * FROM `groupresturant` WHERE `entrydate`=CURDATE()"); 
  while($t=mysql_fetch_array($groupresturant))
  { $groupresturanttotal+=$t['cost'];
  }
  $outsideresturant=$object->query("SELECT * FROM `outsideresturant` WHERE `entrydate`=CURDATE()"); 
  while($t=mysql_fetch_array($outsideresturant))
  { $outsideresturanttotal+=$t['cost'];
  }
  
   echo "Total Amount Reliased from Lodged in guest ".N.number_format($resturanttotal, 2)."</p>";
      echo "Total Amount Reliased from Group Guest ".N.number_format($groupresturanttotal, 2)."</p>";

   echo "Total Amount Reliased from Non guest ".N.number_format($outsideresturanttotal, 2)."</p>";

?>
<br/><?php $restotal= $resturanttotal+$outsideresturanttotal+$groupresturanttotal; 
echo "<p class='orange'>"."Today's total is = "."N".number_format($restotal, 2)."</p>";
?>
</td>   
  </tr>
      <tr class="treven">
  <td height="51">GYM</td>
  <td>
<?php $gym=$object->query("SELECT * FROM `singlegym` WHERE `entrydate`=CURDATE()"); 
  while($l=mysql_fetch_array($gym))
  { $gymtotal+=$l['cost'];
  }
  $groupgym=$object->query("SELECT * FROM `groupgym` WHERE `entrydate`=CURDATE()"); 
  while($l=mysql_fetch_array($groupgym))
  { $groupgymtotal+=$l['cost'];
  }
   $outsidegym=$object->query("SELECT * FROM `outsidegym` WHERE `entrydate`=CURDATE()"); 
  while($l=mysql_fetch_array($outsidegym))
  { $outsidegymtotal+=$l['cost'];
  }
     echo "Total total Amount Reliased from lodged in guest today  =  ".N.number_format($gymtotal, 2)."</p>";
     echo "Total total Amount Reliased from group guest today  =  ".N.number_format($groupgymtotal, 2)."</p>";
      echo "Total total Amount Reliased from non guest today  =  ".N.number_format($outsidegymtotal, 2)."</p>";
?>
<br/><?php $gytotal= $gymtotal+$groupgymtotal+$outsidegymtotal; 
echo "<p class='orange'>"."Today's total is = "."N".number_format($gytotal, 2)."</p>";
?>  </td> 
 </tr>
      <tr class="treven">
  <td height="56">LAUNDRY</td>
  <td>
<?php $laundry=$object->query("SELECT * FROM `singlelaundry` WHERE `entrydate`=CURDATE()"); 
  while($l=mysql_fetch_array($laundry))
  { $laundrytotal+=$l['amount'];
  }
   $grouplaundry=$object->query("SELECT * FROM `grouplaundry` WHERE `entrydate`=CURDATE()"); 
  while($l=mysql_fetch_array($grouplaundry))
  { $grouplaundrytotal+=$l['amount'];
  }
   $outlaundry=$object->query("SELECT * FROM `outsidelaundry` WHERE `entrydate`=CURDATE()"); 
  while($l=mysql_fetch_array($outlaundry))
  { $outlaundrytotal+=$l['amount'];
  }
   echo "Total total Amount Reliased from lodged in guest today  =  ".N.number_format($laundrytotal, 2)."</p>";
   echo "Total total Amount Reliased from group today  =  ".N.number_format($grouplaundrytotal, 2)."</p>";
   
      echo "Total total Amount Reliased from non guest today  =  ".N.number_format($outlaundrytotal, 2)."</p>"
?>
<br/><?php $laundrytotal= $laundrytotal+$grouplaundrytotal+$outlaundrytotal; 
echo "<p class='orange'>"."Today's total is = "."N".number_format($laundrytotal, 2)."</p>";
?>
</td>  
 </tr>
      <tr class="treven">
  <td height="51">EVENT CENTER</td>
  <td>
<?php $eventcenter=$object->query("SELECT * FROM `event_centre` WHERE `entry_date`=CURDATE()"); 
  while($l1=mysql_fetch_array($eventcenter))
  { $eventcentertotal+=$l1['amount_paid'];
  }
   echo "<p class='orange'>".N.number_format($eventcentertotal, 2)."</p>";
?></td>  
  </tr>
      <tr class="treven">
  <td height="72">HALL RENTAL</td>
  <td>
<?php $hallrental=$object->query("SELECT * FROM `hallrental` WHERE `entry_date`=CURDATE()"); 
  while($l=mysql_fetch_array($hallrental))
  { $hallrentaltotal+=$l['amount_paid'];
  }
   echo "<p class='orange'>".N.number_format($hallrentaltotal, 2)."</p>";
?></td>  
  </tr>
  <tr>
  <td><?php $hoteltodaystotal=$laundrytotal+$gytotal+$restotal+$grouptotalcpm+$total+$hallrentaltotal+$eventcentertotal;   ?></td>
  <td>Total Amount Reliased Today is = <?php echo "<p class='orange'>".N.number_format($hoteltodaystotal,2)."</p>"; ?> </td>
  <td>&nbsp;</td>
  
  </tr>
<tr>
<td>&nbsp;</td>
<td align="center" valign="middle"> <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
if (window.print) {
document.write('<form>'
+ '<input type="button" name="print" value="  Print  " '
+ 'onClick="javascript:window.print()"></form>');
}
// End -->
</SCRIPT>
</td>
<td>&nbsp;

</td>
</tr>
</table></center>
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