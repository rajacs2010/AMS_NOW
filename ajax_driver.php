<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
if($_GET["selvalue_incharge_empcode"])
{
$emp_code=$_GET["selvalue_incharge_empcode"];
?>
<input type='text' name='emp_code' id='emp_code' class="textbox" value="<?php echo $emp_code; ?>" readonly="true"/>
<?php
}
if($_GET["emp_bought_id"]) {
	$selvalue=$_GET["emp_bought_id"];
	
	$fgmembersite->DBLogin();
	$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
	or die("Opps some thing went wrong");
	mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
	$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  WHERE emp_id = '$selvalue'",$bd);			
	while($row=mysql_fetch_array($result_emp_id)) {
		$first_name=$row['first_name'];
	}
	?>
	<input type='text' name='emp_nameval' id='emp_nameval' class="textbox" value="<?php echo $first_name; ?>" readonly="true" />
	<?php
}
if($_GET["driver_bought_id"]) {
	$selvalue=$_GET["driver_bought_id"];
	$result=mysql_query("SELECT emp_name from driver WHERE id = $selvalue");
		while($row=mysql_fetch_array($result)) {
			$driver_nameval=$row['emp_name'];
		}
	?>
	<input type='text' name='driver_nameval' id='driver_nameval' class="textbox" value="<?php echo $driver_nameval; ?>" readonly="true"/>
	<?php
}
if($_GET["selvalue_driver"]) {
$selvalue=$_GET["selvalue_driver"];
$result=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id and a.id=$selvalue");
						   while($row=mysql_fetch_array($result))
							{
							$state=$row['state_name'];
							}
?>
<input type='text' name='state_driver' id='state_driver' class="textbox" value="<?php echo $state; ?>" readonly="true"/>
<?php
}
if($_GET["selvalue_vendor_id"])
{
$selvalue=$_GET["selvalue_vendor_id"];
$result=mysql_query("SELECT name from vendor where id=$selvalue");
						   while($row=mysql_fetch_array($result)) {
								$vendor_name=$fgmembersite->upperstate($row['name']);
							}
?>
<input type='text' name='vendor_name' id='vendor_name' class="textbox" value="<?php echo $vendor_name; ?>" readonly="true"/>
<?php
}
if($_GET["selvalue_bought_by"]) {
	$selvalue=$_GET["selvalue_bought_by"];
	if($selvalue==1) {
		$fgmembersite->DBLogin();
		$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
		or die("Opps some thing went wrong");
		mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
		$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
		echo '<select name="emp_bought_id" id="emp_bought_id" class="selectbox">';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_emp_id))
		{
			echo '<option value="'.$row['emp_code'].'">'.$row['emp_code'].'</option>';
		}
		echo '</select>&nbsp;<span id="display_bought_id"></span>';
	}
	if($selvalue==2)
	{
						$result_state=mysql_query("select * from driver");
						echo '<select name="driver_bought_id" id="driver_bought_id" class="selectbox">';
						echo '<option value="0">--Select--</option>';
						while($row=mysql_fetch_array($result_state))
						{
							echo '<option value="'.$row['id'].'">'.$row['driver_code'].'</option>';
						}
						echo '</select>&nbsp;<span id="display_bought_id"></span>';
	}
	
	if($selvalue==3)
	{
		echo '<input type="text" name="bought_id" id="bought_id" class="textbox"/>';
	}
	if($selvalue==4)
	{
		echo '<input type="text" name="bought_id" id="bought_id" class="textbox" readonly="true"/>';
	}
}
?>