<?php
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

?>
<?php
$fgmembersite->DBLogin();
if($_GET["selvalue"])
{
$selvalue=$_GET["selvalue"];
$result=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id and a.id=$selvalue");
						   while($row=mysql_fetch_array($result))
							{
							$state=$row['state_name'];
							}
?>
<input type='text' name='state' id='state' class="textbox" value="<?php echo $state; ?>" readonly="true"/>
<?php
}

if($_GET["selvalue_landlord"])
{
$selvalue=$_GET["selvalue_landlord"];
$result=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id and a.id=$selvalue");
						   while($row=mysql_fetch_array($result))
							{
							$state=$row['state_name'];
							}
?>
<input type='text' name='state_landlord' id='state_landlord' class="textbox" value="<?php echo $state; ?>" readonly="true"/>
<?php
}
?>


<?php
if($_GET["selvalue_empcode"])
{
$fgmembersite->DBLogin();
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
$emp_code=$_GET["selvalue_empcode"];
$result_emp_id=mysql_query("select first_name from pim_emp_info where emp_code=$emp_code order by emp_id",$bd);
while($row = mysql_fetch_array($result_emp_id))
  {
  $first_name=$row['first_name'];  
  }
?>
<input type='text' name='empname' id='empname' class="textbox" value="<?php echo $first_name; ?>" readonly="true"/>
<?php
}
?>
<?php
if($_GET["selvalue_incharge_empcode"])
{
$fgmembersite->DBLogin();
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
$emp_code=$_GET["selvalue_incharge_empcode"];
$result_emp_id=mysql_query("select first_name from pim_emp_info where emp_code=$emp_code order by emp_id",$bd);
while($row = mysql_fetch_array($result_emp_id))
  {
  $first_name=$row['first_name'];  
  }
?>
<input type='text' name='leadername' id='leadername' class="textbox" value="<?php echo $first_name; ?>" readonly="true"/>
<?php
}
?>