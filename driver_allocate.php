<?PHP
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

?>
<?php
if ($fgmembersite->usertype() == 1)
{
$header_file='./layout/admin_header.php';
}
if(file_exists($header_file))
{
include_once($header_file);
}
else
{
$fgmembersite->RedirectToURL("index.php");
exit;
}
?>
<script>
$(function(){
$("#content").load("ajax_driver_allocate.php");

//PAGE NUMBER onClick FUNCTION
$(".page").live("click", function(){
var page = $(this).attr("id");
$("#content").load("ajax_driver_allocate.php?page="+page);
});
});
</script>
<script>
function validateForm()
{
	var driver_id=document.getElementById("driver_id").value;
	if(driver_id==0)
	{
		alert("Please select the driver code");
		document.getElementById("driver_id").focus();
		return false;
	}
	
	var allocate_id=document.getElementById("allocate_id").value;
	if(allocate_id==0)
	{
		alert("Please select the allocation type");
		document.getElementById("allocate_id").focus();
		return false;
	}
	
	var emp_id=document.getElementById("emp_id").value;
	if(emp_id==0)
	{
		alert("Please select the employee code ");
		document.getElementById("emp_id").focus();
		return false;
	}
}

</script>

<script src="scripts/jquery_pagination.js"></script>
<script>
$(document).ready(function(){
  $("#imageclick").click(function(){
 var searchvalue=$('#searchname').val();
 var searchvalue=$.trim(searchvalue).replace(/ /g,'+');
$("#content").load("ajax_driver_allocate.php?searchvalue="+searchvalue);
  });
});
</script>
</script>
<script>
function myFunction()
{
document.getElementById("driver_id").value=0;
document.getElementById("driver_id").focus();
document.getElementById("allocate_id").value=0;
document.getElementById("emp_id").value=0;
return false;
}
</script>
<?php
if(isset($_POST['save']))
{

$user_id=$_SESSION['user_id'];
$driver_id=$_POST['driver_id'];
$allocate_id=$_POST['allocate_id'];
$emp_id=$_POST['emp_id'];

$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select first_name from pim_emp_info where emp_code='$emp_id'  order by emp_id",$bd);
				while($row=mysql_fetch_array($result_emp_id))
				{
				$emp_name=$row['first_name'];
				}

if ($driver_id != "")
{
$fgmembersite->DBLogin();
if(!mysql_query('INSERT INTO driver_allocate (driver_id,allocate_type_id,emp_id,emp_name,created_by)VALUES ("'.$driver_id.'","'.$allocate_id.'","'.$emp_id.'","'.$emp_name.'","'.$user_id.'")'))
{
die('Error: ' . mysql_error());
}
echo '<div class="success_message">driver allocation created successfully</div>';
}
else
{
echo '<div class="error_message">The name should not be empty</div>';
}
}

?>
<?php
if(isset($_POST['edit']))
{
$edit_id=$_POST['edit_id'];
$user_id=$_SESSION['user_id'];
$driver_id=$_POST['driver_id'];
$allocate_id=$_POST['allocate_id'];
$emp_id=$_POST['emp_id'];
$emp_name=$_POST['emp_name'];
$current_date=date("Y-m-d H:i:s");

$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select first_name from pim_emp_info where emp_code='$emp_id'  order by emp_id",$bd);
				while($row=mysql_fetch_array($result_emp_id))
				{
				$emp_name=$row['first_name'];
				}
if ($driver_id!= "")
{
$fgmembersite->DBLogin();
if(!mysql_query('UPDATE driver_allocate SET driver_id="'.$driver_id.'",allocate_type_id="'.$allocate_id.'",emp_id="'.$emp_id.'",emp_name="'.$emp_name.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" '))
{
die('Error: ' . mysql_error());
}
echo '<div class="success_message">Driver allocation updated successfully</div>';
}
else
{
echo '<div class="error_message">The name should not be empty</div>';
}
}

?>
<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT * FROM driver_allocate where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
	$driver_id=$row['driver_id'];
	$allocate_id=$row['allocate_type_id'];
	$emp_code=$row['emp_id'];
	$emp_name=$row['emp_name'];
	
}
}
?>
<div id="inside_content">
&nbsp;
<form id='city_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm()"  method='post' accept-charset='UTF-8'>

<table align="center" width="40%"CELLPADDING="3" CELLSPACING="0"  style=" border: 0px solid #00BFFF; border-top:0px;font-family: Arial;
    font-size: 12px;"      >
  <tr>
    <th style=" height: 29px;text-align: left;font-size: 14px;text-align:center">
Driver Allocation
    </th>
  </tr>
  <tr>
    <td align="center" style=" padding:30px 50px 30px 0px;">
  

<input type='hidden' name='submitted' id='submitted' value='1'/>
             <!-- The inner table below is a container for form -->
                <table style="font-family:Arial;" width="100%"  cellpadding="10px" class="htmlForm" cellspacing="0" border="0">

                    <tr>
				
			<td  width="150px"><label style="margin-left:0px;">Driver code<em style="font-style:normal;color:red;">*</em></label></td>
				
					<td>
					<?php
			if(isset($_GET['id']))
			{ 		
				$result_state=mysql_query("select * from driver");
				echo '<select name="driver_id" id="driver_id" class="selectbox">';
				echo '<option value="0">Please select a  driver code</option>';
				while($row=mysql_fetch_array($result_state))
				{
				if($row['id'] == $driver_id){
						  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
					 } else {
						  $isSelected = ''; // else we remove any tag
					 }
					 echo "<option value='".$row['id']."'".$isSelected.">".$row['driver_code']."</option>";
				}
				echo '</select>';
					
			}
			else
			{

				$result_state=mysql_query("select * from driver");
				echo '<select name="driver_id" id="driver_id" class="selectbox">';
				echo '<option value="0">Please select a  driver code</option>';
					while($row=mysql_fetch_array($result_state))
					{
					echo '<option value="'.$row['id'].'">'.$row['driver_code'].'</option>';

					}
					echo '</select>';
			}

?>
					</td>

				
			<td  width="150px"><label style="margin-left:0px;">Allocation  type<em style="font-style:normal;color:red;">*</em></label></td>
				
					<td>
					<?php
			if(isset($_GET['id']))
			{ 		
				$result_state=mysql_query("select * from allocation_type");
				echo '<select name="allocate_id" id="allocate_id" class="selectbox">';
				echo '<option value="0">Please select a  allocation type</option>';
				while($row=mysql_fetch_array($result_state))
				{
				if($row['id'] == $allocate_id){
						  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
					 } else {
						  $isSelected = ''; // else we remove any tag
					 }
					 echo "<option value='".$row['id']."'".$isSelected.">".$row['name']."</option>";
				}
				echo '</select>';
					
			}
			else
			{

				$result_state=mysql_query("select * from allocation_type");
				echo '<select name="allocate_id" id="allocate_id" class="selectbox">';
				echo '<option value="0">Please select a  allocation type</option>';
					while($row=mysql_fetch_array($result_state))
					{
					echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

					}
					echo '</select>';
			}

?>
					</td>
					
				
			<td  width="150px"><label style="margin-left:0px;">Employee code<em style="font-style:normal;color:red;">*</em></label></td>
				
					<td>
					<?php
					
			if(isset($_GET['id']))
			{ 		
				
				$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
				echo '<select name="emp_id" id="emp_id" class="selectbox">';
				echo '<option value="0">Please select a name</option>';
				while($row=mysql_fetch_array($result_emp_id))
				{
							
							if($row['emp_code'] == $emp_code){
							  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
						 } else {
							  $isSelected = ''; // else we remove any tag
						 }
						 echo "<option value='".$row['emp_code']."'".$isSelected.">".$row['emp_code']."</option>";

				}
				echo '</select>';
					
			}
			
			else
			{
				
				$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
				echo '<select name="emp_id" id="emp_id" class="selectbox">';
				echo '<option value="0">Please select a name</option>';
				while($row=mysql_fetch_array($result_emp_id))
				{
				echo '<option value="'.$row['emp_code'].'">'.$row['emp_code'].'</option>';
				}
				echo '</select>';
				
			}

?>
					</td>
					</tr>
		<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="right" colspan="3">
			<?php if(isset($_GET['id'])){ ?>
			<input type='submit'  class="flatbutton" name='edit' id="edit" value='Save'/>
			<input type='hidden' name='edit_id' id='edit_id' value='<?php echo $_GET['id'];?>'/>
			<?php } else {?>
			<input type='submit'  class="flatbutton" name='save' id="save" value='Save'/>
			<?php }?>
			
             <input type='button'  class="flatbutton"  value='Clear'  onclick="return myFunction()"/>
        

            </td>
        </tr>
		
		
                </table>
                </form>            </td>

        </tr>




    </table>
	</form>
	<div id="search" style="float:right;padding-right:10px;">

<table>
<tr>
<td>
<input type="text" class="textbox" placeholder="Search By Name" autocomplete="off" value="" name="searchname" id="searchname"/>
</td>
<td>
<img src="images/search.png" height="" alt="" border="0" id="imageclick"></img>
</td>
</tr>
</table>

     
</div>
<br/>
<br/>
	<div id="content" ></div>



</div>

<?php
$footerfile='./layout/footer.php';
if(file_exists($footerfile))
{
include_once($footerfile);
}
else
{
echo _FILENOTFOUNT.$footerfile;
}
?>