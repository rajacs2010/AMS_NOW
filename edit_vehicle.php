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

<script type="text/javascript">
  $(document).ready(function(){
    $('#car_reg_attach').change(function() {
	
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('car_reg_attach').files[0];
        if(file[index]) {
            fileUrl[index] = 'fms_uploads/' + file[index].name;
            checkFile[index] = new XMLHttpRequest();
            checkFile[index].onreadystatechange = function() {
                if (checkFile[index].readyState == 4) {
                    if (checkFile[index].status == 200) {
                        existing[index] = true; 
                        counter += 1;
                    }
                    else {
                        existing[index] = false;
                        counter += 1;
                    }
                    if (counter == fileUrl.length) { 
                            //existing.length of the array "true, false,,true" (i.e. with one undefined value) would deliver "4". 
                            //therefore we have to check for the number of set variables in the string rather than the strings length. 
                            //we use a counter for that purpose. everything after this point is only executed when the last file has been checked! 
                        if (existing.indexOf(true) == -1) {
                            //none of the files to be uploaded are already on server
							var filenamee=document.getElementById("car_reg_attach").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
							return true;
							}
							else
							{
							alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
							document.getElementById("car_reg_attach").value="";
							return false;
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("car_reg_attach").value="";
                            return false;
                        }
                    }
                }
            }
            checkFile[index].open('HEAD', fileUrl[index], true);
            checkFile[index].send();
        }
    })(i);
}
      return false;
   });
 }); 
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#insurance_attach').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('insurance_attach').files[0];
        if(file[index]) {
            fileUrl[index] = 'fms_uploads/' + file[index].name;
            checkFile[index] = new XMLHttpRequest();
            checkFile[index].onreadystatechange = function() {
                if (checkFile[index].readyState == 4) {
                    if (checkFile[index].status == 200) {
                        existing[index] = true; 
                        counter += 1;
                    }
                    else {
                        existing[index] = false;
                        counter += 1;
                    }
                    if (counter == fileUrl.length) { 
                            //existing.length of the array "true, false,,true" (i.e. with one undefined value) would deliver "4". 
                            //therefore we have to check for the number of set variables in the string rather than the strings length. 
                            //we use a counter for that purpose. everything after this point is only executed when the last file has been checked! 
                        if (existing.indexOf(true) == -1) {
                            //none of the files to be uploaded are already on server
							var filenamee=document.getElementById("insurance_attach").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
							return true;
							}
							else
							{
							alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
							document.getElementById("insurance_attach").value="";
							return false;
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("insurance_attach").value="";
                            return false;
                        }
                    }
                }
            }
            checkFile[index].open('HEAD', fileUrl[index], true);
            checkFile[index].send();
        }
    })(i);
}
      return false;
   });
 }); 
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#tax_attach').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('tax_attach').files[0];
        if(file[index]) {
            fileUrl[index] = 'fms_uploads/' + file[index].name;
            checkFile[index] = new XMLHttpRequest();
            checkFile[index].onreadystatechange = function() {
                if (checkFile[index].readyState == 4) {
                    if (checkFile[index].status == 200) {
                        existing[index] = true; 
                        counter += 1;
                    }
                    else {
                        existing[index] = false;
                        counter += 1;
                    }
                    if (counter == fileUrl.length) { 
                            //existing.length of the array "true, false,,true" (i.e. with one undefined value) would deliver "4". 
                            //therefore we have to check for the number of set variables in the string rather than the strings length. 
                            //we use a counter for that purpose. everything after this point is only executed when the last file has been checked! 
                        if (existing.indexOf(true) == -1) {
                            //none of the files to be uploaded are already on server
							var filenamee=document.getElementById("tax_attach").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
							return true;
							}
							else
							{
							alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
							document.getElementById("tax_attach").value="";
							return false;
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("tax_attach").value="";
                            return false;
                        }
                    }
                }
            }
            checkFile[index].open('HEAD', fileUrl[index], true);
            checkFile[index].send();
        }
    })(i);
}
      return false;
   });
 }); 
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#pollution_attach').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('pollution_attach').files[0];
        if(file[index]) {
            fileUrl[index] = 'fms_uploads/' + file[index].name;
            checkFile[index] = new XMLHttpRequest();
            checkFile[index].onreadystatechange = function() {
                if (checkFile[index].readyState == 4) {
                    if (checkFile[index].status == 200) {
                        existing[index] = true; 
                        counter += 1;
                    }
                    else {
                        existing[index] = false;
                        counter += 1;
                    }
                    if (counter == fileUrl.length) { 
                            //existing.length of the array "true, false,,true" (i.e. with one undefined value) would deliver "4". 
                            //therefore we have to check for the number of set variables in the string rather than the strings length. 
                            //we use a counter for that purpose. everything after this point is only executed when the last file has been checked! 
                        if (existing.indexOf(true) == -1) {
                            //none of the files to be uploaded are already on server
							var filenamee=document.getElementById("pollution_attach").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
							return true;
							}
							else
							{
							alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
							document.getElementById("pollution_attach").value="";
							return false;
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("pollution_attach").value="";
                            return false;
                        }
                    }
                }
            }
            checkFile[index].open('HEAD', fileUrl[index], true);
            checkFile[index].send();
        }
    })(i);
}
      return false;
   });
 }); 
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#fitness_attach').change(function() {
var existing = new Array();
var checkFile = new Array();
var file = new Array();
var fileUrl = new Array();
var counter = 0;
for (var i = 0; i < 1; i++) {
    (function(index){
        file[index] = document.getElementById('fitness_attach').files[0];
        if(file[index]) {
            fileUrl[index] = 'fms_uploads/' + file[index].name;
            checkFile[index] = new XMLHttpRequest();
            checkFile[index].onreadystatechange = function() {
                if (checkFile[index].readyState == 4) {
                    if (checkFile[index].status == 200) {
                        existing[index] = true; 
                        counter += 1;
                    }
                    else {
                        existing[index] = false;
                        counter += 1;
                    }
                    if (counter == fileUrl.length) { 
                            //existing.length of the array "true, false,,true" (i.e. with one undefined value) would deliver "4". 
                            //therefore we have to check for the number of set variables in the string rather than the strings length. 
                            //we use a counter for that purpose. everything after this point is only executed when the last file has been checked! 
                        if (existing.indexOf(true) == -1) {
                            //none of the files to be uploaded are already on server
							var filenamee=document.getElementById("fitness_attach").value;
							var extension=filenamee.split('.').pop();
							if ((extension=="pdf" ) || (extension=="png") || (extension=="jpg") ||(extension=="jpeg") ||(extension=="gif"))
							{
							return true;
							}
							else
							{
							alert("Invalid File extension Only (pdf,gif,jpeg,png) are allowed");
							document.getElementById("fitness_attach").value="";
							return false;
							}
                       //return true; 
                        }
                        else {
                            //list filenames and/or upload field numbers of the files that already exist on server
                            //   ->> inform user... 
							alert("The file name already exits");
							document.getElementById("fitness_attach").value="";
                            return false;
                        }
                    }
                }
            }
            checkFile[index].open('HEAD', fileUrl[index], true);
            checkFile[index].send();
        }
    })(i);
}
      return false;
   });
 }); 
</script>
<script>
function validateForm()
{
	var vregno=document.getElementById("vregno");
	if(vregno.value=="")
	{
	alert("Please enter the vehicle registration number");
	document.getElementById("vregno").focus();
	return false;
	}
	
	var vdate=document.getElementById("vdate").value;
	if(vdate==""||vdate==0 || !vdate)
	{
	alert("Please select the vehicle registration date");
	document.getElementById("vdate").focus();
	return false;
	}
	
	var comp_id=document.getElementById("comp_id");
	if(comp_id.value==0)
	{
	alert("Please select the company");
	document.getElementById("comp_id").focus();
	return false;
	}
	
	var insurance_number=document.getElementById("insurance_number");
	if(insurance_number.value=="")
	{
	alert("Please enter the insurance number");
	document.getElementById("insurance_number").focus();
	return false;
	}
	var insurance_company=document.getElementById("insurance_company");
	if(insurance_company.value=="")
	{
	alert("Please enter the insurance company ");
	document.getElementById("insurance_company").focus();
	return false;
	}
	
	var insurance_date=document.getElementById("insurance_date").value;
	if(insurance_date==""||insurance_date==0 || !insurance_date)
	{
	alert("Please select the insurance date");
	document.getElementById("insurance_date").focus();
	return false;
	}
	
	var currency=document.getElementById("currency");
	if(currency.value==0)
	{
	alert("Please select currency ");
	document.getElementById("currency").focus();
	return false;
	}
	
	var insurance_amount=document.getElementById("insurance_amount");
	if(insurance_amount.value=="")
	{
	alert("Please enter the insurance premium amount");
	document.getElementById("insurance_amount").focus();
	return false;
	}
	
	var insurance_duedate=document.getElementById("insurance_duedate").value;
	if(insurance_duedate==""||insurance_duedate==0 || !insurance_duedate)
	{
	alert("Please select the insurance renenwal due date");
	document.getElementById("insurance_duedate").focus();
	return false;
	}
	
	
	var tax_number=document.getElementById("tax_number");
	if(tax_number.value=="")
	{
	alert("Please enter the tax number");
	document.getElementById("tax_number").focus();
	return false;
	}
	
	var tax_authority=document.getElementById("tax_authority");
	if(tax_authority.value=="")
	{
	alert("Please enter the tax authority");
	document.getElementById("tax_authority").focus();
	return false;
	}

	var tax_date=document.getElementById("tax_date").value;
	if(tax_date==""||tax_date==0 || !tax_date)
	{
	alert("Please select the tax date");
	document.getElementById("tax_date").focus();
	return false;
	}
	
	var tax_currency=document.getElementById("tax_currency");
	if(tax_currency.value==0)
	{
	alert("Please select the currency");
	document.getElementById("tax_currency").focus();
	return false;
	}

	var tax_amount=document.getElementById("tax_amount");
	if(tax_amount.value=="")
	{
	alert("Please enter the tax amount");
	document.getElementById("tax_amount").focus();
	return false;
	}

	var tax_renewal_date=document.getElementById("tax_renewal_date").value;
	if(tax_renewal_date==""||tax_renewal_date==0 || !tax_renewal_date)
	{
	alert("Please select the tax renewal date");
	document.getElementById("tax_renewal_date").focus();
	return false;
	}
	
	var fit_certificate_no=document.getElementById("fit_certificate_no");
	if(fit_certificate_no.value=="")
	{
	alert("Please enter the Fitness certificate number");
	document.getElementById("fit_certificate_no").focus();
	return false;
	}
	
	var next_inspection_date=document.getElementById("next_inspection_date").value;
	if(next_inspection_date==""||next_inspection_date==0 || !next_inspection_date)
	{
	alert("Please select the next inspection date");
	document.getElementById("next_inspection_date").focus();
	return false;
	}
	
	var certification_currency=document.getElementById("certification_currency");
	if(certification_currency.value==0)
	{
	alert("Please select the currency");
	document.getElementById("certification_currency").focus();
	return false;
	}
	
	var certification_cost=document.getElementById("certification_cost");
	if(certification_cost.value=="")
	{
	alert("Please enter the fitness certification cost");
	document.getElementById("certification_cost").focus();
	return false;
	}
	
	var pollution_certificate_no=document.getElementById("pollution_certificate_no");
	if(pollution_certificate_no.value=="")
	{
	alert("Please enter the pollution certificate number");
	document.getElementById("pollution_certificate_no").focus();
	return false;
	}
	
	var pollution_certificate_date=document.getElementById("pollution_certificate_date").value;
	if(pollution_certificate_date==""||pollution_certificate_date==0 || !pollution_certificate_date)
	{
	alert("Please select the pollution certificate date");
	document.getElementById("pollution_certificate_date").focus();
	return false;
	}
	var pollution_inspection_date=document.getElementById("pollution_inspection_date").value;
	if(pollution_inspection_date==""||pollution_inspection_date==0 || !pollution_inspection_date)
	{
	alert("Please select the next pollution inspection date");
	document.getElementById("pollution_inspection_date").focus();
	return false;
	}
	
	var pollution_currency=document.getElementById("pollution_currency");
	if(pollution_currency.value==0)
	{
	alert("Please select the pollution currency");
	document.getElementById("pollution_currency").focus();
	return false;
	}
	var pollution_certificate_cost=document.getElementById("pollution_certificate_cost");
	if(pollution_certificate_cost.value=="")
	{
	alert("Please enter the pollution certificate cost");
	document.getElementById("pollution_certificate_cost").focus();
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
	var year=document.getElementById("year");
	if(year.value=="")
	{
	alert("Please enter the year");
	document.getElementById("year").focus();
	return false;
	}
	var model_currency=document.getElementById("model_currency");
	if(model_currency.value==0)
	{
	alert("Please select the model currency");
	document.getElementById("model_currency").focus();
	return false;
	}
	var model_cost=document.getElementById("model_cost");
	if(model_cost.value=="")
	{
	alert("Please enter the model cost");
	document.getElementById("model_cost").focus();
	return false;
	}
	
	var maintain_currency=document.getElementById("maintain_currency");
	if(maintain_currency.value==0)
	{
	alert("Please select the currency");
	document.getElementById("maintain_currency").focus();
	return false;
	}
	var total_maintain_cost=document.getElementById("total_maintain_cost");
	if(total_maintain_cost.value=="")
	{
	alert("Please enter the total maintenance  cost");
	document.getElementById("total_maintain_cost").focus();
	return false;
	}
	
	var cost_month=document.getElementById("cost_month");
	if(cost_month.value=="")
	{
	alert("Please enter the cost/month");
	document.getElementById("cost_month").focus();
	return false;
	}
	var total_fuel_cost=document.getElementById("total_fuel_cost");
	if(total_fuel_cost.value=="")
	{
	alert("Please enter the total fuel cost");
	document.getElementById("total_fuel_cost").focus();
	return false;
	}
	var cost_month_fuel=document.getElementById("cost_month_fuel");
	if(cost_month_fuel.value=="")
	{
	alert("Please enter the cost/month");
	document.getElementById("cost_month_fuel").focus();
	return false;
	}
	
}
 
</script>
<script src="scripts/date.js"></script>
<link rel="stylesheet" href="style/date.css" media="screen">   
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"vdate",
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
                    target:"insurance_date",
                    dateFormat:"%Y-%m-%d"

                });
				              new JsDatePick({
                    useMode:2,
                    target:"insurance_duedate",
                    dateFormat:"%Y-%m-%d"

                });
		              new JsDatePick({
                    useMode:2,
                    target:"tax_date",
                    dateFormat:"%Y-%m-%d"

                });
				
				       new JsDatePick({
                    useMode:2,
                    target:"tax_renewal_date",
                    dateFormat:"%Y-%m-%d"

                });
				
				       new JsDatePick({
                    useMode:2,
                    target:"next_inspection_date",
                    dateFormat:"%Y-%m-%d"

                });
				
				    new JsDatePick({
                    useMode:2,
                    target:"pollution_certificate_date",
                    dateFormat:"%Y-%m-%d"

                });
				
				
				    new JsDatePick({
                    useMode:2,
                    target:"pollution_inspection_date",
                    dateFormat:"%Y-%m-%d"

                });
				
	};
</script>
<?php
if(isset($_POST['save']))
{
if(isset($_FILES["car_reg_attach"]["name"]))
{
$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
$temp = explode(".", $_FILES["car_reg_attach"]["name"]);
$extension = end($temp);
if (in_array($extension, $allowedExts))
  {
  if ($_FILES["car_reg_attach"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["car_reg_attach"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("fms_uploads/" . $_FILES["car_reg_attach"]["name"]))
      {
      //echo $_FILES["car_reg_attach"]["name"] . " already exists. ";
	  $car_reg_attach="";
      }
    else
      {
	  $car_reg_attach=$_FILES["car_reg_attach"]["name"];
      move_uploaded_file($_FILES["car_reg_attach"]["tmp_name"],
      "fms_uploads/" . $_FILES["car_reg_attach"]["name"]);
     // echo "Stored in: " . "fms_uploads/" . $_FILES["car_reg_attach]["name"];
      }
    }
  }
	else
	{
	 $car_reg_attach="";
	}
}
//
if(isset($_FILES["insurance_attach"]["name"]))
{
$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
$temp = explode(".", $_FILES["insurance_attach"]["name"]);
$extension = end($temp);
if (in_array($extension, $allowedExts))
  {
  if ($_FILES["insurance_attach"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["insurance_attach"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("fms_uploads/" . $_FILES["insurance_attach"]["name"]))
      {
      //echo $_FILES["insurance_attach"]["name"] . " already exists. ";
	  $insurance_attach="";
      }
    else
      {
	  $insurance_attach=$_FILES["insurance_attach"]["name"];
      move_uploaded_file($_FILES["insurance_attach"]["tmp_name"],
      "fms_uploads/" . $_FILES["insurance_attach"]["name"]);
     // echo "Stored in: " . "fms_uploads/" . $_FILES["insurance_attach"]["name"];
      }
    }
  }
	else
	{
	 $insurance_attach="";
	}
}
//
//
if(isset($_FILES["tax_attach"]["name"]))
{

$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
$temp = explode(".", $_FILES["tax_attach"]["name"]);
$extension = end($temp);
if (in_array($extension, $allowedExts))
  {
  if ($_FILES["tax_attach"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["tax_attach"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("fms_uploads/" . $_FILES["tax_attach"]["name"]))
      {
      //echo $_FILES["tax_attach"]["name"] . " already exists. ";
	  $tax_attach="";
      }
    else
      {
	  $tax_attach=$_FILES["tax_attach"]["name"];
      move_uploaded_file($_FILES["tax_attach"]["tmp_name"],
      "fms_uploads/" . $_FILES["tax_attach"]["name"]);
     // echo "Stored in: " . "fms_uploads/" . $_FILES["tax_attach"]["name"];
      }
    }
  }
	else
	{
	 $tax_attach="";
	}
}
//

if(isset($_FILES["pollution_attach"]["name"]))
{

$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
$temp = explode(".", $_FILES["pollution_attach"]["name"]);
$extension = end($temp);
if (in_array($extension, $allowedExts))
  {
  if ($_FILES["pollution_attach"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["pollution_attach"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("fms_uploads/" . $_FILES["pollution_attach"]["name"]))
      {
      //echo $_FILES["pollution_attach"]["name"] . " already exists. ";
	  $pollution_attach="";
      }
    else
      {
	  $pollution_attach=$_FILES["pollution_attach"]["name"];
      move_uploaded_file($_FILES["pollution_attach"]["tmp_name"],
      "fms_uploads/" . $_FILES["pollution_attach"]["name"]);
     // echo "Stored in: " . "fms_uploads/" . $_FILES["pollution_attach"]["name"];
      }
    }
  }
	else
	{
	 $pollution_attach="";
	}
}

//
if(isset($_FILES["fitness_attach"]["name"]))
{
$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
$temp = explode(".", $_FILES["fitness_attach"]["name"]);
$extension = end($temp);
if (in_array($extension, $allowedExts))
  {
  if ($_FILES["fitness_attach"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["fitness_attach"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("fms_uploads/" . $_FILES["fitness_attach"]["name"]))
      {
      //echo $_FILES["fitness_attach"]["name"] . " already exists. ";
	  $fitness_attach="";
      }
    else
      {
	  $fitness_attach=$_FILES["fitness_attach"]["name"];
      move_uploaded_file($_FILES["fitness_attach"]["tmp_name"],
      "fms_uploads/" . $_FILES["fitness_attach"]["name"]);
     // echo "Stored in: " . "fms_uploads/" . $_FILES["fitness_attach"]["name"];
      }
    }
  }
	else
	{
	 $fitness_attach="";
	}
}
$user_id=$_SESSION['user_id'];
$vregno=$_POST['vregno'];
$vdate=$_POST['vdate'];
$comp_id=$_POST['comp_id'];

$fgmembersite->DBLogin();
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
$result_emp_id=mysql_query("select * from master_companies where comp_id=$comp_id",$bd);
while($row=mysql_fetch_array($result_emp_id))
{
$comp_name=$row['comp_name'];
}			
$company_name=$comp_name;
$insurance_number=$_POST['insurance_number'];
$insurance_company=$_POST['insurance_company'];
$insurance_date=$_POST['insurance_date'];
$currency=$_POST['currency'];
$insurance_amount=$_POST['insurance_amount'];
$insurance_duedate=$_POST['insurance_duedate'];
$tax_number=$_POST['tax_number'];
$tax_authority=$_POST['tax_authority'];
$tax_date=$_POST['tax_date'];
$tax_currency=$_POST['tax_currency'];
$tax_amount=$_POST['tax_amount'];
$tax_renewal_date=$_POST['tax_renewal_date'];
$fit_certificate_no=$_POST['fit_certificate_no'];
$next_inspection_date=$_POST['next_inspection_date'];
$certification_currency=$_POST['certification_currency'];
$certification_cost=$_POST['certification_cost'];
$pollution_certificate_no=$_POST['pollution_certificate_no'];
$pollution_certificate_date=$_POST['pollution_certificate_date'];
$pollution_inspection_date=$_POST['pollution_inspection_date'];
$pollution_currency=$_POST['pollution_currency'];
$pollution_certificate_cost=$_POST['pollution_certificate_cost'];
$make=$_POST['make'];
$model=$_POST['model'];
$year=$_POST['year'];
$model_currency=$_POST['model_currency'];
$model_cost=$_POST['model_cost'];
$maintain_currency=$_POST['maintain_currency'];
$total_maintain_cost=$_POST['total_maintain_cost'];
$cost_month=$_POST['cost_month'];
$total_fuel_cost=$_POST['total_fuel_cost'];
$cost_month_fuel=$_POST['cost_month_fuel'];
$car_reg_attach=$car_reg_attach;
$insurance_attach=$insurance_attach;
$tax_attach=$tax_attach;
$pollution_attach=$pollution_attach;
$fitness_attach=$fitness_attach;
$edit_id=$_POST['edit_id'];
$current_date=date("Y-m-d H:i:s");
$fgmembersite->DBLogin();
if(!mysql_query('update vehicle SET vehicle_regno="'.$vregno.'",vehichle_reg_date="'.$vdate.'",vehicle_comp_id="'.$comp_id.'",vehicle_company_name="'.$company_name.'",insurance_number="'.$insurance_number.'",insurance_company="'.$insurance_company.'",insurance_date="'.$insurance_date.'",currency="'.$currency.'",insurance_amount="'.$insurance_amount.'",insurance_duedate="'.$insurance_duedate.'",tax_number="'.$tax_number.'",tax_authority="'.$tax_authority.'",tax_date="'.$tax_date.'",tax_currency="'.$tax_currency.'",tax_amount="'.$tax_amount.'",tax_renewal_date="'.$tax_renewal_date.'",fitness_certificate_no="'.$fit_certificate_no.'",next_inspection_date="'.$next_inspection_date.'",certification_currency="'.$certification_currency.'",fitness_certification_cost="'.$certification_cost.'",pollution_certificate_no="'.$pollution_certificate_no.'",pollution_certificate_date="'.$pollution_certificate_date.'",pollution_inspection_date="'.$pollution_inspection_date.'",pollution_currency="'.$pollution_currency.'",pollution_certificate_cost="'.$pollution_certificate_cost.'",make="'.$make.'",model="'.$model.'",year="'.$year.'",model_currency="'.$model_currency.'",model_cost="'.$model_cost.'",maintain_currency="'.$maintain_currency.'",total_maintain_cost="'.$total_maintain_cost.'",cost_month="'.$cost_month.'",total_fuel_cost="'.$total_fuel_cost.'",cost_month_fuel="'.$cost_month_fuel.'",car_reg_attach="'.$car_reg_attach.'",insurance_attach="'.$insurance_attach.'",tax_attach="'.$tax_attach.'",pollution_attach="'.$pollution_attach.'",fitness_attach="'.$fitness_attach.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" '))
{
die('Error: ' . mysql_error());
}
$fgmembersite->RedirectToURL("edit_vehicle.php?id=$edit_id&success=true");
echo "&nbsp;";

}

?>

<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT * FROM vehicle where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
$vehicle_regno=$row['vehicle_regno'];
$vehichle_reg_date=$row['vehichle_reg_date'];
$vehicle_comp_id=$row['vehicle_comp_id'];
$vehicle_company_name=$row['vehicle_company_name'];
$insurance_number=$row['insurance_number'];
$insurance_company=$row['insurance_company'];
$insurance_date=$row['insurance_date'];
$currency=$row['currency'];
$insurance_amount=$row['insurance_amount'];
$insurance_duedate=$row['insurance_duedate'];
$tax_number=$row['tax_number'];
$tax_authority=$row['tax_authority'];
$tax_date=$row['tax_date'];
$tax_currency=$row['tax_currency'];
$tax_amount=$row['tax_amount'];
$tax_renewal_date=$row['tax_renewal_date'];
$fitness_certificate_no=$row['fitness_certificate_no'];
$next_inspection_date=$row['next_inspection_date'];
$certification_currency=$row['certification_currency'];
$fitness_certification_cost=$row['fitness_certification_cost'];
$pollution_certificate_no=$row['pollution_certificate_no'];
$pollution_certificate_date=$row['pollution_certificate_date'];
$pollution_inspection_date=$row['pollution_inspection_date'];
$pollution_currency=$row['pollution_currency'];
$pollution_certificate_cost=$row['pollution_certificate_cost'];
$make=$row['make'];
$model=$row['model'];
$year=$row['year'];
$model_currency=$row['model_currency'];
$model_cost=$row['model_cost'];
$maintain_currency=$row['maintain_currency'];
$total_maintain_cost=$row['total_maintain_cost'];
$cost_month=$row['cost_month'];
$total_fuel_cost=$row['total_fuel_cost'];
$cost_month_fuel=$row['cost_month_fuel'];
$car_reg_attach=$row['car_reg_attach'];
$insurance_attach=$row['insurance_attach'];
$tax_attach=$row['tax_attach'];
$pollution_attach=$row['pollution_attach'];
$fitness_attach=$row['fitness_attach'];
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
<span class="success_message">Vehicle updated successfully</span>
<?php
}

}
?>
&nbsp;
<div class="header_bold">Vehicle</div>
<div class="scroll">
<form id='building_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm()"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">

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
						<input type='text' name='vregno' id='vregno' class="textbox" value="<?php echo $vehicle_regno;?>"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Vehicle registration date<em style="font-style:normal;color:red;">*</em></label></td>
				
						<td>
						<input type='text' name='vdate' id='vdate' class="textbox" value="<?php echo $vehichle_reg_date;?>"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Vehicle registered in company<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
							$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select * from master_companies  order by comp_id",$bd);
				echo '<select name="comp_id" id="comp_id" class="selectbox">';
				echo '<option value="0">Please select a company</option>';
				while($row=mysql_fetch_array($result_emp_id))
				{
				if($row['comp_id'] == $vehicle_comp_id){
							  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
						 } else {
							  $isSelected = ''; // else we remove any tag
						 }
							
							echo "<option value='".$row['comp_id']."'".$isSelected.">".$row['comp_name']."</option>";

				}
				echo '</select>';
							?>
			
							</td>
						
                    </tr>
					
					<tr>		
						<td  width="150px">
						
						<label style="margin-left:0px;">Insurance number<em style="font-style:normal;color:red;">*</em></label>
						
						</td>
                        <td>
						<input type='text' name='insurance_number' id='insurance_number' class="textbox" value="<?php echo $insurance_number;?>" />
						</td>
						<td  width="150px"><label style="margin-left:0px;">Insurance company<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							
				<input type='text' name='insurance_company' id='insurance_company' class="textbox" value="<?php echo $insurance_company;?>" />
							</td>
							<td  width="150px"><label style="margin-left:0px;">Insurance Date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='insurance_date' id='insurance_date' class="textbox" value="<?php echo $insurance_date;?>"/>
						</td>
			
					</tr>
					<tr>
						
						<td  width="150px"><label style="margin-left:0px;">Currency<em style="font-style:normal;color:red;">*</em></label></td>
                     
						<td>
							<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from currency");
							echo '<select name="currency" id="currency" class="selectbox">';
							echo '<option value="0">Please select a  currency</option>';
							while($row=mysql_fetch_array($result_state))
							{
							
									if($row['id'] == $currency){
							  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
						 } else {
							  $isSelected = ''; // else we remove any tag
						 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$row['name']."</option>";

							}
							echo '</select>';
							?>
							</td>
						
						<td  width="150px"><label style="margin-left:0px;">Insurance Premium amount<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='insurance_amount' id='insurance_amount' class="textbox" value="<?php echo $insurance_amount;?>"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Insurance renewal due date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='insurance_duedate' id='insurance_duedate' class="textbox" value="<?php echo $insurance_duedate;?>"/>
						</td>
			
					</tr>
					<tr>
						
						<td  width="150px"><label style="margin-left:0px;">Tax number<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
						<input type='text' name='tax_number' id='tax_number' class="textbox" value="<?php echo $tax_number;?>"/>

							</td>
						<td  width="150px"><label style="margin-left:0px;">Tax authority<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='tax_authority' id='tax_authority' class="textbox" value="<?php echo $tax_authority;?>"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Tax date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='tax_date' id='tax_date' class="textbox" value="<?php echo $tax_date;?>"/>
						</td>
						
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Currency<em style="font-style:normal;color:red;">*</em></label></td>
                     
						<td>
							<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from currency");
							echo '<select name="tax_currency" id="tax_currency" class="selectbox">';
							echo '<option value="0">Please select a  currency</option>';
							while($row=mysql_fetch_array($result_state))
							{
							if($row['id'] == $tax_currency){
							  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
						 } else {
							  $isSelected = ''; // else we remove any tag
						 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$row['name']."</option>";


							}
							echo '</select>';
							?>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Tax amount<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='tax_amount' id='tax_amount' class="textbox"  value="<?php echo $tax_amount;?>"/>
						</td>
			<td  width="150px"><label style="margin-left:0px;">Tax renewal date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='tax_renewal_date' id='tax_renewal_date' class="textbox"  value="<?php echo $tax_renewal_date;?>"/>
						</td>
					</tr>
					<tr>
						
						<td  width="150px"><label style="margin-left:0px;">Fitness certificate number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='fit_certificate_no' id='fit_certificate_no' class="textbox" value=<?php echo $fitness_certificate_no;?>/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Next inspection date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='next_inspection_date' id='next_inspection_date' class="textbox" value="<?php echo $next_inspection_date;?>"/>
						</td>
			<td  width="150px"><label style="margin-left:0px;">Currency<em style="font-style:normal;color:red;">*</em></label></td>
                     
						<td>
							<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from currency");
							echo '<select name="certification_currency" id="certification_currency" class="selectbox">';
							echo '<option value="0">Please select a  currency</option>';
							while($row=mysql_fetch_array($result_state))
							{
							if($row['id'] == $certification_currency){
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
						<td  width="150px"><label style="margin-left:0px;">Fitness certification cost<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
					
						
						<input type='text' name='certification_cost' id='certification_cost' class="textbox" 
					 value="<?php echo $fitness_certification_cost;?>" />
					
						</td>
						<td  width="150px"><label style="margin-left:0px;">Pollution certificate number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='pollution_certificate_no' id='pollution_certificate_no' class="textbox" value="<?php echo $pollution_certificate_no;?>" />
						</td>
						<td  width="150px"><label style="margin-left:0px;">Pollution certificate date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='pollution_certificate_date' id='pollution_certificate_date' class="textbox" value="<?php echo $pollution_certificate_date;?>"/>
						</td>
			
					</tr>
					<tr>
						
						<td  width="150px"><label style="margin-left:0px;">Next pollution inspection date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='pollution_inspection_date' id='pollution_inspection_date' class="textbox" value="<?php echo $pollution_inspection_date;?>"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Currency<em style="font-style:normal;color:red;">*</em></label></td>
                     
						<td>
							<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from currency");
							echo '<select name="pollution_currency" id="pollution_currency" class="selectbox">';
							echo '<option value="0">Please select a  currency</option>';
							while($row=mysql_fetch_array($result_state))
							{
							if($row['id'] == $pollution_currency){
							  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
						 } else {
							  $isSelected = ''; // else we remove any tag
						 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$row['name']."</option>";

							}
							echo '</select>';
							?>
							</td>
							<td  width="150px"><label style="margin-left:0px;">Pollution certification cost<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='pollution_certificate_cost' id='pollution_certificate_cost' class="textbox" value="<?php echo $pollution_certificate_cost;?>"/>
						</td>
			
					</tr>
					
					<tr>
						
						<td  width="150px"><label style="margin-left:0px;">Make<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='make' id='make' class="textbox" value="<?php echo $make;?>"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Model<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='model' id='model' class="textbox" value="<?php echo $model;?>"/>
						</td>
			<td  width="150px"><label style="margin-left:0px;">Year<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
						<input type='text' name='year' id='year' class="textbox" value="<?php echo $year;?>"/>
							</td>
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">currency<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from currency");
							echo '<select name="model_currency" id="model_currency" class="selectbox">';
							echo '<option value="0">Please select a  currency</option>';
							while($row=mysql_fetch_array($result_state))
							{
							if($row['id'] == $model_currency){
							  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
						 } else {
							  $isSelected = ''; // else we remove any tag
						 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$row['name']."</option>";

							}
							echo '</select>';
							?>
					
						</td>
						<td  width="150px"><label style="margin-left:0px;">cost<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						
						<input type='text' name='model_cost' id='model_cost' class="textbox" value="<?php echo $model_cost;?>"/>
						</td>
			<td  width="150px"><label style="margin-left:0px;">currency <em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from currency");
							echo '<select name="maintain_currency" id="maintain_currency" class="selectbox">';
							echo '<option value="0">Please select a  currency</option>';
							while($row=mysql_fetch_array($result_state))
							{
							if($row['id'] == $maintain_currency){
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
						
						<td  width="150px"><label style="margin-left:0px;">Total maintenance cost <em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='total_maintain_cost' id='total_maintain_cost' class="textbox" value="<?php echo $total_maintain_cost;?>"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Cost/month<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
					<input type='text' name='cost_month' id='cost_month' class="textbox" value="<?php echo $cost_month;?>"/>
						</td>
			<td  width="150px"><label style="margin-left:0px;">Total fuel cost <em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
							<input type='text' name='total_fuel_cost' id='total_fuel_cost' class="textbox" value="<?php echo $total_fuel_cost;?>"/>
						</td>
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Cost/month <em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='cost_month_fuel' id='cost_month_fuel' class="textbox" value="<?php echo $cost_month_fuel;?>"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Attachment(car registration)<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php echo $car_reg_attach;?>
						<input type='file' name='car_reg_attach' id='car_reg_attach' class="textbox"/>
						</td>
					<td  width="150px"><label style="margin-left:0px;">Attachment(Insurance)<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php echo $insurance_attach;?>
						<input type='file' name='insurance_attach' id='insurance_attach' class="textbox"/>
						</td>
					</tr>
					
						<tr>
						
						<td  width="150px"><label style="margin-left:0px;">Attachment(Tax)<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php echo $tax_attach;?>
						<input type='file' name='tax_attach' id='tax_attach' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Attachment(Pollution certificate)<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php echo $pollution_attach;?>
						<input type='file' name='pollution_attach' id='pollution_attach' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Attachment(Fitness certificate)<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php echo $fitness_attach;?>
						<input type='file' name='fitness_attach' id='fitness_attach' class="textbox"/>
						</td>
					     </tr>
		<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="center" colspan="4">
	<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_GET['id'];?>"/>
			<input type='submit'  class="flatbutton" name='save' id="save" value='Save'/>
			<input type='button'  class="flatbutton" name='view' id="view" value='View' onclick="location.href='view_vehicle.php'"/>
		
        

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