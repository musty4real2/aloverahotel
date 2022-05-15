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
<title>group in house laundry form</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />

</head>

<body>
		
  
   <div id="wrapper"><!--head div-->	
   <!------------------------------------------------HEAD---------------------------------------------------------------->
	 <div id="head">
    		<table width="100%">
            <tr>
            <td width="15%">			
<img src="img/index34.jpg"  width="81" height="81" /></td>
<td width="50%">	<h1>
<?php
$select="SELECT * FROM `hotelinfo`";
$query=mysql_query($select) or die("ERROR".mysql_error());


while($row=mysql_fetch_array($query)){
 echo "<h1>". $row['hotelname'];}?>	</h1></td>
 <td width="21%"><a style="color:#FFF;" href="../logout.php">logout</a>  | <a href="groupmenu.php" style="color:#FFF;">Home</a></td> 


 </tr>

 </table>
 

 </div>
	
    
    
   <!------------------------------------------------CONTENT---------------------------------------------------------------->
<div id="content">

<?php
if(isset($_POST['submit'])){
$guestid=mysql_real_escape_string($_POST['name']);


$sql=$object->returnCloth(grouplaundry,$guestid);
}
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<cener><table width="80%" border="0">
  <tr>
    <td colspan="2"><center>
      <h3>Group Laundry Form </h3></center></td>
    </tr> <tr>
<td width="44%">Guest name</td>
 <td width="56%"><?php
$auto=$object->query(" SELECT `id` ,`companyname`, `othername`, `surname` FROM `group` ORDER BY 'surname' DESC ");
 
 ?>

 <select   class="input" name='name'>
  <option value=''>select</option>
  <option value=''>----------</option>
  <?php 
 while($row=mysql_fetch_array($auto)){
$id=$row['id'];
$surname=$row['surname'];
$othername=$row['othername'];
$cname=$row['companyname'];
echo "<option value='$id'> $othername,$surname ($cname)</option>";
}
 ?>
 </select></td>
  </tr>

  <tr>
  <td>&nbsp;</td>
    <td><input type="submit"  name="submit" value="submit"/></td>    
    </tr>
</table></center>
</form>
</body>
</html>