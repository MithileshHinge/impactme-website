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
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
 <meta charset="utf-8">
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
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="https://rawgit.com/mervick/emojionearea/master/dist/emojionearea.js"></script>
    <link rel="stylesheet" type="text/css" href="https://rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
    <script src="https://twemoji.maxcdn.com/v/latest/twemoji.min.js" crossorigin="anonymous"></script>

    <?php include('include/titlebar.php'); ?>
    <style>
	.home-feature-category {
    padding-top: 101px;
}

img.emoji {
   height: 1em;
   width: 1em;
   margin: 0 .05em 0 .1em;
   vertical-align: -0.1em;
}

    
     /*=====message csss======*/
.message-image{
	width: 50px;
    height: 50px;
  /*border:1px solid #0000000d;*/
    float: left;
       margin: 7px 0 2px 0;

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
    font-weight: bolder;
    color: black;
}
.message-head{
	color: black;
    /* padding: 0 0 0 0; */
    margin: 56px 0 0 28px;
}
.message-nav{
        margin: 0 0 0 -27px;
        border-bottom:0px solid !important;
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
    padding: 6px 26px 6px 26px;
}
/* Full-width input fields */
.message-input {
  width: 48%;
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
  z-index: 2; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  /*overflow: auto; */
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
	width: 21%;
    /* margin: auto; */
    display: block;
    margin: 7px 0 0 0;
}
#tab-button li a:hover, #tab-button .is-active a{
    background: #43a1d0;
}
	</style>
    
     <!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
                                        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                                        <!--script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script-->
                                        <!--script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script-->
                                        
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
       <style>
.tab-contents{
    height: 655px;
}
    .inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:6px 0 6px -9px;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.incoming_msg_img img{
  max-height:35px;
}
.outgoing_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}

.input_msg_write {
  width: 91%;
  padding: 7px 0 0 0;
}

.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 92%;
}

.type_msg {
  border-top: 1px solid #c4c4c4;
  position: relative;
  padding: 0 0 0 12px;
  margin: 15px 0 0 0;
}

.msg_send_btn {
  background: #3a9cb5 none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 8px;
  top: 8px;
  width: 33px;
}
/*.plane{*/
/*  position: relative;*/
/*    bottom: 11px;*/
/*    left: -10px;*/
/*}*/
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
</style>                                 
</head>

<body style="background-color:white;">
<div id="wrapper">
<?php include('include/header.php'); ?>

<div class="container" >
        <div class="col-md-12">
            <div class="layout-12cols">
        <div class="content grid_12">
            <div class="project-detail">
                   <h2 class="message-head" style="color: #455058;">Messages</h2>
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
                                          $tabContents.not(':first').not('#tab0111').hide();

                                          $tabButtonItem.find('a').on('click', function(e) {
                                            var target = $(this).attr('href');

                                            $tabButtonItem.removeClass(activeClass);
                                            $(this).parent().addClass(activeClass);
                                            $tabSelect.val(target);
                                            //$tabContents.hide();
                                            $(target).show();
                                            e.preventDefault();
                                          });

                                          $tabSelect.on('change', function() {
                                            var target = $(this).val(),
                                                targetSelectNum = $(this).prop('selectedIndex');

                                            $tabButtonItem.removeClass(activeClass);
                                            $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
                                            //$tabContents.hide();
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
                                          $tabContents.not(':first').not('#tab0111').hide();

                                          $tabButtonItem.find('a').on('click', function(e) {
                                            var target = $(this).attr('href');

                                            $tabButtonItem.removeClass(activeClass);
                                            $(this).parent().addClass(activeClass);
                                            $tabSelect.val(target);
                                            //$tabContents.hide();
                                            $(target).show();
                                            e.preventDefault();
                                          });

                                          $tabSelect.on('change', function() {
                                            var target = $(this).val(),
                                                targetSelectNum = $(this).prop('selectedIndex');

                                            $tabButtonItem.removeClass(activeClass);
                                            $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
                                            //$tabContents.hide();
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
                                          $tabContents.not(':first').not('#tab0111').hide();

                                          $tabButtonItem.find('a').on('click', function(e) {
                                            var target = $(this).attr('href');

                                            $tabButtonItem.removeClass(activeClass);
                                            $(this).parent().addClass(activeClass);
                                            $tabSelect.val(target);
                                            //$tabContents.hide();
                                            $(target).show();
                                            e.preventDefault();
                                          });

                                          $tabSelect.on('change', function() {
                                            var target = $(this).val(),
                                                targetSelectNum = $(this).prop('selectedIndex');

                                            $tabButtonItem.removeClass(activeClass);
                                            $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
                                            //$tabContents.hide();
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

$(document).ready(function() {

     $('.msg_history').animate({
					 scrollTop: $('.down').offset().top
				 }, 10);
				 
				  $('#msg_history2').animate({
					 scrollTop: $('.down2').offset().top
				 }, 1000);

});
 </script>
 
 
</div>
</body>
</html>
