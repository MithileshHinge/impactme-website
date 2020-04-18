<?php include('admin_path.php'); 
//include('include/access.php');

$user_id = base64_decode($_SESSION['user_id']);
$row_user = $db_query->fetch_object("select count(*) c , i.* from impact_user i where i.user_id='".$user_id ."'");
 
if($_GET['u'])
{
 $uid = $_GET['u'];
 $row_user1 = $db_query->fetch_object("select count(*) c , i.* from impact_user i where  i.active_status=1 and i.status=1 and i.review_status=1 and  i.user_id='".$uid."'");
}
else
{ 
  $slug = $_GET['slug'];

 $row_user1 = $db_query->fetch_object("select count(*) c , i.* from impact_user i where  i.active_status=1 and i.status=1 and i.review_status=1 and  i.slug='$slug'");
 }
 
 if(strlen($row_user1->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user1->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 




if(strlen($row_user1->tag_line)>0) { 
 $page_title = $row_user1->tag_line." | ".PROJECT_TITLE;
 }
 else
 {
  $page_title = "My Profile | ".PROJECT_TITLE;
 }
 
 
 if($row_user->user_id==$row_user1->user_id)
 {
   $become_impact = 0;
   $become_impact_link = '#';
   
 }
 else
 {
   $become_impact = 1;
   $become_impact_link = BASEPATH.'/join/'.$row_user1->user_id.'/';
 }
?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$page_title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$sql_web->meta_description?>" /> 
    <meta name="title" content="<?=$sql_web->meta_title?>" />
    
    
    
    <meta name="keywords" content="<?=$sql_web->meta_keyword?>" />

<meta name="author" content="<?=PROJECT_TITLE?>" />
<meta name="copyright" content="<?=PROJECT_TITLE?>" />
<meta name="application-name" content="<?=PROJECT_TITLE?>" />

<!-- For Facebook -->
<meta property="og:title" content="<?=$sql_web->meta_title?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?=IMAGEPATH.$row_user1->image_path?>" />
<meta property="og:url" content="<?=$_SERVER['REQUEST_URI']?>" />
<meta property="og:description" content="<?=$sql_web->meta_description?>" />

<!-- For Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?=$sql_web->meta_title?>" />
<meta name="twitter:description" content="<?=$sql_web->meta_description?>" />
<meta name="twitter:image" content="<?=IMAGEPATH.$row_user1->image_path?>" />


    <?php include('include/titlebar.php'); ?>
    <style>
	.landing-footer {
    padding: 50px 0 50px 0;
    margin-top: 150px;
}
	
	</style>
</head>

<body>
<div id="wrapper" >

<?php include('include/header.php'); ?>


<?php

if(strlen($row_user1->image_path)>0)
 $user_image = IMAGEPATH.$row_user1->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 

?> 

  
  
  <div class="col-md-12 user-photo" style="background-image:url(<?=$cover_image?>); background-size:cover;">
                    
    <div class="creater-photo" style="background-image:url(<?=$user_image?>);  background-size:cover;">
    <div></div>
    </div>
    <p class="gio" style="bottom:34px;"><span>Become Impact Of</span><br />
<br />
<span>
<?=$row_user1->full_name?> </span></p>
  </div>
   
   

    <section style="background-color: white;">
        <div class="container become-conter">
            <div class="col-md-12 ">
            <?php $sql_tier = $db_query->runQuery("select * from impact_tier where status=1 and user_id='$row_user1->user_id'");
			foreach($sql_tier as $row_tier) {
			$tier_link = BASEPATH.'/join/'.$row_user1->user_id.'/checkout?tid='.$row_tier['tier_id'];
			?>
                <div class="col-md-4 become-impact_new">
                    <h3 class="livello-1-become"><?=$row_tier['tier_name']?></h3>
                    <h2 class="doller-become"><?=CURRENCY.' '.$row_tier['tier_price']?></h2>
                    <p class="doller-permonth">PER MONTH</p>
                    <!--<p class="sapevo">"Lo sapevo che eri il mio campione!"</p>-->
                    <p class="faccio-become" style="max-height: 350px;"><?=stripslashes($row_tier['description'])?></p>
                   <!-- <ul>
                        <li class="support-become"><span style="font-weight: 900;">Ringraziamento pubblico</span>in ogni video come supporter.</li>
                    </ul>-->
                    <a href="<?=$tier_link?>" class="select-become" style="top:25px;" >Select</a>
                </div>
                <?php } ?>

                
            </div>
            <?php 
			$tier_link_custom = BASEPATH.'/join/'.$row_user1->user_id.'/checkout?tid=0';
			?>
            <div class="col-md-12">
                <div class="col-md-4"></div>
                <div class="col-md-4 custom-become">
                    <p class="want-become">DON'T WANT TO SELECT A TIER?</p>
                    <a href="<?=$tier_link_custom?>" class="pledge-become" style="color: red;">Make a custom pledge</a>
                </div>
                <div class="col-md-4"></div>
            </div>


        </div>
    </section>
  

</div>
<?php include('include/footer.php');
include('include/footer_js.php');?>

<script>
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 100;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >";
    var lesstext = "Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});

</script>
</div>
</body>
</html>
