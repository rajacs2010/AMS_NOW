<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");

$emp_code= $_GET['selvalue'];
$result_emp_id=mysql_query("select first_name,emp_email,photo from pim_emp_info where emp_code=$emp_code order by emp_id");
while($row = mysql_fetch_array($result_emp_id))
  {
  $email=$row['emp_email'];
  $first_name=$row['first_name'];
  $photo=$row['photo'];
  
  }


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
             <!-- The inner table below is a container for form -->
                <table style="font-family:Arial;" width="100%"  cellpadding="10px" class="htmlForm" cellspacing="0" border="0">

				 <tr>
                       <td  width="150px"><label style="margin-left:60px;">Name<em style="font-style:normal;color:red;">*</em></label></td>
                        <td> 						<?php
$fgmembersite->DBLogin();		
$result_emp_id=mysql_query("select emp_code,first_name from pim_emp_info  order by emp_id",$bd);
echo '<select name="namee" id="name" class="selectbox">';
echo '<option value="0">Please select a user name</option>';
while($row=mysql_fetch_array($result_emp_id))
{
if($row['first_name'] == $first_name){
          $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
     } else {
          $isSelected = ''; // else we remove any tag
     }
     echo "<option value='".$row['emp_code']."'".$isSelected.">".$row['first_name']."</option>";
}
echo '</select>';
?><br/>
    <span id='register_name_errorloc' class='error'></span></td>
                    </tr>
					<div id="display_content">
					 <tr>
                       <td  width="150px"><label style="margin-left:60px;">Email<em style="font-style:normal;color:red;">*</em></label></td>
                        <td> <input type='text' name='email' id='email' value='<?php echo $email ?>' maxlength="50" /><br/>
    <span id='register_email_errorloc' class='error'></span></td>
                    </tr>
				
                    <tr>
                       <td  width="150px"><label style="margin-left:60px;">Username<em style="font-style:normal;color:red;">*</em></label></td>
                        <td> 
						<div id ="display_emp_code">
						<input type='text' name='username' id='username' value='<?php echo $first_name; ?>' readonly="true" maxlength="50" />					
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
					<?php 
					if ($photo!="")
					{
					?>
					<tr >
            <td  width="150px"><label style="margin-left:60px;">Picture</label></td>
            <td align="right">
	
                <img src="images/<?php echo $photo?>" alt="<?php echo $photo?>"/>
          


            </td>
        </tr>
<?php
}
?>
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
                </table>
<input type="hidden" name="firstname" id="firstname" value="<?php echo $first_name ?>"/>
           