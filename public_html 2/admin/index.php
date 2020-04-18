<?php include('configure.php');

if(!empty($_SESSION[SESSION_USER]) && !empty($_SESSION[PASSWORD]))
{
 header('location:'.ADMINPATH."/dashboard/");
}

$table_name= "admin_user";
if($_REQUEST[mode]=="login")
{
$user_name = $db_query->filter($_REQUEST[username]);
$password = $db_query->filter($_REQUEST[password]);
$language_id = 1;	
if(!empty($user_name) && !empty($password) )
{
	$login_check = $db_query->login_check($user_name,$password,$language_id);
	if($login_check==1)
	{
	 // $_SESSION[language_id] = $language_id;
	  $db_query->redirect(ADMINPATH.'/dashboard/');	
	}
	else
	{
		$msg = $login_check;
	}
	
}
else
{
 $msg = "Please fill all the fields";	
}
	
$log_msg = 	$msg;
	
}



 ?>
<!DOCTYPE html>
<html lang="en"> 
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="shortcut icon" href="<?=$fav_icon?>">
      <title><?=PROJECT_TITLE?> || Admin Zone</title>
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Raleway:300,200,100" rel="stylesheet" type="text/css">
      <link href="<?=ADMINPATH?>/assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="<?=ADMINPATH?>/assets/lib/font-awesome/css/font-awesome.min.css">
     
      <link rel="stylesheet" type="text/css" href="<?=ADMINPATH?>/assets/lib/jquery.nanoscroller/css/nanoscroller.css">
      <link href="<?=ADMINPATH?>/assets/css/style.css" rel="stylesheet"> 
   </head>
   <body class="texture">
      <div id="cl-wrapper" class="login-container">
         <div class="middle-login">
            <div class="block-flat">
               <div class="header">
                  <h3 class="text-center">Admin Zone</h3>
               </div>
               <div>
                  <form style="margin-bottom: 0px !important;" action="<?=$_SERVER['REQUEST_URI']?>" class="form-horizontal" method="post" data-parsley-validate="" novalidate autocomplete="off">
                     <div class="content">
                        <h4 class="title">Login Access</h4>
                         <?php if($log_msg) { ?> <p class="normal_text"><font color="#FF6633"><?=$log_msg?></font></p> <?php } ?>
                        <div class="form-group">
                           <div class="col-sm-12">
                              <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input id="username"  name="username" type="text" placeholder="Username" class="form-control" autocomplete="off"  value="<?=$_REQUEST[username]?>" required onClick="this.value=''" tabindex="1"></div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-sm-12">
                              <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span><input id="password" name="password" type="password" placeholder="Password" class="form-control" autocomplete="off"  value="" required onClick="this.value=''" tabindex="2"></div>
                           </div>
                        </div>
                        
                        
                        <!--<div class="form-group">
                           <div class="col-sm-12">
                              <div class="input-group"><span class="input-group-addon"><i class="fa fa-cog"></i></span>
                              
                              <select name="language_id" id="language_id" class="form-control" required autocomplete="off" tabindex="3">
                             <option value="">--Select Language--</option>
                             <?php
							 $sql_language = $db_query->runQuery("select language_id, language_name from language where status=1 order by language_name");
							 foreach($sql_language as $row_language){
							 ?>
                             <option value="<?=$row_language[language_id]?>" <?php if($_REQUEST[language_id]==$row_language[language_id]) {?> selected<?php } ?>><?=$row_language[language_name]?></option>
                             <?php } ?>
                             </select>
                              
                              </div>
                           </div>
                        </div>-->
                        
                        
                        
                     </div>
                     <div class="foot"><!--<button data-dismiss="modal" type="button" class="btn btn-default">Register</button>-->
                     <input type="hidden" name="mode" value="login">
                    <button data-dismiss="modal" type="submit" class="btn btn-primary" tabindex="4">Log me in</button></div>
                  </form>
               </div>
            </div>
            <div class="text-center out-links"><a href="#">© <?=date('Y')?> <?=PROJECT_TITLE?></a></div>
         </div>
      </div>
      <script type="text/javascript" src="<?=ADMINPATH?>/assets/lib/jquery/jquery.min.js"></script>
      <script type="text/javascript" src="<?=ADMINPATH?>/assets/lib/jquery.nanoscroller/javascripts/jquery.nanoscroller.min.js"></script>
	  <script type="text/javascript" src="<?=ADMINPATH?>/assets/js/cleanzone.js"></script>
	  <script src="<?=ADMINPATH?>/assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
      
      
      <script src="<?=ADMINPATH?>/assets/lib/jquery.parsley/dist/parsley.min.js" type="text/javascript"></script>
<script src="<?=ADMINPATH?>/assets/lib/jquery.parsley/src/extra/dateiso.js" type="text/javascript"></script>
	  

      
	  <script type="text/javascript">$(document).ready(function(){
         App.init();
         $('form').parsley();
         });
      </script>
   </body>
</html>