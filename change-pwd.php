<?PHP
require_once("./include/membersite_config.php");

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
else
{
$header_file='./layout/user_header.php';
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

<div id="inside_content">
&nbsp;
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Change password</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
      <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
      <script src="scripts/pwdwidget.js" type="text/javascript"></script>       
</head>

<?php
if(isset($_POST['Submit']))
{
$fgmembersite->DBLogin();
$user_id=$_SESSION['user_id'];
$username=$_SESSION['username'];
$changepassword=$_POST['password'];
$currentpassword=$_POST['currentpassword'];
$query = "SELECT * FROM users where user_id='$user_id' and username='$username'"; 
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
	$plainpassword=$row['plainpassword'];
	
}
if($currentpassword==$plainpassword)
{
if(!mysql_query("UPDATE users SET password=md5('$changepassword'),plainpassword='$changepassword' WHERE user_id='$user_id' and username='$username'"))
{
die('Error: ' . mysql_error());
}
echo '<div class="success_message">Your password changed successfully</div>';


//echo"Your Password Updated successfully";
}
else
{
echo '<div class="error_message">Your password does not match</div>';

}
}
?>
<div id ='change_pass'>
<form id='confirm' action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' accept-charset='UTF-8'>

<table align="center" width="36%"CELLPADDING="3" CELLSPACING="0"  style=" border: 1px solid #00BFFF; border-top:0px;font-family: Arial;
    font-size: 12px;"      >
  <tr>
    <th style="background: url('images/th.png'); height: 29px;color:#ffffff;text-align: left;font-size: 14px;text-align:center">
Change password
    </th>
  </tr>
  <tr>
    <td align="center" style=" padding:30px 50px 30px 0px;">
<input type='hidden' name='submitted' id='submitted' value='1'/>
             <!-- The inner table below is a container for form -->
                <table style="font-family:Arial;" width="100%"  cellpadding="10px" class="htmlForm" cellspacing="0" border="0">

                    <tr>
                       <td  width="150px"><label style="margin-left:0px;">Current password<em style="font-style:normal;color:red;">*</em></label></td>
                        <td><input type='password' name='currentpassword' id='currentpassword' class="textbox" value="" maxlength="50" /></td>
                    </tr>
					<tr>
                       <td  width="150px"><label style="margin-left:0px;">New password<em style="font-style:normal;color:red;">*</em></label></td>
                        <td><input type='password' name='password' id='password' class="textbox" value="" maxlength="50" /></td>
                    </tr>
					


              <br/>
               

<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="right">
             <input type='submit'  class="flatbutton" name='Submit' value='Submit' class="button"/>
        

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