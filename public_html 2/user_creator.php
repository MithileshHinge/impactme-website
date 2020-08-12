<?php
 include('admin_path.php'); 
include('include/access.php');
?>
<?php
if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 
if(strlen($row_user->tag_line)>0) { 
 $page_title = $row_user->tag_line." | ".PROJECT_TITLE;
 }
 else
 {
  $page_title = "My Profile | ".PROJECT_TITLE;
 }
 
 $become_impact = 0;
 
 $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                === 'on' ? "https" : "http") . "://" . 
          $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
  
  $profile_link = $link;
  
  
  
  if($_GET[type])
   $type = $_GET[type];
  else
   $type = "overview"; 
?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$page_title?></title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
<meta property="og:image" content="<?=IMAGEPATH.$row_user->image_path?>" />
<meta property="og:url" content="<?=$profile_link?>" />
<meta property="og:description" content="<?=$sql_web->meta_description?>" />

<!-- For Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?=$sql_web->meta_title?>" />
<meta name="twitter:description" content="<?=$sql_web->meta_description?>" />
<meta name="twitter:image" content="<?=IMAGEPATH.$row_user->image_path?>" />
<link rel="stylesheet" href="<?=BASEPATH?>/css/goal.css"/>

    <?php include('include/titlebar.php'); ?>
    <style>
	.comment-item .thumb-left1 img {
    max-height: 50px !important;
	}
	
	</style>
</head>

<body>
<div id="wrapper">
<?php include('include/header.php'); ?>

<div class="modal fade" id="modalProfilePic" tabindex="-1" role="dialog" aria-labelledby="modalProfilePicLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:400px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalProfilePicLabel">Change Profile Picture</h5>
      </div>
      <div id="modalProfilePicBody" class="modal-body">
      </div>
      <div class="modal-footer">
        <button id="cancel-profile-pic" type="button" class="btn btn-secondary">Cancel</button>
        <button id="save-profile-pic" type="button" class="btn btn-primary" style="color:#fff;">Save</button>
      </div>
    </div>
    <div class="loading-profile-spinner"></div>
  </div>
</div>


<div class="modal fade" id="modalCoverPic" tabindex="-1" role="dialog" aria-labelledby="modalCoverPicLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:600px; max-width:initial;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCoverPicLabel">Change Cover Picture</h5>
      </div>
      <div id="modalCoverPicBody" class="modal-body">
      </div>
      <div class="modal-footer">
        <button id="cancel-cover-pic" type="button" class="btn btn-secondary">Cancel</button>
        <button id="save-cover-pic" type="button" class="btn btn-primary" style="color:#fff;">Save</button>
      </div>
    </div>
    <div class="loading-cover-spinner"></div>
  </div>
</div>


 <div class="col-md-12 impact-usercover" style="border-bottom: 1px solid #ccc;position:relative;top:44px;  ">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <?php if($row_user->review_status==0) {?>
      <p class="review">If you're ready for us to review your page, send it our way. If not, we're ready when you are.</p>
      <a href="<?=BASEPATH?>/edit/" class="edit-page review-page-edit" style="background-color:  rgb(251, 200, 190);color: red;"><span style=""></span>Edit your page</a>
       <a href="<?=BASEPATH?>/edit/review/" class="edit-page review-page-submit" style="background-color: rgb(232, 91, 70);"><span style="margin: 0 4px 0 0;"></span> <?php if($row_user->review_submit_status==0) {?>Submit for review<?php }else { ?> Review Status <?php } ?></a>
       <?php } ?>
      <div class="clr"></div>
    </div>
    <div class="col-md-2"></div>
  </div>
  
  
  
  <div class="col-md-12 user-photo" style="background:url(<?=$cover_image?>) center center/auto 100% no-repeat; background-size:cover;" id="imgAreaCover2">
     <!-- <div class="user-overlay"></div>-->
      <div class="progressBar">
                            <div class="bar"></div>
                            <div class="percent">0%</div>
                          </div>             
        <form id="bgimageform" method="post" enctype="multipart/form-data" action="#">
            <div class="uploadFile timelineUploadBG" >
                <i class="material-icons " style="color:white;margin: 10px 0 0 0;text-shadow: 2px 2px #00000030;">photo_camera</i>
            <input type="file" name="cover_image" id="cover_image_upload_file" class=" custom-file-input" original-title="Change Cover Picture" accept="image/*" >
            </div>
        </form>
    <div class="creater-photo" style="background-image:url(<?=$user_image?>);  background-size:cover;" id="imgArea2">
    <div>&nbsp;</div>
     <div class="progressBar2">
                    <div class="bar2"></div>
                    <div class="percent2">0%</div>
                  </div>
    <!--<span style="color: white;" id="small-edit"><i class="fa fa-edit"></i></span>-->
    <div></div>
    <form id="small_bgimageform" method="post" enctype="multipart/form-data" action="#">
        <div>
            <div class="uploadFile  time-profile">
                <!--<i class="material-icons time-editcreate">edit</i>-->
                <i class="material-icons time-editcreate">photo_camera</i>
            <input type="file" name="profile_image" id="image_upload_file" class=" custom-file-input" original-title="Change Cover Picture"  accept="image/*">
            </div>
        </div>
</form>
    </div>
    <p class="gio"><?=$row_user->tag_line?> </p>
  </div>
  
  
   <!-- <div class=" col-md-12 project-tab-detail tabbable accordion creater-tabs">-->
  <div class=" col-md-12 project-tab-detail creater-tabs">
    <ul class="nav nav-tabs clearfix impactme-become" style="padding: 0 0 0px 0;border:0px solid  ">
      <!--<li <?php if($type=='overview'){?>class="active"<?php } ?>><a href="<?=$url_slug?>overview/">Post</a></li>-->
     <?php /*?> <li  <?php if($type=='post'){?>class="active"<?php } ?>><a href="<?=$url_slug?>post/">Post</a></li><?php */?>
      <!--<a href="#" class="become" onClick="alert('You cannot join your own tiers')">Become ImpactMe</a>-->
    </ul>
    
    <div class="tab-content">
     
        <div class="tab-pane  <?php if($type=='overview'){?>active<?php } ?> accordion-content">
          <div class="editor-content impact-editer-star">
            <div class="home-feature-category">
             <?php if($type=='overview'){?>
              <div class="container_12 clearfix">
              
              
                <div class="grid_3 left-lst-category">
               <?php 
			   
			   include('include/left_tier.php'); 
			    ?>
               </div>
              
                <div class="grid_6 marked-category">
                
                 <?php if(strlen($row_user->about_page) >0) {?>
                  <div class="box-marked-project project-short" style="    margin: 0 0 23px 0;">
                     <h5 class="tier">Overview</h5>
                    <span class="creater-post about" style="text-align: justify;"><p><?=html_entity_decode(stripslashes($row_user->about_page))?></p></span>
                  </div>
                  <?php } ?>
                    <?php $row_post_count = $db_query->fetch_object("select count(*) c from impact_post where user_id='".$row_user->user_id."'");
				  if($row_post_count->c==0) { ?>
                  <div class="box-marked-project project-short" style="    margin: 0 0 18px 0; text-align:center;"> 
                   <?php if(strlen($row_user->intro_video) >0) {?>
                   
                   <iframe width="100%" height="315" src="<?=$db_query->getYoutubeEmbedUrl($row_user->intro_video)?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                   
                   
             
                  <?php } else {?>
                  <img src="<?=BASEPATH?>/images/octopus3-impactme.png" class="impact-post">
                  <p class="follow">New to ImpactMe? Create your first post to tell your fans about it!</p>
                  <a href="<?=BASEPATH.'/edit/post/'?>" class="join_btn" style="position:relative; display:inline-block; margin:16px 0 18px 0;">Create new post</a>
                  <?php } ?>

                </div>
                 <?php } ?>
                
                 <?php 
			  $sql_post_check1  = $db_query->fetch_object("select count(*) c from impact_post where user_id='$row_user->user_id'");
			  if($sql_post_check1->c>0) {?>
              <div class="box-marked-project project-short" style="margin:15px 0 15px 0;">
                     
                    <span>
                      <h5 class="tier" style="display:inline-block; margin: 24px 0 24px 0; border-bottom: 0px; padding: 0 0 0 20px">Your Posts</h5>
                      <a href="<?=BASEPATH.'/edit/post/'?>" class="join_btn" style="float:right; margin:12px 12px 0 0">Create new post</a>
                    </span>
                  </div>
                      <?php include('include/user_post.php');?>
              
			      <?php } ?>
            
                </div>
                
                <div class="sidebar grid_3" style="float: right;">
                 <?php
				 
				 include('include/right_profile.php');
			   
			    include('include/right_goal.php'); 
				?>
                 </div>
               
                <div class="clear"></div>
              </div>
              
              <?php } ?>
            </div>
          
          </div>
       
        </div>
        
        
        
        <style>
		.project-date p {
    padding: 10px 0;
    margin: 0;
}
		
		</style>
      <div class="tab-pane <?php if($type=='post'){?>active<?php } ?>  accordion-content">
        <div class="tab-pane-inside ">
          <div class="home-feature-category">
          <?php if($type=='post'){?>
            <div class="container_12 clearfix">
             <div class="grid_3 left-lst-category">
            
               <?php include('include/right_profile.php');
			   include('include/left_filter.php');?>
               
               </div>
          <div class="grid_6 marked-category">
              
              <?php 
			  $sql_post_check1  = $db_query->fetch_object("select count(*) c from impact_post where user_id='$row_user->user_id'");
			  if($sql_post_check1->c>0) {?>
              
                          <?php include('include/user_post.php');?>
              
			      <?php }  else {?>
                <div class="box-marked-project project-short short">
                  <div class="editor-content"> <img  src="<?=BASEPATH?>/images/creater-impact.png" alt="" class="impact-post">
                    <p class="user-posted"> You haven't posted anything yet!.</p>
                  </div>
                  <div class="project-btn-action" style="    padding: 0 0 40px 0"> <a class="ask" href="<?=BASEPATH?>/edit/post/" style=" background-color:red;">Make your first post</a> </div>
                </div>
                <?php }?>
                
                
                
                
                               
                <div class="clear"></div>
              </div>
                <div class="sidebar grid_3" style="float: right;">
                   <?php  ?>
                    <?php include('include/left_tier.php');?>                 
                </div>
          
              
              
            </div>
         <?php } ?>
          </div>
        </div>
 
      </div>
    
  </div>
</div>
</div>
<?php include('include/footer.php');
include('include/footer_js.php');?>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

 <script type="application/javascript">
			 
			//  listComment(4);
			  
			  </script>
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
	
	
	
	 $('.load-more').click(function(){
	
        var row = Number($('#row').val());
        var allcount = Number($('#all').val());
        row = row + <?=PAGINATION?>;

        if(row <= allcount){
            $("#row").val(row);

            $.ajax({
                url: '<?=BASEPATH?>/include/user_post_LoadMore.php',
                type: 'post',
                data: {row:row},
                beforeSend:function(){
                    $(".load-more").text("Loading...");
                },
                success: function(response){

                    // Setting little delay while displaying new content
                    setTimeout(function() {
                        // appending posts after last post with class="post"
                        $(".post:last").after(response).show().fadeIn("slow");

                        var rowno = row + <?=PAGINATION?>;

                        // checking row value is greater than allcount or not
                        if(rowno > allcount){

                            // Change the text and background
							$('.hide_div').hide();
                            $('.load-more').text("No More Result");
                            $('.load-more').css("background","darkorchid");
                        }else{
                            $(".load-more").text("Load more");
                        }
                    }, 2000);


                }
            });
        }else{
            $('.load-more').text("Loading...");

            // Setting little delay while removing contents
            setTimeout(function() {

                // When row is greater than allcount then remove all class='post' element after 3 element
                $('.post:nth-child(<?=PAGINATION?>)').nextAll('.post').remove().fadeIn("slow");

                // Reset the value of row
                //$("#row").val(0);

                // Change the text and background
                $('.load-more').text("Load more");
                $('.load-more').css("background","#15a9ce");

            }, 2000);


        }

    });
});

</script>



<script src="<?=BASEPATH?>/image_upload_js/jquery.form.js"></script>
<link rel="stylesheet" href="https://www.impactme.in/croppie/croppie.css" />
<script src="https://www.impactme.in/croppie/croppie.js"></script>
<script>


/*<=========== Change Profile Pic ============>*/

var myProfileModal = $('#modalProfilePic');
var modalProfileBodyCroppie = $('#modalProfilePicBody');

var myProfileCroppie = modalProfileBodyCroppie.croppie({
    viewport: {
        width: 250,
        height: 250,
        type: 'circle'
    },
    boundary: {
        width: 300,
        height: 250
    }
});

$('#image_upload_file').on('change', function () {
  if($('#image_upload_file').val() != ''){
    myProfileModal.modal({backdrop: 'static', keyboard: false});
    myProfileModal.modal('show');
  }
});

myProfileModal.on('shown.bs.modal', function(){ 
    //myCroppie.croppie('bind', bindOpts);
    var reader = new FileReader();
    reader.onload = function (e) {
      myProfileCroppie.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
      
    }
    reader.readAsDataURL($('#image_upload_file').get(0).files[0]);
});

$('#save-profile-pic').on('click', function(event){
  $(".loading-profile-spinner").show(0, function(){
    myProfileCroppie.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function (response) {
      $.ajax({
        url: '<?=BASEPATH?>/uploadFileCroppie.php',
        type: "POST",
        data:  {"type": "creator_profile" ,"image" : response},
        beforeSend: function(){
        },
        success: function(data){
          obj = $.parseJSON(data);
          if (obj.status){
            //$("#imgArea>img").prop('src',obj.image_medium);
            $("#imgArea2").css("background-image", "url(" + obj.image_medium + ")"); 
            $(".photo-nav").css("background-image", "url(" + obj.image_medium + ")");
            $(".photo").css("background-image", "url(" + obj.image_medium + ")");
          }else {
            alert('Error');
          }
          myProfileModal.modal('hide');
          $(".loading-profile-spinner").hide();
          $("#image_upload_file").val('');
        }
      });
    });
  });
});

$('#cancel-profile-pic').on('click', function(event){
  $("#image_upload_file").val('');
  myProfileModal.modal('hide');
});



/*<========== Change Cover Pic =============>*/

var myCoverModal = $('#modalCoverPic');
var modalCoverBodyCroppie = $('#modalCoverPicBody');

var window_h = $(window).height();
var window_w = $(window).width();

if (window_w < 550){
  croppie_w = window_w-50;
  croppie_h = (window_w-50)/5;
}else {
  croppie_w = 500;
  croppie_h = 100;
}

var myCoverCroppie = modalCoverBodyCroppie.croppie({
    viewport: {
        width: croppie_w,
        height: croppie_w/5,
        type: 'square'
    },
    boundary: {
        width: croppie_w,
        height: croppie_w*4/5
    },
    enforceBoundary: true,
});

$('#cover_image_upload_file').on('change', function () {
  if($('#cover_image_upload_file').val() != ''){
    myCoverModal.modal({backdrop: 'static', keyboard: false});
    myCoverModal.modal('show');
  }
});

myCoverModal.on('shown.bs.modal', function(){ 
    //myCroppie.croppie('bind', bindOpts);
    var reader = new FileReader();
    reader.onload = function (e) {
      myCoverCroppie.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
      
    }
    reader.readAsDataURL($('#cover_image_upload_file').get(0).files[0]);
});

$('#save-cover-pic').on('click', function(event){
  $(".loading-cover-spinner").show(0, function(){
    myCoverCroppie.croppie('result', {
      type: 'canvas',
      size: {width: 1440}
    }).then(function (response) {
      $.ajax({
        url: '<?=BASEPATH?>/uploadFileCroppie.php',
        type: "POST",
        data:  {"type": "creator_cover" ,"image" : response},
        beforeSend: function(){
        },
        success: function(data){
          obj = $.parseJSON(data);
          if (obj.status){
            //$("#imgAreaCover>img").prop('src',obj.image_medium);
            $("#imgAreaCover2").css("background-image", "url(" + obj.image_medium + ")");
          }else {
            alert('Error');
          }
          myCoverModal.modal('hide');
          $(".loading-cover-spinner").hide();
          $("#cover_image_upload_file").val('');
        }
      });
    });
  });
});

$('#cancel-cover-pic').on('click', function(event){
  $("#cover_image_upload_file").val('');
  myCoverModal.modal('hide');
});



/*
$(document).on('change', '#cover_image', function () {
var progressBar = $('.progressBar'), bar = $('.progressBar .bar'), percent = $('.progressBar .percent');

$('#bgimageform').ajaxForm({
 url: '<?=BASEPATH?>/uploadFile.php',
    beforeSend: function() {
		progressBar.fadeIn();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function(html, statusText, xhr, $form) {		
		obj = $.parseJSON(html);	
		if(obj.status_cover){		
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
			//$("#imgArea>img").prop('src',obj.image_cover_image);
			$("#imgAreaCover2").css("background-image", "url(" + obj.image_cover_image + ")");			
		}else{
			alert('err');
		}
    },
	complete: function(xhr) {
		progressBar.fadeOut();			
	}	
}).submit();		

});


$(document).on('change', '#profile_image', function () {
var progressBar = $('.progressBar2'), bar = $('.progressBar2 .bar2'), percent = $('.progressBar2 .percent2');

$('#small_bgimageform').ajaxForm({
 url: '<?=BASEPATH?>/uploadFile.php',
    beforeSend: function() {
		progressBar.fadeIn();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function(html, statusText, xhr, $form) {		
		obj = $.parseJSON(html);	
		if(obj.status_profile){		
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
			//$("#imgAreaCover>img").prop('src',obj.image_cover);			
			$("#imgArea2").css("background-image", "url(" + obj.image_profile + ")");	
		}else{
			alert('err');
		}
    },
	complete: function(xhr) {
		progressBar.fadeOut();			
	}	
}).submit();		

});
*/

</script>






</div>
</body>
</html>
