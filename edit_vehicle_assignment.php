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
<style>
input[type="text"]:disabled
{
background:#dddddd;
}
</style>

   <script src="scripts/date.js"></script>
<link rel="stylesheet" href="style/date.css" media="screen">
   <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"mduedate",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
                                new JsDatePick({
                    useMode:2,
                    target:"donedate",
                    dateFormat:"%Y-%m-%d"

                });
				        
           new JsDatePick({
                    useMode:2,
                    target:"nextduedate",
                    dateFormat:"%Y-%m-%d"

                });						
		              
	};
</script>
<script>
function validateForm()
{
		
		var vehicle_regno=document.getElementById("vehicle_regno");
		if(vehicle_regno.value==0)
		{
		alert("Please select the vehicle registration number");
		document.getElementById("vehicle_regno").focus();
		return false;
		}
		var driver_code=document.getElementById("driver_code");
		if(driver_code.value==0)
		{
		alert("Please select the driver code");
		document.getElementById("driver_code").focus();
		return false;
		}
		
		var mdate=document.getElementById("mdate").value;
		if(mdate==""||mdate==0 || !mdate)
		{
		alert("Please select the date");
		document.getElementById("mdate").focus();
		return false;
		}
	
		var assignment_type=document.getElementById("assignment_type");
		if(assignment_type.value==0)
		{
		alert("Please select the assignment type");
		document.getElementById("assignment_type").focus();
		return false;
		}
	
		var from_date=document.getElementById("from_date").value;
		if(from_date==""||from_date==0 || !from_date)
		{
		alert("Please select the from date");
		document.getElementById("from_date").focus();
		return false;
		}
		
		
		var to_date=document.getElementById("to_date").value;
		if(to_date==""||to_date==0 || !to_date)
		{
		alert("Please select the to date");
		document.getElementById("to_date").focus();
		return false;
		}
		var from_date_replace=from_date.replace(/-/g,',');
		var to_date_replace=to_date.replace(/-/g,',');
		from_date_new = new Date(from_date_replace);
		to_date_new = new Date(to_date_replace);
		if(from_date_new.getTime() <= to_date_new.getTime())
		{
		
		var desc=document.getElementById("desc");
		if(desc.value=="")
		{
		alert("Please enter the assignment description");
		document.getElementById("desc").focus();
		return false;
		}
		else
		{
		return true;
		}
		
	
		}
		else
		{
		alert("Please select the to date greater than or equal to from date");
		document.getElementById("to_date").focus();
		return false;
		}

}
</script>

 <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"mdate",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
				new JsDatePick({
                    useMode:2,
                    target:"from_date",
                    dateFormat:"%Y-%m-%d"

                });
				              new JsDatePick({
                    useMode:2,
                    target:"to_date",
                    dateFormat:"%Y-%m-%d"

                });			
		              
	};
</script>


<?php
if(isset($_POST['save']))
{
$code=$_POST['code'];
$vehicle_regno=$_POST['vehicle_regno'];
$driver_code=$_POST['driver_code'];
$mdate=$_POST['mdate'];
$assignment_type=$_POST['assignment_type'];
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$desc=$_POST['desc'];
$user_id=$_SESSION['user_id'];
$edit_id=$_POST['edit_id'];
$current_date=date("Y-m-d H:i:s");

if(!mysql_query('update vehicle_assignment SET  assignment_no="'.$code.'",vehicle_registration_id="'.$vehicle_regno.'",driver_code_id="'.$driver_code.'",assignment_date="'.$mdate.'",assignment_type_id="'.$assignment_type.'",from_date="'.$from_date.'",to_date="'.$to_date.'",assignment_desc="'.$desc.'",updated_by="'.$user_id.'",updated_at="'.$current_date.'" WHERE id="'.$edit_id.'"'))
{
die('Error: ' . mysql_error());
}
$fgmembersite->RedirectToURL("edit_vehicle_assignment.php?id=$edit_id&success=true");
}



?>

<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT * FROM vehicle_assignment where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
$assignment_no=$row['assignment_no'];
$vehicle_registration_id=$row['vehicle_registration_id'];
$driver_code_id=$row['driver_code_id'];
$assignment_date=$row['assignment_date'];
$assignment_type_id=$row['assignment_type_id'];
$from_date=$row['from_date'];
$to_date=$row['to_date'];
$assignment_desc=$row['assignment_desc'];
}
}
?>


<div id="inside_content">
&nbsp;
<?php
if(isset($_GET['success']))
{
if ($_GET['success']=="true")
{

?>
<span class="success_message">Vehicle assignment updated  successfully</span>
<?php
}

}
?>
&nbsp;
<div class="header_bold">Vehicle assignment</div>
<br/>
<br/>
<div class="scroll_not">
<form id='vehicle_assign_edit' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">

<table id="building_class" align="center" width="90%"CELLPADDING="3" CELLSPACING="0"  style=" border: 0px solid #00BFFF; border-top:0px;font-family: Arial;
    font-size: 12px;">
  <!--<tr>
    <th style="background: url('images/th.png'); height: 29px;color:#ffffff;text-align: left;font-size: 14px;text-align:center">
Building
    </th
<th style=" height: 29px;text-align: left;font-size: 14px;text-align:center">
Building
    </0
	th>
  </tr>-->
  <tr>
    <td align="center" style=" padding:30px 50px 30px 0px;">
  

<input type='hidden' name='submitted' id='submitted' value='1'/>
             <!-- The inner table below is a container for form -->
                <table style="font-family:Arial;" width="100%"  cellpadding="10px" class="htmlForm" cellspacing="0" border="0">
					
					
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Assignment number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='code' id='code' class="textbox" value="<?php echo $assignment_no;?>" readonly="true"/>
						</td>
						
						<td  width="150px"><label style="margin-left:0px;">Vehicle registration<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
							$result_state=mysql_query("SELECT id,vehicle_regno from vehicle");
							echo '<select name="vehicle_regno" id="vehicle_regno" >';
							echo '<option value="0">Please select a  vehicle reg no</option>';
							while($row=mysql_fetch_array($result_state))
							{
							if($row['id'] == $vehicle_registration_id){
								  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
							 } else {
								  $isSelected = ''; // else we remove any tag
							 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$row['vehicle_regno']."</option>";
							}
							echo '</select>';
							?>
							</td>
							
                          <td  width="150px"><label style="margin-left:0px;">Driver code<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
							$result_state=mysql_query("SELECT id,driver_code from driver");
							echo '<select name="driver_code" id="driver_code" >';
							echo '<option value="0">Please select a  driver code</option>';
							while($row=mysql_fetch_array($result_state))
							{
							
							if($row['id'] == $driver_code_id){
								  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
							 } else {
								  $isSelected = ''; // else we remove any tag
							 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$row['driver_code']."</option>";
							}
							echo '</select>';
							?>
							</td>
						
					</tr>	
					
					
					<tr>
	
							
						<td  width="150px"><label style="margin-left:0px;">Date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='mdate' id='mdate' class="textbox" value="<?php echo $assignment_date;?>"/>
						</td>
					<td  width="150px"><label style="margin-left:0px;">Assignment type<em style="font-style:normal;color:red;">*</em></label></td>
								   
						<td>
							<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from assignment_type");
							echo '<select name="assignment_type" id="assignment_type" class="selectbox">';
							echo '<option value="0">Please select a  assignment type</option>';
							while($row=mysql_fetch_array($result_state))
							{
							
							if($row['id'] == $assignment_type_id){
								  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
							 } else {
								  $isSelected = ''; // else we remove any tag
							 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$row['name']."</option>";
							}
							echo '</select>';
							?>
						</td>
						
						<td  width="150px"><label style="margin-left:0px;">From date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='from_date' id='from_date' class="textbox" value="<?php echo $from_date;?>"/>
						</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">To date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='to_date' id='to_date' class="textbox" value="<?php echo $to_date;?>"/>
						</td>

					<td  width="150px"><label style="margin-left:0px;">Assignment description<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<textarea id="desc" name="desc" class="areatext"><?php echo $assignment_desc;?></textarea>
						</td>						
					
						
						
					</tr>
					
									
		<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="center" colspan="5">
	<br/><br/><br/><br/><br/><br/><br/><br/>
		<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_GET['id'];?>"/>
			<input type='submit'  class="flatbutton" name='save' id="save" value='Save'/>
			<input type='button'  class="flatbutton" name='view' id="view" value='View' onclick="location.href='view_vehicle_assignment.php'"/>
	
            </td>
        </tr>
		
		
                </table>
                </form>            </td>

        </tr>




    </table>
	</form>
</div>
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