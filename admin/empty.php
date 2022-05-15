<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
session_start();
include("../class.php");
include("../connect.php");
$object=new hms();
if($_SESSION['auth']==1){

 $delete=$object->query("TRUNCATE TABLE `accountbalance`");


$delete=$object->query("TRUNCATE TABLE `event_centre`");

$delete=$object->query("TRUNCATE TABLE `group`");

$delete=$object->query("TRUNCATE TABLE `groupaccountbalance`");

$delete=$object->query("TRUNCATE TABLE `groupgym`");
 
 $delete=$object->query("TRUNCATE TABLE `grouplaundry`");

 $delete=$object->query("TRUNCATE TABLE `grouplaundryhistory`");
 

 $delete=$object->query("TRUNCATE TABLE `groupresturant`");

 $delete=$object->query("TRUNCATE TABLE `group_history`");

 $delete=$object->query("TRUNCATE TABLE `hallrental`");

 $delete=$object->query("TRUNCATE TABLE `outsidegym`");

 $delete=$object->query("TRUNCATE TABLE `outsidelaundry`");

 $delete=$object->query("TRUNCATE TABLE `outsideresturant`");

$dalete=$object->query("UPDATE `rooms` SET `room_availability` = '0' WHERE `room_availability` ='1'");


 $delete=$object->query("TRUNCATE TABLE `single`");

 $delete=$object->query("TRUNCATE TABLE `singlegym`");

 $delete=$object->query("TRUNCATE TABLE `singlelaundry`");

 $delete=$object->query("TRUNCATE TABLE `singleresturant`");

 $delete=$object->query(" TRUNCATE TABLE `single_history`");


echo "All Previous Record Have been Deleted"

?>

    		<table width="100%">
            <tr>
            <td width="15%">			
</td>
<td width="50%">	<h1>&nbsp;</h1></td>
 <td width="21%"><a style="color:#000;" href="../logout.php">logout</a>  | <a href="admin_menu.php" style="color:#000;">Home</a></td> 
  <td width="14%">&nbsp;</td>

 </tr>

 </table>
<?php
}
else {
	header("location:index.php?access=denied");
	}
	?>