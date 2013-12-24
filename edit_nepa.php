<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();

ini_set("display_errors",true);
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

extract($_REQUEST);
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";

echo "<pre>";
print_r($_FILES);
echo "</pre>";*/
//exit;

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

if ($fgmembersite->usertype() == 1)	{
	//$header_file='./layout/admin_header_bms.php';
	$header_file='./layout/admin_header_bms.php';
}

if(file_exists($header_file))	{
	include_once($header_file);
} else {
	$fgmembersite->RedirectToURL("index.php");
	exit;
}

$query_edit				=	"SELECT id,building_code,date,nepa_meter_number,amount,currency FROM nepa WHERE id = '$id'";			
$res_edit				=	mysql_query($query_edit) or die(mysql_error());
$row_edit				=	mysql_fetch_array($res_edit);

if(isset($_POST['formsaveval']) && $_POST[formsaveval] == 800) {
	
	//$sql=('insert into diesel SET generator_code="'.$generator_code.'",building_code="'.$building_code.'",date="'.$ddate.'",transaction_number="'.$tnumber.'",diesel_volume="'.$volume.'",currency="'.$add_currency.'",diesel_cost="'.$dcost.'",created_by="'.$user_id.'"');

	//echo $sql;
	//exit;
	
		$user_id		=	$_SESSION['user_id'];
		$add_currency	=	$fgmembersite->getdbval($_POST['add_currency'],'id','name','currency');
		if(!mysql_query('UPDATE nepa SET building_code="'.$building_code.'",nepa_meter_number="'.$mnumber.'",date="'.$mdate.'",amount="'.$amount.'",currency="'.$add_currency.'",updated_by="'.$user_id.'",updated_at="'.$current_date.'" WHERE id="'.$edit_id.'"')) {
			die('Error: ' . mysql_error());
		}
		$fgmembersite->RedirectToURL("view_nepa.php?success=update");
		echo "&nbsp;";
}
?>
<link href="css/popup.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.confirmMAp {
	margin:0 auto;
	display:none;
	background:#EEEEEE;
	color:#fff;
	width:622px;
	height:350px;
	position:fixed;
	left:250px;
	top:100px;
	border:1px solid #EEEEEE;
	z-index:2;
	border-radius:5px 5px 5px 5px;
}
.ShowMap{
	display:none;
	z-index:2;
	position:fixed;
	_position:absolute; /* hack for internet explorer */
	width:620px;
	height:320px;
	color:#FFF;
	border-radius:5px;
	background-color:#FFF;
	border:1px solid #cecece;
}

#mainareabuild {
	width:100%;
	height:528px;
	background:#ebebeb;
	/* overflow-y:auto; */
}
.myalignbuild {
	padding-top:8px;
	margin:0 auto;
	color:#FF0000;
}
#mytableformbuild {
    background: none repeat scroll 0 0 #FFFFFF;
    height: auto;
    margin-left: auto;
    margin-right: auto;
    width: 95%;
}
#errormsgbuild{
	width:45%;
	height:30px;
	background:#c1c1c1;
	margin-left:auto;
	margin-right:auto;
	border-radius:10px;
	padding-top:0px;
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	-ms-border-radius:10px;
	-o-border-radius:10px;
	text-align:center;
}
#closebutton {
  position:relative;
  top:-35px;
  right:-219px;
  border:none;
  background:url(images/close_pop.png) no-repeat;
  color:transparent;
}
.scroll_box {
	height:141px;
	overflow:auto;
}
.alignment2 {
    font-size: 16px;
    margin-left: 10px;
    padding-left: 20px;
    width: 95%;
}
.alignment3 {
	font-size: 16px;
    margin-left: 10px;
    padding-left: 2px;
    width: 90%;
}
</style>
<script type="text/javascript" language="javascript">

$(document).ready(function() {
	$(function () {
		/*$('#closebutton').button({
			icons: {
				primary : "../images/close_pop.png",
			},
			text:false
		});*/
		
		$('#closebutton').click(function(event) {
			//alert('232');
			$('#errormsgbuild').hide();
			return false;
		});		
	});

	$("#amount").on('blur',function() {

		var mcost=$(this).val();
		var numericExpression = /^[+]?[0-9,]+(\.[0-9,]+)?$/;
		if(!mcost.match(numericExpression))
		{
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x = $(this).val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));	
	});

	$("#mnumber").on('blur',function() {

		var mcost=$(this).val();
		var numericExpression = /^[0-9,]+$/;
		if(!mcost.match(numericExpression)) {
		$('.myalignbuild').html('ERR : Only Numbers! ');
		$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$(this).val("");
			$(this).focus();
			return false;
		}
		var x = $(this).val();
		var x=(x.toString().replace(/,/g,""));
		var x=(Math.round(x * 100) / 100);
		$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	});
	
	$("#part_save").on("click", function() {
		//alert("232");
		var building_code		=	$("#building_code").val();
		var mdate				=	$("#mdate").val();
		var mnumber				=	$("#mnumber").val();
		var amount				=	$("#amount").val();
		var add_currency		=	$("#add_currency").val();
		
		var	currentdate		=	new Date();
		var dte2			=	parseInt(mdate.substring(0,2),10);
		var mont2			=	(parseInt(mdate.substring(3,5), 10)) -1;
		var year2			=	parseInt(mdate.substring(6,10),10);

		var date2			=	new Date(year2,mont2,dte2);

		if(building_code == '0') {
			$('.myalignbuild').html('ERR : Select Building Code');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#building_code").focus();
			return false;
		} else if(mnumber == '') {
			$('.myalignbuild').html('ERR : Enter Meter No.');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#mnumber").focus();
			return false;
		} else if(add_currency == '') {
			$('.myalignbuild').html('ERR : Enter Currency');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#add_currency").focus();
			return false;
		} else if(amount == '') {
			$('.myalignbuild').html('ERR : Enter Amount');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#amount").focus();
			return false;
		}  else if(mdate == '') {
			$('.myalignbuild').html('ERR : Select Date');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#mdate").focus();
			return false;
		} else if(date2 > currentdate) {
			$('.myalignbuild').html('ERR : Date Greater Than Today');
			$('#errormsgbuild').css('display','block');
			setTimeout(function() {
				$('#errormsgbuild').hide();
			},5000);
			$("#mdate").focus();
			return false;
		} 

		//alert(343);
		$("#formsaveval").val('800');
		//return false;
		$("#diesel_save").submit();
	});
}); 
</script>
<div id="mainareabuild">
<div class="mcf"></div>
<div align="center" class="headingsgr">NEPA</div>
<div id="mytableformbuild" align="center">
<form id='diesel_save' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8' enctype="multipart/form-data">
<div class="scroll_box">
<div id="firstdiv">
<table width="100%" align="left">
 <tr>
  <td>
<fieldset align="left" class="alignment2">
  <legend ><strong>Nepa</strong></legend>
<table width="50%" align="left">
 <tr>
  <td>
  <table>
    <tr height="30">
	 <td width="120" nowrap="nowrap">Building Code*</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	 <td><?php
		$fgmembersite->DBLogin();
		$result_state=mysql_query("SELECT id,building_code from building");
		echo '<select name="building_code" id="building_code" tabindex="1" >';
		echo '<option value="0">--Select--</option>';
		while($row=mysql_fetch_array($result_state))
		{
			if($row['id'] == $row_edit['building_code']){
				  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
			 } else {
				  $isSelected = ''; // else we remove any tag
			 }							
			echo "<option value='".$row['id']."'".$isSelected.">".$row['building_code']."</option>";
		}
		echo '</select>';
	?></td>
	</tr>
    
	<tr height="30">
	     <?php
			$fgmembersite->DBLogin();
			$result_state=mysql_query("SELECT * FROM currency");
			$row=mysql_fetch_array($result_state);
		?>
		<td width="120" >Currency &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img width="15px" height="15px" style="vertical-align:bottom;" src="images/<?php echo $row['symbol']; ?>" /></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<!-- <td><img width="15px" height="15px" src="images/currency.gif"></td> -->
		<td><input type='text' name='add_currency' id='add_currency' value="<?php echo $fgmembersite->getdbval($row_edit['currency'],'name','id','currency'); ?>" size="4" readonly class="textbox"/></td>
	</tr>

	<tr height="30">
     <td width="120">Date</td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><input type='text' name='mdate' id='mdate' tabindex="4" style="width:70px;" value="<?php echo $row_edit['date']; ?>" class="datepicker textbox"/></td>
	</tr>

   </table>
   </td>
 </tr>
</table>

<!----------------------------------------------- Left Table End -------------------------------------->

<table width="50%" align="left">
 <tr>
  <td>
   <table>
	<tr height="30">
     <td width="120">Nepa Meter No.*</td>
     <td><input type='text' name='mnumber' id='mnumber' style="text-align:right" tabindex="2" value="<?php echo number_format(str_replace(array(",","."),"",$row_edit['nepa_meter_number'])); ?>" size="12" autocomplete="off"class="textbox"/></td>
	</tr>

	<tr height="30">
		 <td width="120" nowrap="nowrap">Amount Paid*</td>
		 <td><input type='text' name='amount' id='amount' style="text-align:right" tabindex="3" value="<?php 
		if(strstr($row_edit['amount'],".")) {
			echo $row_edit['amount'];
		} else {
			echo $row_edit['amount'].".00";
		} ?>" size="12" autocomplete="off" class="textbox"/>
		 <input type='hidden' name='edit_id' id='edit_id' value="<?php echo $row_edit['id']; ?>" />
		 </td>
	</tr>

   </table>
  </td>
 </tr>
</table>

<!----------------------------------------------- Right Table End -------------------------------------->

</fieldset>
  </td>
</tr>
</table>

</div>


</div>
</div>
 <table width="100%" style="clear:both">
      <tr align="center" height="35px;">
      <td nowrap="nowrap">	  
	  <input type="submit" name="part_save" id="part_save" class="buttons" value="Save" />&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="hidden" name="formsaveval" id="formsaveval" /> <!-- This will give the value when form is submitted, otherwise it will empty -->
     <input type="reset" name="reset" class="buttons" value="Clear" id="clear" />&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="button" name="cancel" value="Cancel" class="buttons" onclick="window.location='ams_temp.php?id=2'"/>&nbsp;&nbsp;&nbsp;&nbsp;
	 <input type="button" name="View" value="View" class="buttons" onclick="window.location='view_nepa.php'"/></td>
	 </td>
     </tr>
  </table>
	<div id="errormsgbuild" style="display:none;"><h3 align="center" class="myalignbuild"></h3><button id="closebutton">Close</button></div>
</form>
<!-- </div> -->
</div>

<div id="backgroundChatPopup"></div>
<!-- <div id="map-canvas" style="width: 500px; height: 300px"></div> -->
<?php
$footerfile='./layout/footer.php';
if(file_exists($footerfile)) {
	include_once($footerfile);
} else {
	echo _FILENOTFOUNT.$footerfile;
}
?>