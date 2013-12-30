<?PHP
require_once("./include/membersite_config.php");
require_once ("./include/ajax_pagination.php");
EXTRACT($_REQUEST);
$fgmembersite->DBLogin();
if(!$fgmembersite->CheckLogin()) {
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
require_once("./include/membersite_config.php");
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}
if($_REQUEST['searchname']!='') {
	$var = @$_REQUEST['searchname'] ;
	$trimmed = trim($var);	
	$qry="select a.id,a.assignment_no,a.assignment_date,b.vehicle_regno,c.name,d.driver_code from vehicle_assignment a,vehicle b,assignment_type c,driver d where a.vehicle_registration_id=b.id and a.driver_code_id=d.id and a.assignment_type_id=c.id and b.vehicle_regno like  '%".$trimmed."%'";
} else { 
	$qry="select a.id,a.assignment_no,a.assignment_date,b.vehicle_regno,c.name,d.driver_code from vehicle_assignment a,vehicle b,assignment_type c,driver d where a.vehicle_registration_id=b.id and a.driver_code_id=d.id and a.assignment_type_id=c.id "; 
}
$results=mysql_query($qry);
$num_rows= mysql_num_rows($results);			
$params			=	$searchname."&".$sortorder."&".$ordercol;

/********************************pagination start***********************************/
$strPage = $_REQUEST[page];
//$params = $_REQUEST[params];

//if($_REQUEST[mode]=="Listing"){
//$Num_Rows = mysql_num_rows ($res_search);

########### pagins

$Per_Page = 5;   // Records Per Page

$Page = $strPage;
if(!$strPage)
{
	$Page=1;
}

$Prev_Page = $Page-1;
$Next_Page = $Page+1;

$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($num_rows<=$Per_Page)
{
$Num_Pages =1;
}
else if(($num_rows % $Per_Page)==0)
{
$Num_Pages =($num_rows/$Per_Page) ;
}
else
{
$Num_Pages =($num_rows/$Per_Page)+1;
$Num_Pages = (int)$Num_Pages;
}
if($sortorder == "")
{
	$orderby	=	"ORDER BY id DESC";
} else {
	$orderby	=	"ORDER BY $ordercol $sortorder";
}
$qry.=" $orderby LIMIT $Page_Start , $Per_Page";  //need to uncomment
//exit;
$results_dsr = mysql_query($qry) or die(mysql_error());
/********************************pagination***********************************/
?>
<div class="con2">
<table width="100%">
<thead>
<tr>
	
	<?php //echo $sortorderby;
	if($sortorder == 'ASC') {
		$sortorderby = 'DESC';
	} elseif($sortorder == 'DESC') {
		$sortorderby = 'ASC';
	} else {
		$sortorderby = 'ASC';
	}
	$paramsval	=	$searchname."&".$sortorderby."&assignment_no"; ?>
				<th nowrap="nowrap" class="rounded" onClick="colviewajax('<?php echo $Page; ?>','<?php echo $paramsval; ?>');">Assignment Number<img src="images/sort.png" width="13" height="13" /></th>
				<th nowrap="nowrap" >Registration Number</th>
				<th nowrap="nowrap" >Driver Code</th>
				<th nowrap="nowrap" >Assignment Date</th>
				<th nowrap="nowrap" >Assignment Type</th>
				<th nowrap="nowrap" >Edit</th>
				<th nowrap="nowrap" >Delete</th>
</tr>
</thead>
<tbody>
<?php
if(!empty($num_rows)){
	$slno	=	($Page-1)*$Per_Page + 1;
$c=0;$cc=1;
while($fetch = mysql_fetch_array($results_dsr)) {
if($c % 2 == 0){ $cls =""; } else{ $cls =" class='odd'"; }
$id= $fetch['id'];
?>
<tr>				
				<td><?php echo $fetch['assignment_no'];?></td>
				<td><?php echo $fetch['vehicle_regno']; ?></td>
				<td><?php echo $fetch['driver_code'];?></td>
				<td><?php echo $fetch['assignment_date'];?></td>
				<td><?php echo $fetch['name'];?></td>
				<td >
				<a href="edit_vehicle_assignment.php?id=<?php echo $fetch['id'];?>"><img src="images/user_edit.png" alt="" title="" width="11" height="11"/></a>
				</td>
				<td>
				<a href="view_vehicle_assignment.php?delete_id=<?php echo $fetch['id'];?>&delete=1"><img src="images/trash.png" alt="" title="" width="11" height="11" onclick="return show_confirm('<?php echo $fetch['assignment_no']; ?>');"/></a>
				</td>
</tr>
<?php $c++; $cc++; $slno++; }		 
}else{  echo "<tr><td align='center' colspan='7'><b>No records found</b></td></tr>";}  ?>
</tbody>
</table>
 </div>   
 <div class="paginationfile" align="center">
 <table>
 <tr>
 <th class="pagination" scope="col">          
<?php 
if(!empty($num_rows)){
	rendering_pagination_common($Num_Pages,$Page,$Prev_Page,$Next_Page,$params,'colviewajax');   //need to uncomment
} else { 
	echo "&nbsp;"; 
} ?>      
</th>
</tr>
</table>
</div>