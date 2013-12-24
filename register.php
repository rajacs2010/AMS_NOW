<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="shortcut icon" href="../images/favicon.ico" />
  <title>AMS</title>
  <meta name="description" content=""/>
  <meta name="keywords" content=""/>

  <meta http-equiv="Content-Type"
 content="text/html; charset=iso-8859-1"/>
  <link rel="stylesheet" href="style/superfish.css" media="screen">
    <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
	<script src="scripts/jquery.js"></script>
    <script src="scripts/pwdwidget.js" type="text/javascript"></script>  
      <script type = "text/javascript" >

function disableBackButton()
{
window.history.forward();
}
setTimeout("disableBackButton()", 0);

</script> 
  <style type="" >
    body a {color:#ffffff;}
.bottom a{color:#ffffff; text-decoration: none;}
.htmlForm td{
    font-family: Arial;
    font-size:14px;
    color:#3b3b3b;

}
.htmlForm input[type="text"],input[type="password"],select{
    border:1px #00BFFF solid;
    font-family:Arial;
    font-size:14px;
    padding:2px;
     background-color:#F2F5F7;
	 width:200px;
}




</style>
   <script>
function register()
{
var firstname=document.getElementById("name").value;
	if(firstname==0)
	{
		alert("Please Select  the name");
		document.getElementById("name").focus();
		return false;
	}
	var email=document.getElementById("email");
	if(email.value=="")
	{
	alert("Please enter the email");
	document.getElementById("email").focus();
	return false;
	}
	else
		{
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			var email_to_lower = document.getElementById("email").value;
			var address=email_to_lower.toLowerCase();
			   if(reg.test(address) == false) 
			{
			      alert('Invalid Email Address');
				document.getElementById("email").focus();
			      return false;
	   					
			}
		 	 
		}
		var username=document.getElementById("username").value;
	if(username=="")
	{
		alert("Please enter the username");
		document.getElementById("username").focus();
		return false;
	}
		var password=document.getElementById("password").value;
	if(password=="")
	{
		alert("Please enter the password");
		document.getElementById("password").focus();
		return false;
	}
	
}
</script>
</head>



 <body>
   
<div class="page">
<div class="top">
<div class="header">
<div class="header-top">
<table width="100%"><tbody><tr><td width="10%"><a href="#"><img alt="fmcl" src="images/logo_fmcl.png" border="0" width="70" height="70"></a></td><td width="78%" align="center"> <em style="color:#0092b3;font-style: normal; font-weight: bold;font-size: 30px;"> Admin Maintenance And Support System</em>
</td><td width="10%" align="right"><a href="#"><img alt="fmcl" src="images/kcs.png" border="0" width="70" height="70"/></a></td></tr></tbody></table>
</div>

<!--<div class="header-img">-->

</div>
</div>
</div>
</div>
 <div class="bodycontent">
 <?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->RegisterUser())
   {
        $fgmembersite->RedirectToURL("register.php?nsuccess=true");
   }
}

?>
      <br/>
      <br/>
      <br/>
      <br/>
  
  
  <!-- Form Code Start -->
  
  <?php
$fgmembersite->DBLogin();
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
?>


<script type="text/javascript" language="javascript">
   $(document).ready(function() {
	$("#name").change(function(event){
	var selvalue=document.getElementById("name").value;
	if (selvalue != 0)
	{
          $('#display_content').load('getuserdata.php?selvalue='+selvalue);
	}
	else
	{
	document.getElementById("email").value = "";
	document.getElementById("username").value = "";
	
	}
      });		
   });
   </script>
   <?php
	if(isset($_GET['nsuccess']))
	{
		 if($_GET['nsuccess'] == 'true')
		{
        	 echo "<div style='float:right;width:580px;color:green;font-size:18px;'>User created successfully</div>";
    		}
		else
		{
         	echo '<div class="error">SORRY, PROBLEM SUBMITTING YOUR DATA</div>';
		}
	}
?>
<div id='fg_membersite'>
<div style="float:right;width:996px;">
<form id='register' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>

<!---login--->

<table align="center" width="30%"CELLPADDING="3" CELLSPACING="0"  style=" border: 1px solid #00BFFF; border-top:0px;font-family: Arial;
    font-size: 12px;"      >
  <tr>
    <th style="background: url('images/th.png'); height: 29px;color:#ffffff;text-align: left;font-size: 14px;text-align:center">
Register
    </th>
  </tr>
  <tr>
    <td align="center" style=" padding:30px 50px 30px 0px;">

<form id='register' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div> 
  <div id="display_content">
             <!-- The inner table below is a container for form -->
                <table style="font-family:Arial;" width="100%"  cellpadding="10px" class="htmlForm" cellspacing="0" border="0">

				 <tr>
                       <td  width="150px"><label style="margin-left:60px;">Name<em style="font-style:normal;color:red;">*</em></label></td>
                        <td> 						<?php
					
$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
echo '<select name="namee" id="name" class="selectbox">';
echo '<option value="0">Please select a user name</option>';
while($row=mysql_fetch_array($result_emp_id))
{
echo '<option value="'.$row['emp_code'].'">'.$row['first_name'].'</option>';

}
echo '</select>';
?><br/>
    <span id='register_name_errorloc' class='error'></span></td>
                    </tr>
					<div id="display_content">
					 <tr>
                       <td  width="150px"><label style="margin-left:60px;">Email<em style="font-style:normal;color:red;">*</em></label></td>
                        <td> <input type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
    <span id='register_email_errorloc' class='error'></span></td>
                    </tr>
				
                    <tr>
                       <td  width="150px"><label style="margin-left:60px;">Username<em style="font-style:normal;color:red;">*</em></label></td>
                        <td> 
						<div id ="display_emp_code">
						<input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' readonly="true" maxlength="50" />					
</div>
<br/>
    <span id='register_username_errorloc' class='error'></span></td>
                    </tr>
</div>
 
                    <tr>
                        <td  width="150px"><label style="margin-left:60px;">Password<em style="font-style:normal;color:red;">*</em></label></td>
                        <td  ><input type='password' id='password' name='password' class="textbox" value="<?php echo htmlentities($_POST['password']);?>" ><br/>
						 <span id='register_password_errorloc' class='error'></span>
</td>
                    </tr>

<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="right">
			<input type="hidden" name="usertype" value="2" id="usertype"/>
                <input class="flatbutton" name="commit"  size="20" type="submit" value="Submit" onclick="return register();" />
              <style>

              </style>
<script type='text/javascript'>
// <![CDATA[

   var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
    
    var frmvalidator  = new Validator("register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Please provide your name");

    frmvalidator.addValidation("email","req","Please provide your email address");

    frmvalidator.addValidation("email","email","Please provide a valid email address");

    frmvalidator.addValidation("username","req","Please provide a username");
    
    frmvalidator.addValidation("password","req","Please provide a password");

// ]]>
</script>

            </td>
        </tr>
		<tr >
            <td  width="150px">&nbsp;</td>
            <td align="right">
                <!--<input class="flatbutton" name="signup" onclick="return validate_form()" size="20" type="button" value="Signup" />-->
				<a style="color:blue;"href="index.php">Login</a>
          


            </td>
        </tr>
		<tr >
            <td  width="150px">&nbsp;</td>
            <td align="right">
               
          
&nbsp;

            </td>
        </tr>
                </table>
				</div>
                </form>            </td>

        </tr>




    </table>
	
<!----login end--->


</form>

<!--
Form Code End (see html-form-guide.com for more info.)
-->
  
  </div>
  </div>

 <br></br><br></br>
  <br></br><br></br> <br></br><br></br>


</div>
 
<div class="footer"><div class="headedsfdsfr-top">
<table width="98%"><tbody><tr><td width="20%"><a style="color:#0092b3;font-style: normal; font-weight: bold;font-size: 18px;text-decoration:none;" href="#">Powered by kcs</a></td><td width="78%" align="center"> <em style="color:#0092b3;font-style: normal; font-weight: bold;font-size: 18px;">&#169; Copyright 2013 KCS. All rights reserved.</em>
</td><td width="10%"></td></tr></tbody></table>
</div></div>
 
</body>
</html>

