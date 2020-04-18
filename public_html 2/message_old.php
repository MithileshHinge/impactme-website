<?php include('admin_path.php'); 
include('include/access.php');
include('class/class.message.php');
$message = new Message();
?>
<?php

 
$title = "Message | ".PROJECT_TITLE; 

 $sql_check_impact = $db_query->creator_check($row_user->email_id);
 $email_id = $row_user->email_id;

 $row_creator = $message->creator($email_id,"impact_name");
 $row_impact = $message->impact($email_id,"impact_name");
 
 if($_GET['get_type']=="load")
 {
  
   echo $message->load($_GET['email_id']);
   exit();
 }
 
?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$title?></title>
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
<meta property="og:url" content="<?=$_SERVER['REQUEST_URI']?>" />
<meta property="og:description" content="<?=$sql_web->meta_description?>" />

<!-- For Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?=$sql_web->meta_title?>" />
<meta name="twitter:description" content="<?=$sql_web->meta_description?>" />
<meta name="twitter:image" content="<?=IMAGEPATH.$row_user->image_path?>" />


    <?php include('include/titlebar.php'); ?>
    <style>
	.home-feature-category {
    padding-top: 101px;
}


    
     /*=====message csss======*/
.message-image{
	width: 50px;
    height: 50px;
    background-color: red;
    float: left;
    /* margin: 38px 0 2px 0; */
    position: relative;
    bottom: 2px;
    z-index: 2;
    border-radius: 50%;
}
#message-name{
	padding: 9px 66px;
	margin: -7px 0 0 -6px;
}
.message-rock{
	font-size: 18px;
    font-weight: 700;
    color: black;
}
.message-head{
	color: black;
    /* padding: 0 0 0 0; */
    margin: 56px 0 0 0;
}
#message-box{
	position: relative;
    top: 38px;
    padding: 0 0 85px 0;
}
#message-tabs>li.active>a {
    color: blue;
    background-color: #fff;
    /* border: 1px solid #d4d4d4; */
    border-bottom-color: blue;
}
.tabs {
  width: 853px;
    margin: -74px 0 0 -119px;
}
#tab-button {
  display: table;
  table-layout: fixed;
  width: 100%;
  margin: 0;
  padding: 0;
  list-style: none;
  border-right: 1px solid #ddd;
}
#tab-button li {
  display: table-cell;
  width: 20%;
}
#tab-button li a {
  display: block;
    padding: .5em;
    background: white;
    /* border: 1px solid #ddd; */
    text-align: center;
    color: #000;
    text-decoration: none;
    border-bottom: 1px solid #ddd;
    border-top: 1px solid #ddd;
}
#tab-button li:not(:first-child) a {
  border-left: none;
}
#tab-button li a:hover,
#tab-button .is-active a {
  /*border-bottom-color: transparent;*/
  background: #fff;
}
.tab-contents {
  padding: .5em 2em 1em;
  border: 1px solid #ddd;
}



.tab-button-outer {
  display: none;
}
.tab-contents {
  margin-top: 20px;
}
@media screen and (min-width: 768px) {
  .tab-button-outer {
    position: relative;
    z-index: 2;
    display: block;
  }
  .tab-select-outer {
    display: none;
  }
  .tab-contents {
    position: relative;
    top: -1px;
    margin-top: 0;
  }
}
.new-message{
	margin: -4px 0 0 23px;
    border-radius: 10px;
    background-color: #43a1d0;
    border: 1px solid #43a1d0;
    color: white;
    padding: 4px 26px 4px 26px;
}
/* Full-width input fields */
.message-input {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
#message-submit{
	width: 50%;
    margin: auto;
    display: block;
}
#tab-button li a:hover, #tab-button .is-active a{
    background: #43a1d0;
}
	</style>
    
     <!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
                                        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                                        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                        
    <style>

#searchResultCreator li,#searchResult1 li,#searchResultCreator2 li {
    list-style: none;
    border: 1px solid #2494f2;
    padding: 10px;
    background: #e3eef7;
    color: #0c0c0c;
    font-weight: 600;
}

ul#searchResultCreator,ul#searchResult1,ul#searchResultCreator2 {
    padding: 0px;
}

ul#searchResultCreator,ul#searchResult1,ul#searchResultCreator2 {
    position: absolute;
    padding: 0px;
    z-index: 9;
    width: 75%;
    /* background-color: #2494f2; */
   /* border: 1px solid #2494f2;*/
    margin-top: -10px;
}
#searchResultCreator li:hover,#searchResult1 li:hover,#searchResultCreator2 li:hover{
 cursor: pointer;
}
#ErrorMsg,#ErrorMsg2
{
 color:red;
 font-weight:bold;
 font-size:18px;
}
#SuccessMsg,#SuccessMsg2
{
 color:green;
 font-weight:bold;
 font-size:18px;
}



div#set{
  position: relative;
  width: 100%;
  height: auto;
  background-color: #3399cceb;
}
#set > a{
  display: block;
  padding: 10px 15px;
  text-decoration: none;
  color: #555;
  font-weight: 600;
  border-bottom: 1px solid #ddd;
  -webkit-transition:all 0.2s linear;
  -moz-transition:all 0.2s linear;
  transition:all 0.2s linear;
}
#set > a i{
  float: right;
  margin-top: 2px;
  color:white;
}
#set > a.active{
  background-color:#3a9cb58c;
  color: #fff;
}
#set .set_content{
  background-color: #f7f6f6;
  border: 1px solid #ddd;
  display:none;
}
#set .set_content p{
  padding: 10px 15px;
  margin: 0;
  color: #333;
}

.message-delete{
    padding:0 0 0 0 !important;
    
}
.delete-icon{
    
    color:black !important;
}
.message-display{
    width:1008px !important;
}
.message-clicking{
    width:1013px;
}
.message-sendimage{
    width: 30px;
    height: 29px;
    background-color: green;
    border-radius: 50%;
    float: left;
}
.message-name{
    margin: 0 0 0 12px;
    color:white;
}
.message-reply{
    float: none !important;
    margin: 0 0 0 11px;
    color:white;
}
.message-date{
    color: white;
    /*margin: 0 0 0 55%;*/
        float: right;
    font-size: 14px;
}
.pop-message{
    margin: 30% 0 0 0;
}
.impact-message{
    float: right;
    position: relative;
    bottom: 37px;
    left: 23px;
}
</style>                                    
                                        
</head>

<body>
<div id="wrapper">
<?php include('include/header.php'); ?>

<div class="container" >
        <div class="col-md-12">
            <div class="layout-12cols">
        <div class="content grid_12">
            <div class="project-detail">
                   <h2 class="message-head">Messages</h2>
                   <div class="project-tab-detail tabbable accordion edit-about message-display" id="message-box">
                   
                       <?php echo $message->load($row_user->email_id); ?>
                     <div id="SuccessMessage" style="color:green"></div>
                    </div>
                </div><!--end: .project-tab-detail -->
            </div>
        </div><!--end: .content -->
        </div>
    </div>
    
    
   
                                        
                                        
                                        
                                        <script type="text/javascript">
                                            $(function() {
											
                                          var $tabButtonItem = $('#tab-button li'),
                                              $tabSelect = $('#tab-select'),
                                              $tabContents = $('.tab-contents'),
                                              activeClass = 'is-active';

                                          $tabButtonItem.first().addClass(activeClass);
                                          $tabContents.not(':first').hide();

                                          $tabButtonItem.find('a').on('click', function(e) {
                                            var target = $(this).attr('href');

                                            $tabButtonItem.removeClass(activeClass);
                                            $(this).parent().addClass(activeClass);
                                            $tabSelect.val(target);
                                            $tabContents.hide();
                                            $(target).show();
                                            e.preventDefault();
                                          });

                                          $tabSelect.on('change', function() {
                                            var target = $(this).val(),
                                                targetSelectNum = $(this).prop('selectedIndex');

                                            $tabButtonItem.removeClass(activeClass);
                                            $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
                                            $tabContents.hide();
                                            $(target).show();
                                          });
                                        });
                                            var modal = document.getElementById('id01');

                                        // When the user clicks anywhere outside of the modal, close it
                                        window.onclick = function(event) {
                                            if (event.target == modal) {
                                                modal.style.display = "none";
                                            }
                                        }
										function settab(){
										
											
                                          var $tabButtonItem = $('#tab-button li'),
                                              $tabSelect = $('#tab-select'),
                                              $tabContents = $('.tab-contents'),
                                              activeClass = 'is-active';

                                          $tabButtonItem.first().addClass(activeClass);
                                          $tabContents.not(':first').hide();

                                          $tabButtonItem.find('a').on('click', function(e) {
                                            var target = $(this).attr('href');

                                            $tabButtonItem.removeClass(activeClass);
                                            $(this).parent().addClass(activeClass);
                                            $tabSelect.val(target);
                                            $tabContents.hide();
                                            $(target).show();
                                            e.preventDefault();
                                          });

                                          $tabSelect.on('change', function() {
                                            var target = $(this).val(),
                                                targetSelectNum = $(this).prop('selectedIndex');

                                            $tabButtonItem.removeClass(activeClass);
                                            $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
                                            $tabContents.hide();
                                            $(target).show();
                                          });
                                        }
                                        </script>
                                        
                                        <script type="text/javascript">
                                            $(function() {
                                          var $tabButtonItem = $('#tab-button li'),
                                              $tabSelect = $('#tab-select'),
                                              $tabContents = $('.tab-contents'),
                                              activeClass = 'is-active';

                                          $tabButtonItem.first().addClass(activeClass);
                                          $tabContents.not(':first').hide();

                                          $tabButtonItem.find('a').on('click', function(e) {
                                            var target = $(this).attr('href');

                                            $tabButtonItem.removeClass(activeClass);
                                            $(this).parent().addClass(activeClass);
                                            $tabSelect.val(target);
                                            $tabContents.hide();
                                            $(target).show();
                                            e.preventDefault();
                                          });

                                          $tabSelect.on('change', function() {
                                            var target = $(this).val(),
                                                targetSelectNum = $(this).prop('selectedIndex');

                                            $tabButtonItem.removeClass(activeClass);
                                            $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
                                            $tabContents.hide();
                                            $(target).show();
                                          });
                                        });
                                            var modal = document.getElementById('impact1');

                                        // When the user clicks anywhere outside of the modal, close it
                                        window.onclick = function(event) {
                                            if (event.target == modal) {
                                                modal.style.display = "none";
                                            }
                                        }
                                        </script>

<?php include('include/footer.php');
include('include/footer_js.php');?>


 <script>
$(document).ready(function() {
 setAccordion();
});
 
 
 function setAccordion() {
  $("#set > a").on("click", function() {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this)
        .siblings(".set_content")
        .slideUp(200);
      $("#set > a i")
        .removeClass("fa-minus")
        .addClass("fa-plus");
    } else {
      $("#set > a i")
        .removeClass("fa-minus")
        .addClass("fa-plus");
      $(this)
        .find("i")
        .removeClass("fa-plus")
        .addClass("fa-minus");
      $("#set > a").removeClass("active");
      $(this).addClass("active");
      $(".set_content").slideUp(200);
      $(this)
        .siblings(".set_content")
        .slideDown(200);
	
    }
  });
}
function setAccordianMsg(id)
 {
         $.ajax({
                url: '<?=BASEPATH?>/ajax/search_message.php',
                type: 'post',
                data: {message_id:id},
                dataType: 'json',
                success:function(response){
				// $.ajax({
//										dataType: 'html',			
//										type: 'GET',cache : false,
//										url: '<?=BASEPATH?>/message.php?get_type=load&email_id=<?php echo $email_id; ?>',
//										success: function(response){ 
//											$('#message-box').html('');
//											$('#message-box').html(response);
//											settab();
//											setAccordion();
//											
//										}});
                return false;
			 }
			 });
 }

 
 </script>
 
 
</div>
</body>
</html>
