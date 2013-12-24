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
$("#content").load("ajax_vehicle_status.php");

//PAGE NUMBER onClick FUNCTION
$(".page").live("click", function(){
var page = $(this).attr("id");
$("#content").load("ajax_vehicle_status.php?page="+page);
});
});
</script>
<script>
function validateForm()
{
var vehicle_reg_id=document.getElementById("vehicle_reg_id").value;
	if(vehicle_reg_id==0)
	{
		alert("Please select the vehicle registration number");
		document.getElementById("vehicle_reg_id").focus();
		return false;
	}
	
	var status_id=document.getElementById("status_id").value;
	if(status_id==0)
	{
		alert("Please select the vehicle status");
		document.getElementById("status_id").focus();
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
$("#content").load("ajax_vehicle_status.php?searchvalue="+searchvalue);
  });
});
</script>
</script>
<script>
function myFunction()
{
document.getElementById("vehicle_reg_id").value=0;
document.getElementById("vehicle_reg_id").focus();
document.getElementById("status_id").value=0;
return false;
}
</script>
<?php
if(isset($_POST['save']))
{

$user_id=$_SESSION['user_id'];
$vehicle_reg_id=$_POST['vehicle_reg_id'];
$status_id=$_POST['status_id'];
if ($vehicle_reg_id!= "")
{
if(!mysql_query('INSERT INTO vehicle_status (vehicle_reg_id,status_id,created_by)VALUES ("'.$vehicle_reg_id.'","'.$status_id.'","'.$user_id.'")'))
{
die('Error: ' . mysql_error());
}
echo '<div class="success_message">vehicle status created successfully</div>';
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
$vehicle_reg_id=$_POST['vehicle_reg_id'];
$status_id=$_POST['status_id'];
$current_date=date("Y-m-d H:i:s");
if ($vehicle_reg_id != "")
{
if(!mysql_query('UPDATE vehicle_status SET vehicle_reg_id="'.$vehicle_reg_id.'",status_id="'.$status_id.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" '))
{
die('Error: ' . mysql_error());
}
echo '<div class="success_message">vehicle status  updated successfully</div>';
}
else
{
echo '<div class="error_message">The name should not be empty</div>';
}
}

?>

<?php
if(isset($_GET['delete_id']) && intval($_GET['delete_id'])) 
{
if ($_GET['delete'] ==1)
{
$id=$_GET['delete_id'];
$query = "SELECT * FROM nepa where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

 if(!mysql_query("delete FROM vehicle_status where id=$id"))
{
die('Error: ' . mysql_error());
}
 echo '<div class="success_message">vehicle status deleted successfully</div>';

 // 
  //echo "hi";
}
}
?>
<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT * FROM vehicle_status where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
	$vehicle_reg_id=$row['vehicle_reg_id'];
	$status_id=$row['status_id'];
	
}
}
?>
<div id="inside_content">
&nbsp;
<form id='vehicle_status_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm()"  method='post' accept-charset='UTF-8'>

<table align="center" width="40%"CELLPADDING="3" CELLSPACING="0"  style=" border: 0px solid #00BFFF; border-top:0px;font-family: Arial;
    font-size: 12px;"      >
  <tr>
    <th style=" height: 29px;text-align: left;font-size: 14px;text-align:center">
vehicle status
    </th>
  </tr>
  <tr>
    <td align="center" style=" padding:30px 50px 30px 0px;">
  

<input type='hidden' name='submitted' id='submitted' value='1'/>
             <!-- The inner table below is a container for form -->
                <table style="font-family:Arial;" width="100%"  cellpadding="10px" class="htmlForm" cellspacing="0" border="0">

                    <tr>
				
			<td  width="150px"><label style="margin-left:0px;">Vehicle Registration<em style="font-style:normal;color:red;">*</em></label></td>
				
					<td>
					<?php
			if(isset($_GET['id']))
			{ 		
				$result_state=mysql_query("select * from vehicle");
				echo '<select name="vehicle_reg_id" id="vehicle_reg_id" class="selectbox">';
				echo '<option value="0">Please select a  vehicle register number</option>';
				while($row=mysql_fetch_array($result_state))
				{
				if($row['id'] == $vehicle_reg_id){
						  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
					 } else {
						  $isSelected = ''; // else we remove any tag
					 }
					 echo "<option value='".$row['id']."'".$isSelected.">".$row['vehicle_regno']."</option>";
				}
				echo '</select>';
					
			}
			else
			{

					$result_state=mysql_query("select * from vehicle");
					echo '<select name="vehicle_reg_id" id="vehicle_reg_id" class="selectbox">';
					echo '<option value="0">Please select a  vehicle register number</option>';
					while($row=mysql_fetch_array($result_state))
					{
					echo '<option value="'.$row['id'].'">'.$row['vehicle_regno'].'</option>';

					}
					echo '</select>';
			}

?>
					</td>
					
				
			<td  width="150px"><label style="margin-left:0px;">Status<em style="font-style:normal;color:red;">*</em></label></td>
				
					<td>
					<?php
			if(isset($_GET['id']))
			{ 		
				$result_state=mysql_query("select * from status");
				echo '<select name="status_id" id="status_id" class="selectbox">';
				echo '<option value="0">Please select a vehicle status</option>';
				while($row=mysql_fetch_array($result_state))
				{
				if($row['id'] == $status_id){
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

				$result_state=mysql_query("select * from status");
				echo '<select name="status_id" id="status_id" class="selectbox">';
				echo '<option value="0">Please select a vehicle status</option>';
					while($row=mysql_fetch_array($result_state))
					{
					echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

					}
					echo '</select>';
			}

?>
					</td>
					</tr>
		<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="right" colspan="2">
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
	<div id="search" style="float:right;padding-right:20px;">

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
	<div id="content"></div>



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