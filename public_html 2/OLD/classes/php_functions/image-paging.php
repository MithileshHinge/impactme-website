<?
//total records
if(!isset($totalrecords) || empty($totalrecords)) $totalrecords = 0;

$PHP_SELF = $_SERVER['PHP_SELF'];

//initialize variables
$max_noof_sets = 0;
$cur_page_recs  = 0;
$page_link = "";
$page_limit = "";
if(!isset($var_extra) || empty($var_extra))
	$var_extra = "";

$start_limit = 0;

$set = (isset($_REQUEST['set']))? $_REQUEST['set'] : 1;
$page = (isset($_REQUEST['page']))? $_REQUEST['page'] : 1;

//set paging paramters
if(!isset($set)||$set==0||empty($set))	$set=1;
if(!isset($page)||$page==0||empty($page)) $page=1;
$max_noof_sets = ceil(($totalrecords / RECORD_PER_PAGE_EVENT )/RECORD_PER_PAGE_IMAGES);
$cur_page_recs = ($totalrecords - ((PAGE_LINKS_PER_PAGE*RECORD_PER_PAGE_IMAGES)*($set-1)));

$prevpage = $page-1;
$nextpage = $page+1;

if($prevpage / PAGE_LINKS_PER_PAGE == '0' || ($prevpage % PAGE_LINKS_PER_PAGE) == '0') {
	$prev_set = (int)($prevpage / PAGE_LINKS_PER_PAGE);
} else {
	$prev_set = (int)($prevpage / PAGE_LINKS_PER_PAGE) + 1;
}

if($prev_set==0)	$prev_set = 1;

if( ($nextpage / PAGE_LINKS_PER_PAGE) == '0' || ($nextpage % PAGE_LINKS_PER_PAGE) == '0') {
	$next_set = (int)($nextpage / PAGE_LINKS_PER_PAGE);
} else {
	$next_set = (int)($nextpage / PAGE_LINKS_PER_PAGE) + 1;
}

if($next_set==0)	$next_set = 1;

$start_page = 1;

//prev link
if($page <= 1){
	$page_link .= "";
} else {
	$page_link .= "<li class=\"previous-off boder-none\"><a href=\"".HTACCESS_URL."$var_extra/$prev_set/$prevpage/\"><img src=\"".HTACCESS_URL."images/prev.gif\" alt=\"Previous\" title=\"Previous\" />&nbsp;&nbsp;&nbsp;Previous</a></li>";
}

//middle links
$start_page = ((($set - 1) * PAGE_LINKS_PER_PAGE)+1);

for($i=1;$i<=PAGE_LINKS_PER_PAGE;$i++){
	
	$stylecolor = ($start_page != $page)? "" : "active";
	$page_link .= "<li ><a href=\"".HTACCESS_URL."$var_extra/$set/$start_page/\" class=\"".$stylecolor."\" >".$start_page."</a></li>";

	if(($i*RECORD_PER_PAGE_IMAGES)>=$cur_page_recs) break;
	$start_page++;
}

//next link
if($nextpage > $start_page && $set==$max_noof_sets){
	$page_link .= "";

} else {
 	if($nextpage != $page)
 		$page_link .= "<li class=\"next\"><a href=\"".HTACCESS_URL."$var_extra/$next_set/$nextpage/\">Next&nbsp;&nbsp;&nbsp;<img src=\"".HTACCESS_URL."images/next.gif\" alt=\"Next\" title=\"Next\" /></a></li>";
		
}

//the output variables
$start_limit = (($page-1)* RECORD_PER_PAGE_IMAGES);
$page_limit = " LIMIT $start_limit,". RECORD_PER_PAGE_IMAGES;

$num_limit = ($page-1) * RECORD_PER_PAGE_IMAGES;
$pagerec = $num_limit;
$lastrec = $pagerec + RECORD_PER_PAGE_IMAGES;
$pagerec = $pagerec + 1;
if($lastrec > $totalrecords)
	$lastrec = $totalrecords;
//this var should be used in the SQL
?>