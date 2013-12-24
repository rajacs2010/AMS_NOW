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
if($fgmembersite->usertype() == 1)
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

<script type="text/javascript" language="javascript">
   $(document).ready(function() {
	$("#genrator_status").change(function(event){
	var selvalue_status=document.getElementById("genrator_status").value;
	//alert(selvalue_status);
	if (selvalue_status == 1 )
	{
	$("#total_currency").removeAttr("disabled"); 
	$("#cost").removeAttr("disabled"); 
	$("#datepurchase").removeAttr("disabled"); 
	$("#rent").attr("disabled", "disabled");  
	$("#periodfrom").attr("disabled", "disabled"); 
	$("#renewaldate").attr("disabled", "disabled"); 
	}
	if (selvalue_status == 2)
	{
	$("#total_currency").attr("disabled", "disabled"); 
	$("#cost").attr("disabled", "disabled"); 
	$("#datepurchase").attr("disabled", "disabled"); 
	$("#rent").removeAttr("disabled"); 
	$("#periodfrom").removeAttr("disabled"); 
	$("#renewaldate").attr("disabled", "disabled"); 
	
	}
	if (selvalue_status == 3)
	{
	$("#total_currency").attr("disabled", "disabled"); 
	$("#cost").attr("disabled", "disabled"); 
	$("#datepurchase").attr("disabled", "disabled"); 
	$("#rent").attr("disabled", "disabled");  
	$("#periodfrom").attr("disabled", "disabled"); 
	$("#renewaldate").removeAttr("disabled"); 
	
	
	}
	if (selvalue_status == 0)
	{
	$("#total_currency").removeAttr("disabled"); 
	$("#cost").removeAttr("disabled"); 
	$("#datepurchase").removeAttr("disabled");
	$("#rent").removeAttr("disabled"); 
	$("#periodfrom").removeAttr("disabled");
	$("#renewaldate").removeAttr("disabled");	
	}


      });		
   });
   </script>
   <script src="scripts/date.js"></script>
<link rel="stylesheet" href="style/date.css" media="screen">
   <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"datepurchase",
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
                    target:"renewaldate",
                    dateFormat:"%Y-%m-%d"

                });
				            
		              
	};
</script>
<script>
function validateForm()
{

	var generatorname=document.getElementById("generatorname");
	if(generatorname.value=="")
	{
	alert("Please enter the generator name");
	document.getElementById("generatorname").focus();
	return false;
	}
	var desc=document.getElementById("desc");
	if(desc.value=="")
	{
	alert("Please enter the description");
	document.getElementById("desc").focus();
	return false;
	}
	
	
	
	var building_code=document.getElementById("building_code");
	if(building_code.value==0)
	{
	alert("Please select the building code");
	document.getElementById("building_code").focus();
	return false;
	}
	var make=document.getElementById("make");
	if(make.value=="")
	{
	alert("Please enter the make");
	document.getElementById("make").focus();
	return false;
	}
	
	var model=document.getElementById("model");
	if(model.value=="")
	{
	alert("Please enter the model");
	document.getElementById("model").focus();
	return false;
	}
	var rating=document.getElementById("rating");
	if(rating.value=="")
	{
	alert("Please enter the rating");
	document.getElementById("rating").focus();
	return false;
	}
	var genrator_status=document.getElementById("genrator_status");
	if(genrator_status.value==0)
	{
	alert("Please select the genrator status");
	document.getElementById("genrator_status").focus();
	return false;
	}
		if(genrator_status.value==1)
	{
		var total_currency=document.getElementById("total_currency");
		if(total_currency.value=="")
		{
		alert("Please select the currency");
		document.getElementById("total_currency").focus();
		return false;
		}
		var cost=document.getElementById("cost");
		if(cost.value=="")
		{
		alert("Please enter the cost");
		document.getElementById("cost").focus();
		return false;
		}
		
		var datepurchase=document.getElementById("datepurchase").value;
		if(datepurchase==""||datepurchase==0 || !datepurchase)
		{
		alert("Please select the datepurchase");
		document.getElementById("datepurchase").focus();
		return false;
		}
	}
		
		if(genrator_status.value==2)
	{
		var rent=document.getElementById("rent");
		if(rent.value=="")
		{
		alert("Please enter the rent");
		document.getElementById("rent").focus();
		return false;
		}
		var periodfrom=document.getElementById("periodfrom");
		if(periodfrom.value==0)
		{
		alert("Please select the period");
		document.getElementById("periodfrom").focus();
		return false;
		}
	}
		var contract_number=document.getElementById("contract_number");
		if(contract_number.value=="")
		{
		alert("Please enter the contract number");
		document.getElementById("contract_number").focus();
		return false;
		}
		
		var maintain_currency=document.getElementById("maintain_currency");
		if(maintain_currency.value==0)
		{
		alert("Please enter  the maintain currency");
		document.getElementById("maintain_currency").focus();
		return false;
		}
		
		var vendor=document.getElementById("vendor");
		if(vendor.value=="")
		{
		alert("Please enter the vendor");
		document.getElementById("vendor").focus();
		return false;
		}
		
		var mcost=document.getElementById("mcost");
		if(mcost.value=="")
		{
		alert("Please enter the mcost");
		document.getElementById("mcost").focus();
		return false;
		}
		var maintain_period=document.getElementById("maintain_period");
		if(maintain_period.value==0)
		{
		alert("Please enter the maintain period");
		document.getElementById("maintain_period").focus();
		return false;
		}
		if(genrator_status.value==3)
	{	
		var renewaldate=document.getElementById("renewaldate").value;
		if(renewaldate==""||renewaldate==0 || !renewaldate)
		{
		alert("Please select the renewaldate");
		document.getElementById("renewaldate").focus();
		return false;
		}
	}
}
	
	
</script>

<?php
if(isset($_POST['save'])) {
$generator_code=$_POST['code'];
$generatorname=$_POST['generatorname'];
$desc=$_POST['desc'];
$building_code=$_POST['building_code'];
$make=$_POST['make'];
$model=$_POST['model'];
$rating=$_POST['rating'];
$genrator_status=$_POST['genrator_status'];
$total_currency=$_POST['total_currency'];
$cost=$_POST['cost'];
$datepurchase=$_POST['datepurchase'];
$rent=$_POST['rent'];
$periodfrom=$_POST['periodfrom'];
$contract_number=$_POST['contract_number'];
$vendor=$_POST['vendor'];
$mcost=$_POST['mcost'];
$maintain_currency=$_POST['maintain_currency'];
$maintain_period=$_POST['maintain_period'];
$renewaldate=$_POST['renewaldate'];
$user_id=$_SESSION['user_id'];
if(!mysql_query('insert into generator SET generator_code="'.$generator_code.'",generator_name="'.$generatorname.'", 	description="'.$desc.'",building_code="'.$building_code.'",make="'.$make.'",model="'.$model.'",rating="'.$rating.'",generator_status="'.$genrator_status.'",currency="'.$total_currency.'",cost="'.$cost.'",dateofpurchase="'.$datepurchase.'",rent="'.$rent.'",period="'.$periodfrom.'",contract_number="'.$contract_number.'",vendor="'.$vendor.'", 	maintenance_cost="'.$mcost.'",maintain_currency="'.$maintain_currency.'",maintain_period="'.$maintain_period.'",contract_renewaldate="'.$renewaldate.'",created_by="'.$user_id.'" '))
{
die('Error: ' . mysql_error());
}
$fgmembersite->RedirectToURL("generator.php?success=true");
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
<span class="success_message">Generator created successfully</span>
<?php
}

}
?>
&nbsp;
<div class="header_bold">Generator creation</div>
<div class="scroll">
<form id='generator_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">

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
						<td  width="150px"><label style="margin-left:0px;">Generator code<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php
		 if(!isset($_GET[id]) && $_GET[id] == '') {
			$cusid					=	"SELECT generator_code FROM  generator ORDER BY id DESC";			
			$cusold					=	mysql_query($cusid) or die(mysql_error());
			$cuscnt					=	mysql_num_rows($cusold);
			//$cuscnt					=	0; // comment if live
			if($cuscnt > 0) {
				$row_cus					  =	 mysql_fetch_array($cusold);
				$cusnumber	  =	$row_cus['generator_code'];

				$getcusno						=	abs(str_replace("GE",'',strstr($cusnumber,"GE")));
				$getcusno++;
				if($getcusno < 10) {
					$createdcode	=	"00".$getcusno;
				} else if($getcusno < 100) {
					$createdcode	=	"0".$getcusno;
				} else {
					$createdcode	=	$getcusno;
				}

				$customer_code				=	"GE".$createdcode;
			} else {
				$customer_code				=	"GE001";
			}
		}
	?>
						<input type='text' name='code' id='code' class="textbox" value="<?php echo $customer_code;?>" readonly="true"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Generator Name<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='generatorname' id='generatorname' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Description<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<textarea name='desc' id='desc' class="areatext"></textarea>
						</td>
						
						
						
                    </tr>
					
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Building Code<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
							$result_state=mysql_query("SELECT id,building_code from building");
							echo '<select name="building_code" id="building_code" >';
							echo '<option value="0">Please select a  building code</option>';
							while($row=mysql_fetch_array($result_state))
							{
							echo '<option value="'.$row['id'].'">'.$row['building_code'].'</option>';

							}
							echo '</select>';
							?>
							</td>
						
						<td  width="150px">
						
						<label style="margin-left:0px;">Make<em style="font-style:normal;color:red;">*</em></label>
						
						</td>
                        <td>
						<input type='text' name='make' id='make' class="textbox" />
					
						</td>
						<td  width="150px">
						
						<label style="margin-left:0px;">Model<em style="font-style:normal;color:red;">*</em></label>
						
						</td>
                        <td>
						<input type='text' name='model' id='model' class="textbox" />
					
						</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Rating<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='rating' id='rating' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Owned/rented/lease<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<select name="genrator_status" id="genrator_status" class="selectbox">
							<option value="0">Please select</option>
							<option value="1">owned</option>
							<option value="2">rented</option>
							<option value="3">lease</option>
							</select>
				
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
					<td  width="150px"><label style="margin-left:0px;">Cost<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='cost' id='cost' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Date of Purchase<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='datepurchase' id='datepurchase' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Rent<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='rent' id='rent' class="textbox"/>
						</td>
						
					
			
					</tr>
					<tr>
					<td  width="150px"><label style="margin-left:0px;">Period<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<select name="periodfrom" id="periodfrom" class="selectbox">
							<option value="0">Please select</option>
							<option value="1">monthly</option>
							<option value="2">quarterly</option>
							<option value="3">halfyearly</option>
							<option value="4">yearly</option>
							</select>
							</td>
						
			
						<td  width="150px"><label style="margin-left:0px;">Maintenance contract number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
					<input type='text' name='contract_number' id='contract_number' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Currency<em style="font-style:normal;color:red;">*</em></label></td>
								   
						<td>
							<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from currency");
							echo '<select name="maintain_currency" id="maintain_currency" class="selectbox">';
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
						
						<td  width="150px"><label style="margin-left:0px;">Vendor<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='vendor' id='vendor' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Maintenance cost<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
							<input type='text' name='mcost' id='mcost' class="textbox"/>
						</td>
			<td  width="150px"><label style="margin-left:0px;">Period<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='maintain_period' id='maintain_period' class="textbox" />
						</td>
					</tr>
					<tr>
						
						
						
						<td  width="150px"><label style="margin-left:0px;">Contract renewal date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='renewaldate' id='renewaldate' class="textbox"/>
						</td>
			
					</tr>
					
					
					
		<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="center" colspan="5">
	
			<input type='submit'  class="flatbutton" name='save' id="save" value='Save'/>
			<input type='button'  class="flatbutton" name='view' id="view" value='View' onclick="location.href='view_generator.php'"/>
	
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