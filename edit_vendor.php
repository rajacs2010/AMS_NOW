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
function validateForm()
{

	var vendor_name=document.getElementById("vendor_name");
	if(vendor_name.value=="")
	{
	alert("Please enter the  vendor name");
	document.getElementById("vendor_name").focus();
	return false;
	}
	var address1=document.getElementById("address1");
	if(address1.value=="")
	{
	alert("Please enter the address line1");
	document.getElementById("address1").focus();
	return false;
	}
	var address2=document.getElementById("address2");
	if(address2.value=="")
	{
	alert("Please enter the address line2");
	document.getElementById("address2").focus();
	return false;
	}
	var address3=document.getElementById("address3");
	if(address3.value=="")
	{
	alert("Please enter the address line3");
	document.getElementById("address3").focus();
	return false;
	}

	var city_driver=document.getElementById("city_driver");
	if(city_driver.value==0)
	{
	alert("Please select the city");
	document.getElementById("city_driver").focus();
	return false;
	}
	var contact_number=document.getElementById("contact_number");
	if(contact_number.value=="")
	{
	alert("Please enter the contact number");
	document.getElementById("contact_number").focus();
	return false;
	}
	
	var alt_contact_number=document.getElementById("alt_contact_number");
	if(alt_contact_number.value=="")
	{
	alert("Please enter the alternate contact number");
	document.getElementById("alt_contact_number").focus();
	return false;
	}	
}
	</script>
   <script type="text/javascript" language="javascript">
   $(document).ready(function() {
	$("#city_driver").change(function(event){
	var selvalue_driver=document.getElementById("city_driver").value;
	if (selvalue_driver != 0)
	{
          $('#display_state_driver').load('ajax_driver.php?selvalue_driver='+selvalue_driver);
	}
	else
	{
	document.getElementById("state_driver").value = "";
	
	}
      });		
   });
   </script>
<?php
if(isset($_POST['save']))
{
$vendor_code=$_POST['code'];
$vendor_name=$_POST['vendor_name'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$address3=$_POST['address3'];
$city_driver=$_POST['city_driver'];
$contact_number=$_POST['contact_number'];
$alt_contact_number=$_POST['alt_contact_number'];
$user_id=$_SESSION['user_id'];
$edit_id=$_POST['edit_id'];
$current_date=date("Y-m-d H:i:s");
$fgmembersite->DBLogin();
if(!mysql_query('update vendor SET vendor_code="'.$vendor_code.'",vendor_name="'.$vendor_name.'",address1="'.$address1.'",address2="'.$address2.'",address3="'.$address3.'",city_id="'.$city_driver.'",contact_number="'.$contact_number.'",alt_contact_number="'.$alt_contact_number.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" '))
{
die('Error: ' . mysql_error());
}
$fgmembersite->RedirectToURL("edit_vendor.php?id=$edit_id&success=true");
echo "&nbsp;";
}
?>
<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT *,c.name as state_name  FROM vendor a ,city b, state c  where a.city_id=b.id and b.state_id=c.id and a.id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
$vendor_code=$row['vendor_code'];
$vendor_name=$row['vendor_name'];
$address1=$row['address1'];
$address2=$row['address2'];
$address3=$row['address3'];
$city_id=$row['city_id'];
$contact_number=$row['contact_number'];
$alt_contact_number=$row['alt_contact_number'];
$state_name=$row['state_name'];
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
<span class="success_message">Vendor updated successfully</span>
<?php
}

}
?>
&nbsp;
<div class="header_bold">Vendor creation</div>
<div class="scroll_not">
<form id='driver_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">

<table id="building_class" align="center" width="90%"CELLPADDING="3" CELLSPACING="0"  style=" border: 0px solid #00BFFF; border-top:0px;font-family: Arial;
    font-size: 12px;"      >
  <!--<tr>
    <th style="background: url('images/th.png'); height: 29px;color:#ffffff;text-align: left;font-size: 14px;text-align:center">
Building
    </th
<th style=" height: 29px;text-align: left;font-size: 14px;text-align:center">
Building
    </th>
  </tr>-->
  <tr>
    <td align="center" style=" padding:30px 50px 30px 0px;">
  

<input type='hidden' name='submitted' id='submitted' value='1'/>
             <!-- The inner table below is a container for form -->
                <table style="font-family:Arial;" width="100%"  cellpadding="10px" class="htmlForm" cellspacing="0" border="0">

                    <tr>
						<td  width="150px"><label style="margin-left:0px;"
						<em style="font-style:normal;color:red;">Vendor code</em></label></td>
                        <td>
						
						<input type='text' name='code' id='code' class="textbox" value="<?php echo $vendor_code;?>" readonly="true"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Name<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
					<input type='text' name='vendor_name' id='vendor_name' class="textbox" value="<?php echo $vendor_name;?>"/>
							</td>
						
						<td  width="150px"><label style="margin-left:0px;">Address line 1<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<textarea name='address1' id='address1' class="textbox"><?php echo $address1;?></textarea>
					
							</td>
						
						
                    </tr>
					
					<tr>
						
						
						<td  width="150px"><label style="margin-left:0px;">Address line 2<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<textarea name='address2' id='address2' class="textbox"><?php echo $address2;?></textarea>
					
							</td>
						<td  width="150px"><label style="margin-left:0px;">Address line 3<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<textarea name='address3' id='address3' class="textbox"><?php echo $address3;?></textarea>
					
							</td>
							<td  width="150px"><label style="margin-left:0px;">City<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id");
							echo '<select name="city_driver" id="city_driver" >';
							echo '<option value="0">Please select a  City</option>';
							while($row=mysql_fetch_array($result_state))
							{
							if($row['id'] == $city_id){
							  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
						 } else {
							  $isSelected = ''; // else we remove any tag
						 }
						 echo "<option value='".$row['id']."'".$isSelected.">".$row['name']."</option>";

							}
							echo '</select>';
							?>
						</td>
			
					</tr>
					<tr>
						
						
						<td  width="150px"><label style="margin-left:0px;">State<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<div id="display_state_driver">
						
						<input type='text' name='state_driver' id='state_driver' class="textbox" value="<?php echo $state_name;?>"  />
						
						</div>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Contact number<em style="font-style:normal;color:red;">*</em></label></td>
                       
						<td>
								<input type='text' name='contact_number' id='contact_number' class="textbox"  value="<?php echo $contact_number;?>"/>
							</td>
						<td  width="150px"><label style="margin-left:0px;">Alternate contact number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='alt_contact_number' id='alt_contact_number' class="textbox" value="<?php echo $alt_contact_number;?>"/>
						</td>
			
					</tr>			
		<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="center" colspan="5">
	<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_GET['id'];?>"/>
			<input type='submit'  class="flatbutton" name='save' id="save" value='Save'/>
			<input type='button'  class="flatbutton" name='view' id="view" value='View' onclick="location.href='view_vendor.php'"/>
	
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