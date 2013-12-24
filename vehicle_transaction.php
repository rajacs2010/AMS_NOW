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

   <script src="scripts/date.js"></script>
<link rel="stylesheet" href="style/date.css" media="screen">
   <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"transaction_date",
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
	};
</script>
<script>
function validateForm()
{

	var vehicle_reg_id=document.getElementById("vehicle_reg_id");
	if(vehicle_reg_id.value==0)
	{
	alert("Please select the vehicle registration number");
	document.getElementById("vehicle_reg_id").focus();
	return false;
	}
	
	var transaction_date=document.getElementById("transaction_date").value;
	if(transaction_date==""||transaction_date==0 || !transaction_date)
	{
	alert("Please select the date");
	document.getElementById("transaction_date").focus();
	return false;
	}
	var transaction_type_id=document.getElementById("transaction_type_id");
	if(transaction_type_id.value==0)
	{
	alert("Please enter the transaction type");
	document.getElementById("transaction_type_id").focus();
	return false;
	}
	var vendor_id=document.getElementById("vendor_id");
	if(vendor_id.value==0)
	{
	alert("Please select the vendor code");
	document.getElementById("vendor_id").focus();
	return false;
	}

	var uom=document.getElementById("uom");
	if(uom.value=="")
	{
	alert("Please enter the uom");
	document.getElementById("uom").focus();
	return false;
	}
	var units=document.getElementById("units");
	if(units.value=="")
	{
	alert("Please enter the units");
	document.getElementById("units").focus();
	return false;
	}
	
	var total_currency=document.getElementById("total_currency");
	if(total_currency.value==0)
	{
	alert("Please select the currency");
	document.getElementById("total_currency").focus();
	return false;
	}
	var rate=document.getElementById("rate");
	if(rate.value=="")
	{
	alert("Please enter the rate");
	document.getElementById("rate").focus();
	return false;
	}
	
	var cost=document.getElementById("cost");
	if(cost.value=="")
	{
	alert("Please enter the cost");
	document.getElementById("cost").focus();
	return false;
	}
	
	var desc=document.getElementById("desc");
	if(desc.value=="")
	{
	alert("Please enter the description");
	document.getElementById("desc").focus();
	return false;
	}
	var bought_by=document.getElementById("bought_by");
	if(bought_by.value==4)
	{
	alert("Please select the bought by");
	document.getElementById("bought_by").focus();
	return false;
	}
	var bought_id=document.getElementById("bought_id");
	if(bought_id.value=="" || bought_id.value==0)
	{
	alert("Please enter employee/driver/others");
	document.getElementById("bought_id").focus();
	return false;
	}
}
	</script>

 
   <script type="text/javascript" language="javascript">
   $(document).ready(function() {
	$("#vendor_id").change(function(event){
	var selvalue_vendor_id=document.getElementById("vendor_id").value;
	if (selvalue_vendor_id != 0)
	{
          $('#display_vendor_id').load('ajax_driver.php?selvalue_vendor_id='+selvalue_vendor_id);
	}
	else
	{
	document.getElementById("vendor_name").value = "";
	
	}
      });		
   });
   </script>
   
   <script type="text/javascript" language="javascript">
   $(document).ready(function() {
	$("#bought_by").change(function(event){
	var selvalue_bought_by=document.getElementById("bought_by").value;
	if (selvalue_bought_by != 0)
	{
          $('#display_bought_by').load('ajax_driver.php?selvalue_bought_by='+selvalue_bought_by);
	}
      });		
   });
   </script>
   <script type="text/javascript" language="javascript">
   $(document).ready(function() { 
    $("#units").blur(function(){
		var units=document.getElementById("units").value;
		var numericExpression = /^[+]?[0-9,]+(\[0-9,]+)?$/;
		if(!units.match(numericExpression))
		{
			alert("Please enter the numbers only");
			document.getElementById("units").value="";
			document.getElementById("units").focus();
			return false;
		}
		var x = $("#units").val();
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	
	if (document.getElementById("rate").value!="")
	{
		var y=$("#units").val();
		var z=$("#rate").val();
		var units_round=y.replace(/,/g,'');
		var rate_round=z.replace(/,/g,'');
		var cost = (units_round*rate_round);
		var cost=(Math.round(cost* 100) / 100);
		var cost_round=(cost.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
		if (cost>= 0)
		{
		document.getElementById("cost").value=cost_round;
		}
		else
		{
		document.getElementById("cost").value="";
		}
	}
		
	});
	});
   </script>
    <script type="text/javascript" language="javascript">
   $(document).ready(function() { 
    $("#rate").blur(function(){
	var rate=document.getElementById("rate").value;
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!rate.match(numericExpression))
		{
			alert("Please enter the numbers only");
			document.getElementById("rate").value="";
			document.getElementById("rate").focus();
			return false;
		}
	var x = $("#rate").val();
	var x=(Math.round(x * 100) / 100);
    $(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	var y=$("#units").val();
	var z=$("#rate").val();
	var units_round=y.replace(/,/g,'');
	var rate_round=z.replace(/,/g,'');
	var cost = (units_round*rate_round);
	var cost=(Math.round(cost* 100) / 100);
	var cost_round=(cost.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	if (cost>=0)
	{
	document.getElementById("cost").value=cost_round;
	}
	else
	{
	document.getElementById("cost").value="";
	}
	});
	});
   </script>
<?php
if(isset($_POST['save']))
{
$driver_code=$_POST['code'];
$emp_code=$_POST['emp_code'];

				$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select first_name from pim_emp_info where emp_code='$emp_code'  order by emp_id",$bd);
				while($row=mysql_fetch_array($result_emp_id))
				{
				$emp_name=$row['first_name'];
				}
				
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$address3=$_POST['address3'];
$city_driver=$_POST['city_driver'];
$contact_number=$_POST['contact_number'];
$alt_contact_number=$_POST['alt_contact_number'];
$licence_number=$_POST['licence_number'];
$license_date=$_POST['license_date'];
$renewal_date=$_POST['renewal_date'];
$user_id=$_SESSION['user_id'];
$fgmembersite->DBLogin();
if(!mysql_query('insert into driver SET driver_code="'.$driver_code.'",emp_name="'.$emp_name.'",emp_code="'.$emp_code.'",address1="'.$address1.'",address2="'.$address2.'",address3="'.$address3.'",city_id="'.$city_driver.'",contact_number="'.$contact_number.'",alt_contact_number="'.$alt_contact_number.'",license_number="'.$licence_number.'",license_date="'.$license_date.'",renewal_date="'.$renewal_date.'",created_by="'.$user_id.'" '))
{
die('Error: ' . mysql_error());
}
echo'<script> window.location="driver.php?success=true"; </script> ';


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
<span class="success_message">Vehicle transactions  created successfully</span>
<?php
}

}
?>
&nbsp;
<div class="header_bold">Vehicle transactions</div>
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
						<td  width="150px"><label style="margin-left:0px;">Vehicle registration number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php
						$result_state=mysql_query("select * from vehicle");
					echo '<select name="vehicle_reg_id" id="vehicle_reg_id" class="selectbox">';
					echo '<option value="0">Please select a  vehicle register number</option>';
					while($row=mysql_fetch_array($result_state))
					{
					echo '<option value="'.$row['id'].'">'.$row['vehicle_regno'].'</option>';

					}
					echo '</select>';
		           ?>
				 		
						</td>
						<td  width="150px"><label style="margin-left:0px;">Date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='transaction_date' id='transaction_date' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Transaction type<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php
						$result_state=mysql_query("select * from transaction_type");
					echo '<select name="transaction_type_id" id="transaction_type_id" class="selectbox">';
					echo '<option value="0">Please select a  transaction type</option>';
					while($row=mysql_fetch_array($result_state))
					{
					echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

					}
					echo '</select>';
		           ?>
				 		
						</td>
						
						
						
                    </tr>
					
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Transaction number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php
		 if(!isset($_GET[id]) && $_GET[id] == '') {
			$cusid					=	"SELECT transaction_number FROM  vehicle_transaction ORDER BY id DESC";			
			$cusold					=	mysql_query($cusid) or die(mysql_error());
			$cuscnt					=	mysql_num_rows($cusold);
			//$cuscnt					=	0; // comment if live
			if($cuscnt > 0) {
				$row_cus					  =	 mysql_fetch_array($cusold);
				$cusnumber	  =	$row_cus['transaction_number'];

				$getcusno						=	abs(str_replace("TR",'',strstr($cusnumber,"TR")));
				$getcusno++;
				if($getcusno < 10) {
					$createdcode	=	"00".$getcusno;
				} else if($getcusno < 100) {
					$createdcode	=	"0".$getcusno;
				} else {
					$createdcode	=	$getcusno;
				}

				$customer_code				=	"TR".$createdcode;
			} else {
				$customer_code				=	"TR001";
			}
		}
	?>
						<input type='text' name='code' id='code' class="textbox" value="<?php echo $customer_code;?>" readonly="true"/>
						</td>
						
						<td  width="150px"><label style="margin-left:0px;">Vendor code<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
					$result_state=mysql_query("select * from vendor");
					echo '<select name="vendor_id" id="vendor_id" class="selectbox">';
					echo '<option value="0">Please select a  vendor code</option>';
					while($row=mysql_fetch_array($result_state))
					{
					echo '<option value="'.$row['id'].'">'.$row['vendor_code'].'</option>';

					}
					echo '</select>';
		           ?>
					
							</td>
						<td  width="150px"><label style="margin-left:0px;">Vendor name<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<div id="display_vendor_id">
						<input type='text' name='vendor_name' id='vendor_name' class="textbox" />
					</div>
							</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Uom<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
						<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from uom");
							echo '<select name="uom" id="uom" class="selectbox">';
							echo '<option value="0">Please select a  uom</option>';
							while($row=mysql_fetch_array($result_state))
							{
							echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

							}
							echo '</select>';
							?>
					
							</td>
						<td  width="150px"><label style="margin-left:0px;">Units<em style="font-style:normal;color:red;">*</em></label></td>
                       
						<td >
							<input type='text' name='units' id='units' class="textbox" style="text-align:right;"/>
							</td>
						
			<td  width="150px"><label style="margin-left:0px;">Currency<em style="font-style:normal;color:red;">*</em></label></td>
                       
						<td>
							<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from currency");
							echo '<select name="total_currency" id="total_currency" class="selectbox">';
							echo '<option value="0">Please select a  currency</option>';
							while($row=mysql_fetch_array($result_state))
							{
							echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

							}
							echo '</select>';
							?>
							</td>
					</tr>
					<tr>
					
						<td  width="150px"><label style="margin-left:0px;">Rate<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='rate' id='rate' class="textbox" style="text-align:right;"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Cost<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='cost' id='cost' class="textbox" style="text-align:right;" readonly="true"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Description<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<textarea name='desc' id='desc' class="areatext"></textarea>
						</td>
					
			
					</tr>
					<td  width="150px"><label style="margin-left:0px;">Bought by<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<select name='bought_by' id='bought_by' class="textbox">
						<option value="4">Please select bought by</option>
						<option value="1">Employee</option>
						<option value="2">driver</option>
						<option value="3">others</option>
						</select>
						<td  width="150px"><label style="margin-left:0px;">Employee/driver/others<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<div id="display_bought_by">
						<input type="text" name="bought_id" id="bought_id" readonly="true"/>
						</div>
						</td>			
		<tr>
            <td  width="150px" >&nbsp;</td>
            <td align="center" colspan="5">	
            </td>
        </tr>
		<tr >
            <td  width="150px" >&nbsp;</td>
            <td  width="150px" align="right" colspan="3">
			<input type='submit'  class="flatbutton" name='save' id="save" value='Save'/>
			<input type='button'  class="flatbutton" name='view' id="view" value='View' onclick="location.href='view_vehicle_transaction.php'"/>

        

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