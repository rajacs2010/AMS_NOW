<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

?>
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

$rowsperpage = 5; //MAXIMUM RESULTS PER PAGE
$offset = ($pagenum - 1) * $rowsperpage; //WHERE THE RESULTS START FROM

//FOR RESULTS OF THE PAGE
if($_GET["searchvalue"]){
$search=$_GET["searchvalue"];
    $q = mysql_query("select a.id,b.vehicle_regno,c.name from vehicle_status a,vehicle b,status c where a.vehicle_reg_id=b.id and a.status_id=c.id and b.vehicle_regno like '%$search%' ORDER BY id LIMIT $offset, $rowsperpage");
} else {
    $q = mysql_query("select a.id,b.vehicle_regno,c.name from vehicle_status a,vehicle b,status c where a.vehicle_reg_id=b.id and a.status_id=c.id ORDER BY a.id LIMIT $offset, $rowsperpage");
}

$page_nums = mysql_num_rows($q); //NUMBER OF RESULTS FOR THE PAGE
if ($page_nums!=0)
{
if($_GET["searchvalue"]){
$search=$_GET["searchvalue"];
	 $total_q = mysql_query("select a.id,b.vehicle_regno,c.name from vehicle_status a,vehicle b,status c where a.vehicle_reg_id=b.id and a.status_id=c.id and b.vehicle_regno like '%$search%' "); //FOR THE ALL RESULTS
} else {
    $total_q = mysql_query("select a.id,b.vehicle_regno,c.name from vehicle_status a,vehicle b,status c where a.vehicle_reg_id=b.id and a.status_id=c.id"); //FOR THE ALL RESULTS
}

$total_nums = mysql_num_rows($total_q); //TOTAL NUMBER OF RESULTS
$total_pages = ceil($total_nums/$rowsperpage); //NUMBER OF PAGES

//IF PAGE NUMBER IS WITHIN THE FIRST AND LAST PAGES
if($pagenum>=1&&$pagenum<=$total_pages)
{

echo '
<table class="owntable">
<thead>
<tr>
<th>Vehicle registration</th>
<th>status</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>
<tbody>';

    while($r=mysql_fetch_array($q))
    {
	
	
        $vehicle_regno = $r["vehicle_regno"];
		$status_name = $r["name"];
		$emp_id = $r["id"];
        echo '<tr><td>'. $vehicle_regno.'</td><td>'.$status_name.'</td><td><a href=vehicle_status.php?id='.$emp_id.'><img src="images/user_edit.png"/></a></td><td><a href=vehicle_status.php?delete_id='.$emp_id.'&delete=1><img src="images/delete.png" onclick="return show_confirm()"/></a></td></tr>';
	
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
    header("Location: ajax_vehicle_status.php"); //WILL REDIRECT TO THE FIRST PAGE OF RESULTS
}
}
else
{
$q_initial = mysql_query("select a.id,b.vehicle_regno,c.name from vehicle_status a,vehicle b,status c where a.vehicle_reg_id=b.id and a.status_id=c.id");
$page_nums_initial = mysql_num_rows($q_initial);
if ($page_nums_initial !=0)
{
echo '
<table class="owntable">
<thead>
<tr>
<th>Vehicle registration</th>
<th>status</th>
<th>Edit</th>
<th>Delete</th>

</tr>
</thead>
<tbody>
<tr>
<td align="right" colspan="4">
<font style="font-size: 16px;color:red;padding-right:230px;">No Records Found</font>
</td>


</tr>
</tbody>
</table>
';
}
}
?>
