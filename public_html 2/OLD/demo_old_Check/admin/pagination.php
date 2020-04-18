<style>

div.pagination {
	padding:3px;
	margin:10px 2px;
	text-align:right;
}
div.pagination a {
	padding: 2px 5px 2px 5px;
	margin-right: 2px;
	border: 1px solid #C24F00;
	text-decoration: none;
	color: #C24F00;
}

div.pagination a:hover, div.pagination a:active {
	border:1px solid #FFFFFF;
	color: #FFFFFF;
	background-color: #B43803;
}

div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin-right: 2px;
	border: 1px solid #008000;
	font-weight: bold;
	background-color: #008000;
	color: #FFF;
}

div.pagination span.disabled {
	padding: 2px 5px 2px 5px;
	margin-right: 2px;
	border: 1px solid #f3f3f3;
	color: #FFFFFF;
}
</style>

<?php
    require_once("configure.php");
function Pages($articles,$limit,$path,$id,$condition)
{
	$query = "SELECT COUNT(*) as num FROM $articles $condition";
	$sql = "SELECT $id FROM $articles $condition LIMIT $start, $limit";
	
	
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	$adjacents = "2";
	$page = $_GET['page'];
	if($page)
	$start = ($page - 1) * $limit;
	else
	$start = 0;

//$sql = "SELECT $id FROM $articles LIMIT $start, $limit";
$result = mysql_query($sql);

	if ($page == 0) $page = 1;
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_pages/$limit);
	$lpm1 = $lastpage - 1;

	$pagination = "";
if($lastpage > 1)
{   
	$pagination .= "<div class='pagination'>";
if ($page > 1)
	$pagination.= "<a href='".$path."page=$prev' class='c1 '>&laquo; previous</a>";
else
	$pagination.= "<span class='disabled'>&laquo; previous</span>";   

if ($lastpage < 7 + ($adjacents * 2))
{   
for ($counter = 1; $counter <= $lastpage; $counter++)
{
if ($counter == $page)
	$pagination.= "<span class='current'>$counter</span>";
else
	$pagination.= "<a href='".$path."page=$counter' class='c1 '>$counter</a>";                   
}
}
elseif($lastpage > 5 + ($adjacents * 2))
{
if($page < 1 + ($adjacents * 2))       
{
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($counter == $page)
	$pagination.= "<span class='current'>$counter</span>";
else
	$pagination.= "<a href='".$path."page=$counter' class='c1 '>$counter</a>";                   
}
	$pagination.= "...";
	$pagination.= "<a href='".$path."page=$lpm1' class='c1 '>$lpm1</a>";
	$pagination.= "<a href='".$path."page=$lastpage' class='c1 '>$lastpage</a>";       
}
elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
{
	$pagination.= "<a href='".$path."page=1' class='c1 '>1</a>";
	$pagination.= "<a href='".$path."page=2' class='c1 '>2</a>";
	$pagination.= "...";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
{
if ($counter == $page)
	$pagination.= "<span class='current'>$counter</span>";
else
	$pagination.= "<a href='".$path."page=$counter' class='c1 '>$counter</a>";                   
}
	$pagination.= "..";
	$pagination.= "<a href='".$path."page=$lpm1' class='c1 '>$lpm1</a>";
	$pagination.= "<a href='".$path."page=$lastpage' class='c1 '>$lastpage</a>";       
}
else
{
	$pagination.= "<a href='".$path."page=1' class='c1 '>1</a>";
	$pagination.= "<a href='".$path."page=2' class='c1 '>2</a>";
	$pagination.= "..";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
{
if ($counter == $page)
	$pagination.= "<span class='current' class='c1 '>$counter</span>";
else
	$pagination.= "<a href='".$path."page=$counter' class='c1 '>$counter</a>";                   
}
}
}

if ($page < $counter - 1)
	$pagination.= "<a href='".$path."page=$next' class='c1 '>next  &raquo;</a>";
else
	$pagination.= "<span class='disabled'>next  &raquo;</span>";
	$pagination.= "</div>\n";       
}


return $pagination;
}


?>