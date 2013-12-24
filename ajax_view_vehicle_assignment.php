<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

?>
<link media="screen" rel="stylesheet" href="style/fixed_table_header/960.css">
        <link media="screen" rel="stylesheet" href="style/fixed_table_header/defaultTheme.css">
        <link media="screen" rel="stylesheet" href="style/fixed_table_header/myTheme.css">
        <script src="scripts/fixed_table_header/jquery.min.js"></script>
        <script src="scripts/fixed_table_header/jquery.fixedheadertable.min.js"></script>
        <script src="scripts/fixed_table_header/demo.js"></script>
		<script>
		function show_confirm()
{
var r=confirm("Are you sure want to delete");
if (r==true)
  {
  return true;
  }
else
  {
  return false;
  }
}
</script>
<?php
	$fgmembersite->DBLogin();
//PAGE NUMBER, RESULTS PER PAGE, AND OFFSET OF THE RESULTS
if($_GET["page"]){
    $pagenum = $_GET["page"];
} else {
    $pagenum = 1;
}

$rowsperpage = 7; //MAXIMUM RESULTS PER PAGE
$offset = ($pagenum - 1) * $rowsperpage; //WHERE THE RESULTS START FROM

//FOR RESULTS OF THE PAGE
if($_GET["searchvalue"]){
$search=$_GET["searchvalue"];
    $q = mysql_query("select a.id,a.assignment_no,a.assignment_date,b.vehicle_regno,c.name,d.driver_code from vehicle_assignment a,vehicle b,assignment_type c,driver d where a.vehicle_registration_id=b.id and a.driver_code_id=d.id and a.assignment_type_id=c.id and b.vehicle_regno like '%$search%' ORDER BY a.id LIMIT $offset, $rowsperpage");
} else {
    $q = mysql_query("select a.id,a.assignment_no,a.assignment_date,b.vehicle_regno,c.name,d.driver_code from vehicle_assignment a,vehicle b,assignment_type c,driver d where a.vehicle_registration_id=b.id and a.driver_code_id=d.id and a.assignment_type_id=c.id  ORDER BY a.id LIMIT $offset, $rowsperpage");
}

$page_nums = mysql_num_rows($q); //NUMBER OF RESULTS FOR THE PAGE
if ($page_nums!=0)
{
if($_GET["searchvalue"]){
$search=$_GET["searchvalue"];
	 $total_q = mysql_query("select a.id,a.assignment_no,a.assignment_date,b.vehicle_regno,c.name,d.driver_code from vehicle_assignment a,vehicle b,assignment_type c,driver d where a.vehicle_registration_id=b.id and a.driver_code_id=d.id and a.assignment_type_id=c.id and b.building_name like '%$search%' "); //FOR THE ALL RESULTS
} else {
    $total_q = mysql_query("select a.id,a.assignment_no,a.assignment_date,b.vehicle_regno,c.name,d.driver_code from vehicle_assignment a,vehicle b,assignment_type c,driver d where a.vehicle_registration_id=b.id and a.driver_code_id=d.id and a.assignment_type_id=c.id"); //FOR THE ALL RESULTS
}

$total_nums = mysql_num_rows($total_q); //TOTAL NUMBER OF RESULTS
$total_pages = ceil($total_nums/$rowsperpage); //NUMBER OF PAGES
//<table class="myTable01">
//IF PAGE NUMBER IS WITHIN THE FIRST AND LAST PAGES
if($pagenum>=1&&$pagenum<=$total_pages)
{

echo '
<table class="owntable">
<thead>
<tr>
<th>Assignment number</th>
<th>Vehicle registration number</th>
<th>Driver code</th>
<th>Assignment date</th>
<th>Assignment type</th>
<th>Edit</th>
<th>Delete</th>

</tr>
</thead>
<tbody>';

    while($r=mysql_fetch_array($q))
    {
		$assignment_no=$r["assignment_no"];
		$vehicle_regno=$r["vehicle_regno"];
		$driver_code=$r["driver_code"];
		$assignment_no=$r["assignment_no"];
		$assignment_date=$r["assignment_date"];
		$name=$r["name"];
		$emp_id = $r["id"];
        echo '<tr><td>'.$assignment_no.'</td><td>'.$vehicle_regno.'</td><td>'.$driver_code.'</td><td>'.$assignment_date.'</td><td>'.$name.'</td><td><a href=edit_vehicle_assignment.php?id='.$emp_id.'><img src="images/user_edit.png"/></a></td>
		<td><a href=view_vehicle_assignment.php?delete_id='.$emp_id.'&delete=1><img src="images/delete.png" onclick="return show_confirm()"/></a></td></tr>';
	
    }
    echo '</tbody></table>';
    echo '<br>';
    
    //IF ANY RESULTS
    if($total_nums)
    {
        $range = 4; //NUMBER OF PAGES TO BE SHOWN BEFORE AND AFTER THE CURRENT PAGE NUMBER
        
        //FIRST, PREVIOUS, NEXT, AND LAST LINKS
        if($pagenum>1)
        {
            $page = $pagenum - 1;
            $first = '<a class="page" id="1" >First</a> ';
            $prev = '<a class="page" id="'.$page.'"><<</a> ';
        }
        if($pagenum<$total_pages)
        {
            $page = $pagenum + 1;
            $next = '<a class="page" id="'.$page.'">>></a> ';
            $last = '<a class="page" id="'.$total_pages.'">Last</a> ';
        }
        
        //PAGINATION
        for($page=($pagenum-$range); $page<=($pagenum+$range); $page++)
        {
            if($page>=1&&$page<=$total_pages)
            {
                if($page==$pagenum)
                {
                    $nav .= '<span class="pagenum">'.$page.'</span> ';
                }
                else
                {
                    $nav .= '<a class="page" id="'.$page.'">'.$page.'</a> ';
                }
            }
        }
    }
    
    //DISPAYS IN HTML
	if ($total_nums>$rowsperpage)
	{
	 echo $first . $prev . $nav . $next . $last;
	}
	
} 
else {
    //OTHERWISE...
    header("Location: ajax_view_vehicle_assignment.php"); //WILL REDIRECT TO THE FIRST PAGE OF RESULTS
}
}
else
{
$q_initial = mysql_query("SELECT * FROM vehicle_assignment");
$page_nums_initial = mysql_num_rows($q_initial);
if ($page_nums_initial !=0)
{
echo '
<table class="owntable">
<thead>
<tr>
<th>Assignment number</th>
<th>Vehicle registration number</th>
<th>Driver code</th>
<th>Assignment date</th>
<th>Assignment type</th>
<th>Edit</th>
<th>Delete</th>

</tr>
</thead>
<tbody>
<tr>
<td align="right" colspan="7">
<font style="font-size: 16px;color:red;padding-right:230px;">No Records Found</font>
</td>


</tr>
</tbody>
</table>
';
}
}
?>
