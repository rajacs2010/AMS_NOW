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
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
	if ($id ==1)
	{
	$header_file='./layout/admin_header_ams.php';
	}
	if($id ==2)
	{
	$header_file='./layout/admin_header_bms.php';
	}
	if($id ==3)
	{
	$header_file='./layout/admin_header_fms.php';
	}
}

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

<div id="mainarea">
<div  style="padding-top:20%;" class="mydiv">
<h3 align="center" class="sucmsg">
Welcome <?php echo $_SESSION['username'];?>
</h3>
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