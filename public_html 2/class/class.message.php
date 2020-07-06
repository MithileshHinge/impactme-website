<?php
class Message
{

  function __construct()
  {
    $this->db = new query();
	
  }

  function creator($email_id,$type)
  {
   $row = $this->db->fetch_object("select * from impact_user where email_id='".$email_id."' and user_type='ucreate'");
   return $this->db->filter($row->$type);
  }
  
   function impact($email_id,$type)
  {
   $row= $this->db->fetch_object("select * from impact_user where email_id='".$email_id."' and user_type='create'");
   return $this->db->filter($row->$type);
  }
  
   function creator_new($email_id,$type)
  {
   $row = $this->db->fetch_object("select * from impact_user where email_id='".$email_id."' and user_type='ucreate'");
   return $row;
  }
  
   function impact_new($email_id,$type)
  {
   $row= $this->db->fetch_object("select * from impact_user where email_id='".$email_id."' and user_type='create'");
   return $row;
  }


  function load($email_id)
  {
    ob_start();
	
	$sql_count = $this->db->fetch_object("select count(*) c from impact_user where email_id='".$email_id."' and user_type='ucreate'");
	if($sql_count->c==1)
	{
	 $show =1;	
	}
	else
	{
	 $show = 0;	
	}
	
	//$show =1;	
	?>
  
      <ul class="nav nav-tabs clearfix message-nav" id="message-tab">
 <?php if($show==1) {?>
                      <li id="li1" <?php if($show==1) {?>class="active"<?php } ?> onclick="javascipt:$('#creatorbox').click();">
                        <div class="message-image" onclick="javascipt:$('#creatorbox').click();" style="background-image:url(<?=IMAGEPATH.$this->creator($email_id,"image_path")?>); background-size:cover;"></div>
                        <a href="#" id="message-name">
                            <span class="message-rock" onclick="javascipt:$('#creatorbox').click();" style="color: #455058;"><?=$this->creator($email_id,"impact_name") ?></span><br>
                            <span style="color: #455058;font-weight: 300;font-size: 15px;">Creator Inbox</span>

                        </a>
                      </li>
                      <?php } ?>
                      <li id="li2" <?php if($show==0) {?>class="active"<?php } ?> style="margin: 0 0 0 5px;" onclick="javascipt:$('#impactbox').click();">
                      <div class="message-image" onclick="javascipt:$('#impactbox').click();" style="background-image:url(<?=IMAGEPATH.$this->impact($email_id,"image_path")?>); background-size:cover;"></div>
                        <a href="#" id="message-name" style="    border-bottom: 0px solid;"><span class="message-rock" onclick="javascipt:$('#impactbox').click();" style="color: #455058;"><?=$this->impact($email_id,"impact_name") ?></span><br>
                        <?php if($show==1) {?>
                            <span style="color: #455058;font-weight: 300;font-size: 15px;">Supporter Inbox</span>
                       <?php } else {?> <span style="color:black">&nbsp;</span><?php } ?>
                        </a>
                      </li>
                       
                    </ul>
               

      <div class="tab-content">
		  <?php
	 if($show==1) { 
            echo  $this->creator_tab($email_id, $show);
		}
            echo  $this->impact_tab($email_id , $show);
          
          ?>
      </div>
  <?php
   $html = ob_get_contents();
	   ob_get_clean();
	   return $html;	
  }
	


  function creator_tab($email_id , $show=0)
  {
  ob_start();
  $creator_id    =$this->creator($email_id,"user_id"); ?>  
  <div>
  <h3 class="rs alternate-tab accordion-label">Creator</h3>
                            <div class="tab-pane accordion-content <?php if($show==1) {?> active <?php } ?>" style="margin: 0px 0 0 -34px;">
                                <div class="form form-profile">
                                        <br/><br/>
                                        <div class="tabs  message-clicking" style="margin: -84px 0 0 -119px;">
                                          <div class="tab-button-outer">
                                            <ul id="tab-button">
                                                <!--<li style="border: 1px solid #ddd;">-->
                                                <!--    <button id="creatorTab" onClick="document.getElementById('id01').style.display='block'" style="width:auto;" class="new-message">New Message</button>-->
                                                <!--</li>-->
                                                
                                              <!--<li <?php if($show==1) { ?>class="is-active"<?php } ?>><a id="creatorbox" href="#tab01">All</a></li>-->
                                            
                                            </ul>
                                          </div>
                                          <div class="tab-select-outer">
                                            <select id="tab-select">
                                              <option value="#tab01">Tab 1</option>
                                             
                                            </select>
                                          </div>

                                          <div id="tab01" class="tab-contents <?php if($show==1) {?> active <?php } ?>" style="border: 0px;">
                                            <div class="col-md-12" style="    margin: -6px 0 0 -41px;">
                                                

                                          
                                                <div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                  
               <div class="impactme-message">
                   <a href="#" id="creatorTab" onClick="document.getElementById('id01').style.display='block'" class="plus-imapctme">+</a>
                   </div>
                <!-- <span class="input-group-addon"> -->
                <!-- <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> --> </div>
            </div>
          </div>
          <div class="inbox_chat">
           <?php 
		   $i=1;
		    $sql = "select distinct b.id from ( select distinct a.id, a.send_date,a.message, message_id from 
(
SELECT to_id id, send_date,message, message_id FROM `impact_message` WHERE `from_id`='".$creator_id."' 
union all 
SELECT from_id id, send_date,message, message_id FROM `impact_message` WHERE `to_id`='".$creator_id."' 
 
) 
a  order by a.send_date desc  )b";
		   //echo $sql;
		   $sql_fetch = $this->db->runQuery($sql);
		  $to_id =0;
		   
			foreach($sql_fetch as $row_fetch) {
				
			$row_user = $this->db->fetch_object("select * from impact_user where user_id='$row_fetch[id]'");
			
			$row_creator    =$this->creator_new($row_user->email_id); 
		  
		  
		 // print_r($row_impact);
					if(strlen($row_creator->image_path)>0) 
					{
						
				       $profile_image = IMAGEPATH.$row_creator->image_path;
					   if (@file_get_contents($profile_image, 0, NULL, 0, 1)) 
					   {
					      $profile_image = $profile_image;
					   }
					   else
					   {
					     $profile_image ='';
					   }
					}
					 else
					   $profile_image ='';
					   
					   
			//$feature_image = $profile_image;
			
			
			$feature_image = IMAGEPATH.$row_user->image_path;
			
			if($i==1)
			 $to_id = $row_user->user_id;
			 
			 	  $sql_count = $this->db->fetch_object("select count(*) c from impact_message where  from_id='".$row_user->user_id."' and to_id='".$creator_id."' and status=0");
			?>
          <a href="javascript:void(0)" onclick="javascript:
          $.ajax({
                dataType: 'html',
			    type: 'GET',cache : false,
				url: '<?=BASEPATH?>/ajax/ajax_message.php?get_type=load_user_message_list&from_id=<?=$creator_id?>&to_id=<?=$row_user->user_id?>',
				success: function(response)
				{
                 $('.chat_list').removeClass('active_chat');
                $('#ChatActive<?=$row_user->user_id;?>').addClass('active_chat');
               
				$('#loadUserMessage').html(response);
                 $('.msg_history').animate({
					 scrollTop: $('.down').offset().top
				 }, 10);
				}
             });">
            <div class="chat_list <?php if($i==1){ ?> active_chat<?php } ?>" id="ChatActive<?=$row_user->user_id;?>">
              <div class="chat_people">
                <div class="chat_img"> <img src="<?=$feature_image?>" class="message-sendimage"> </div>
                <div class="chat_ib">
                  <h5><?=$this->db->filter($row_user->impact_name)?> <?php if($sql_count->c>0){?><span class="chat_date" style="color:red">( <?=$sql_count->c?> )</span> <?php } ?><!--<span class="chat_date"><?=date('Y-m-d',strtotime($row_fetch['send_date']))?></span>--></h5>
                  
                </div>
              </div>
            </div>
            </a>
            <?php $i++;}  ?>
         
          </div>
        </div>
        <div id="loadUserMessage">
        <?php echo $this->load_user_message_list( $creator_id,$to_id ); ?>
        </div>
        
        
      </div>
      
      
     
      
    </div>   
                                          </div>
                                            
                                          </div>
                                          <div id="tab02" class="tab-contents ">
                                            
                                            
                                          </div>
                                          <div id="tab03" class="tab-contents ">
                                            
                                            
                                          </div>
                                          <div id="tab04" class="tab-contents ">
                                            
                                            
                                          </div>
                                        </div>

                                        
                                    
                                </div>
                            </div><!--end: .tab-pane -->
                        </div>
                        
                
                         <div id="id01" class="modal"> 
      <form class="modal-content animate" action="#" style="width: 44%;" method="post">
        <div class="imgcontainer">
         <span onClick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
         <input type="hidden" name="user" id="user" value="<?=$this->creator($email_id,"user_id") ?>">
        <div class="container">
       
        <div id="ErrorMsg" ></div>
        <div id="SuccessMsg"></div>
         <label for="uname"><b style="font-size: 20px;">From <?=$this->creator($email_id,"impact_name") ?> (Creator)</b></label><br>
          <?php $sql_check = $this->db->fetch_object("SELECT count(*) c FROM impact_user u, impact_join j where  u.user_id=j.creator_id and j.user_id='$creator_id' and u.user_type='ucreate' ");
		if($sql_check->c>0) {?>
          <input type="text" placeholder="To" name="creator_name" id="creator_name" required class="message-input"><br>
           <ul id="searchResultCreator"></ul>
           <input type="hidden" name="creator_id" id="creator_id" value="">
         <textarea id="subject" name="subject" placeholder="Message" style="height:200px" class="message-input"></textarea>
             <button type="button" id="message-submit" class="new-message">Send</button>
             <?php } else {?>
             <p>You Don't Have Any Impact That You Can Message</p><br />
<br />
<br />
<br />

             <?php } ?>
        </div>
     </form>
    </div>

     <script>
					   $(document).ready(function() {

				  $('.msg_history').animate({
					 scrollTop: $('.down').offset().top
				 }, 1000);

});
 </script> 
    
    <script>

   $(document).ready(function() {
/*    $("#creatorTab").click(function(){
	//document.getElementById('id01').style.display='block';
	$("#id01").attr("style", "display:block");
	});
    $("#CreatorTabClose").click(function(){
	//document.getElementById('id01').style.display='block';
	$("#id01").attr("style", "display:none");
	});
*/
  $("#creator_name").keyup(function(){
        
        var search = $(this).val();
       if(search.length>=2) {
        if(search != ""){
         var ID = <?= $creator_id?>;
            $.ajax({
                url: '<?=BASEPATH?>/ajax/search_message.php',
                type: 'post',
                data: {user_nameCreator:search, type:1, userID : ID},
                dataType: 'json',
                success:function(response){
                
                    var len = response.length;

                    $("#searchResultCreator").empty();
                    for( var i = 0; i<len; i++){

                        var id = response[i]['id'];
                        var fname = response[i]['name'];
                        var image = response[i]['image'];

                        $("#searchResultCreator").append("<li value='"+id+"'><div class='small-creater' style='background-image:url("+image+");  background-size:cover;width:25px; height:25px'></div>"+fname+"</li>");
                    }

                    $("#searchResultCreator li").bind("click",function(){
                        setText(this);
                    });

                }
            });
        }
		}
		else
		{
		$("#searchResultCreator").empty();
		}
    });



function setText(element){

   // var value = $(element).text();
    var userid = $(element).val();

  //  $("#txt_search").val(value);
    $("#searchResultCreator").empty();
    
    // Request User Details
    $.ajax({
        url: '<?=BASEPATH?>/ajax/search_message.php',
        type: 'post',
        data: {userid:userid},
        dataType: 'json',
        success: function(response){

           var impact_name = response[0].impact_name;
           var email_id = response[0].email_id;
           var user_id = response[0].user_id;

          $('#creator_name').val(impact_name);
		  $('#creator_id').val(user_id);

        }

    });
}

});
    </script>
    <script>
	$(document).ready(function() {
	 
	 
	  $("#message-submit").click(function(){
	  var creator_id = $("#creator_id").val();
	  var creator_name = $("#creator_name").val();
	  var user = $("#user").val(); 
	  var subject = $("#subject").val();
	  if(user=="" || creator_id=="" || creator_name=="" )
	  {
	           $("#ErrorMsg").fadeIn().html("Please Choose Any Impact");
			   setTimeout(function(){ $("#ErrorMsg").fadeOut(); }, 3000);
			   
			   $("#searchResultCreator").empty();
			    $("#creator_name").val("");
			    $("#creator_name").focus();
			   return false; 
	  }
	  else if(subject.trim()=="" )
	  {
	           $("#ErrorMsg").fadeIn().html("Please Write Your Message");
			   setTimeout(function(){ $("#ErrorMsg").fadeOut(); }, 3000);
			   $("#subject").focus();
			   return false; 
	  }
	  else
	  {
	     $.ajax({
                url: '<?=BASEPATH?>/ajax/search_message.php',
                type: 'post',
                data: {creator_id:creator_id,user:user,subject:subject.trim()},
                dataType: 'json',
                success:function(response){
               if(response==false)
				{
				 $("#ErrorMsg").fadeIn().html("Message Not Sent");
				}
				else
				{
                   $("#SuccessMsg").fadeIn().html("Your Message Has Been Sent");
				   $("#creator_name").val("");
				   $("#creator_id").val("");
				   $("#subject").val("");
			       setTimeout(function(){ $("#SuccessMsg").fadeOut(); 
				   //$("#id01").hide();
				  // document.getElementById('id01').style.display='none'; 
				   
				   }, 1500);
				   
				   $.ajax({
										dataType: 'html',			
										type: 'GET',cache : false,
										url: '<?=BASEPATH?>/message.php?get_type=load&email_id=<?php echo $email_id; ?>',
										success: function(response){ 
											$('#message-box').html('');
											$('#message-box').html(response);
											
											//var valo = $('#hidd_<?php echo $ext; ?>').val();
												//$('#tab<?php echo $ext; ?>').html(valo);
												
												$.ajax({
										dataType: 'html',			
										type: 'GET',cache : false,
										url: '<?=BASEPATH?>/ajax/ajax_message.php?get_type=load_user_message_list&from_id='+user+'&to_id='+creator_id,
										success: function(response2){ 
										 $('.chat_list').removeClass('active_chat');
											$('#ChatActive'+creator_id).addClass('active_chat');
											$('#loadUserMessage').html(response2);
										}
										});
										
										settab();
											setAccordion();
										}});
										
										
										
				
				
			     // 
			       return false; 

                }
				}
            });
	  
	  }
	  });
	  
	  });
	
	
	</script>
	
 
                        <?php
    $html = ob_get_contents();
	   ob_get_clean();
	   return $html;	
  }
  
  function impact_tab($email_id , $show=0)
  {
   ob_start();
   $impact_id    =$this->impact($email_id,"user_id"); 
   
   ?>
  <div>
                            <h3 class="rs alternate-tab accordion-label">Impact</h3>
                            <div class="tab-pane accordion-content  <?php if($show==0) {?> active <?php } ?>" style="margin: 0px 0 0 -34px;">
                                <div class="form form-profile">
                                        <br/><br/>
                                        <div class="tabs message-clicking" style="margin: -84px 0 0 -119px;">
                                          <div class="tab-button-outer">
                                            <ul id="tab-button">
                                                <li style="border: 1px solid #ddd;">
                                                    <button onClick="document.getElementById('impact1').style.display='block'" style="width:auto;" class="new-message">New Message</button>
                                                </li>
                                                
                                              <!--<li <?php if($show==0) {?> class="is-active" <?php } ?>><a id="impactbox" href="#tab0111">All</a></li>-->
                                             <!-- <li><a href="#tab0222">Unread</a></li>
                                              <li><a href="#tab0333">Read</a></li>
                                             <li><a href="#tab0444">Sent</a></li>-->
                                            </ul>
                                          </div>
                                          <div class="tab-select-outer">
                                            <select id="tab-select">
                                              <option value="#tab0111">Tab 1</option>
                                             <!-- <option value="#tab0222">Tab 2</option>
                                              <option value="#tab0333">Tab 3</option>
                                             <option value="#tab0444">Tab 4</option>-->
                                            </select>
                                          </div>

                                          <div id="tab0111" class="tab-contents <?php if($show==0) {?> active <?php } ?>" style="display:block !important;border:0px;" >
                                          
                                         <div class="col-md-12" style="    margin: -5px 0 0 -41px;">
                                                <div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <!--<input type="text" class="search-bar"  placeholder="Search" >-->
                <!-- <span class="input-group-addon"> -->
                <!-- <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> --> </div>
            </div>
          </div>
          <div class="inbox_chat">
           <?php 
		   $i=1;
		
			
		 $sql = "select distinct b.id from ( select distinct a.id, a.send_date,a.message, message_id from 
(
SELECT to_id id, send_date,message, message_id FROM `impact_message` WHERE `from_id`='".$impact_id."' 
union all 
SELECT from_id id, send_date,message, message_id FROM `impact_message` WHERE `to_id`='".$impact_id."' 
 
) 
a  order by a.send_date desc  )b";	
			
		   $sql_fetch = $this->db->runQuery($sql);
		   
		  // $sql_fetch = $this->db->runQuery("select * from impact_message where to_id='$impact_id' or from_id='$impact_id'  group by from_id order by send_date desc");
		   
		   
		  $to_id =0;
		   
			foreach($sql_fetch as $row_fetch) {
				//if($row_fetch['to_id'] != $impact_id) {
			$row_user = $this->db->fetch_object("select * from impact_user where user_id='$row_fetch[id]'");
			
			$row_impact    =$this->impact_new($row_user->email_id); 
		  
		  
		 // print_r($row_impact);
					if(strlen($row_impact->image_path)>0) 
					{
						
				       $profile_image = IMAGEPATH.$row_impact->image_path;
					   if (@file_get_contents($profile_image, 0, NULL, 0, 1)) 
					   {
					      $profile_image = $profile_image;
					   }
					   else
					   {
					     $profile_image ='';
					   }
					}
					 else
					   $profile_image ='';
					   
					   
			$feature_image = $profile_image;
			
			if($i==1)
			 $to_id = $row_user->user_id;
			 
			  $sql_count = $this->db->fetch_object("select count(*) c from impact_message where  from_id='".$row_user->user_id."' and to_id='".$impact_id."' and status=0");
			?>
          <a href="javascript:void(0)" onclick="javascript:
          $.ajax({
                dataType: 'html',
			    type: 'GET',cache : false,
				url: '<?=BASEPATH?>/ajax/ajax_message.php?get_type=load_user_message_list_impact&from_id=<?=$impact_id?>&to_id=<?=$row_user->user_id?>',
				success: function(response)
				{
                 $('.chat_list2').removeClass('active_chat');
                $('#ChatActive2<?=$row_user->user_id;?>').addClass('active_chat');
               
				$('#loadUserMessage2').html(response);
                 $('.msg_history2').animate({
					 scrollTop: $('.down2').offset().top
				 }, 10);
				}
             });">
             
            <div class="chat_list chat_list2 <?php if($i==1){ ?> active_chat<?php } ?>" id="ChatActive2<?=$row_user->user_id;?>">
              <div class="chat_people">
                <div class="chat_img"> <img src="<?=$feature_image?>" class="message-sendimage"> </div>
                <div class="chat_ib">
                  <h5><?=$this->db->filter($row_user->impact_name)?><!--<span class="chat_date"><?=date('Y-m-d',strtotime($row_fetch['send_date']))?></span>--> <?php if($sql_count->c>0){?><span class="chat_date" style="color:red">( <?=$sql_count->c?> )</span> <?php } ?></h5>
                  
                </div>
              </div>
            </div>
            </a>
            
            <?php $i++;}
			//} ?>
         
          </div>
        </div>
       
        <div id="loadUserMessage2">
        <?php echo $this->load_user_message_list_impact( $impact_id,$to_id ); ?>
        </div>
        
        
      </div>
   
      
     
      
    </div>
                                          </div>
                                          
                                          
                                          </div>
                                          <div id="tab0222" class="tab-contents">
                                            
                                          </div>
                                          <div id="tab0333" class="tab-contents">
                                            
                                          </div>
                                          <div id="tab0444" class="tab-contents">
                                          
                                          </div>
                                        </div>

                                        
                                </div>
                            </div><!--end: .tab-pane -->
                        </div>
                       <script>
					   $(document).ready(function() {

				  $('#msg_history2').animate({
					 scrollTop: $('.down2').offset().top
				 }, 1000);

});
 </script> 
                        
                        <div id="impact1" class="modal">
                                          
                                          <form class="modal-content animate" action="#" style="width: 44%;" method="post">
        <div class="imgcontainer">
         <span onClick="document.getElementById('impact1').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
         <input type="hidden" name="user_i" id="user_i" value="<?=$this->impact($email_id,"user_id") ?>">
        <div class="container">
       
        <div id="ErrorMsg2" ></div>
        <div id="SuccessMsg2"></div>
         <label for="uname"><b style="font-size: 20px;">From <?=$this->impact($email_id,"impact_name") ?> (Impact)</b></label><br>
          <?php $sql_check = $this->db->fetch_object(  "select count(*) c from impact_payment p, impact_user u where u.user_id=p.creator_id and p.user_id='$impact_id' and (p.status='authenticated' or p.status='active') order by u.full_name");
		  
	
  
  
		  
		
  
		if($sql_check->c>0) {?>
          <input type="text" placeholder="To" name="impact_name" id="impact_name" required class="message-input"><br>
           <ul id="searchResultCreator2"></ul>
           <input type="hidden" name="impact_id" id="impact_id" value="">
         <textarea id="subject2" name="subject" placeholder="Message" style="height:200px" class="message-input"></textarea>
         <div class="col-md-12">
             <button type="button" id="message-submit2" class="new-message">Send</button>
             </div>
             <?php } else {?>
             <p>You Don't Have Any Creator That You Can Message</p><br />
<br />
<br />
<br />

             <?php } ?>
        </div>
     </form>
                                        </div>
                                        
                          <script>

   $(document).ready(function() {
   
/*    $("#creatorTab").click(function(){
	//document.getElementById('id01').style.display='block';
	$("#id01").attr("style", "display:block");
	});
    $("#CreatorTabClose").click(function(){
	//document.getElementById('id01').style.display='block';
	$("#id01").attr("style", "display:none");
	});
*/
  $("#impact_name").keyup(function(){
        
        var search = $(this).val();
       if(search.length>=2) {
        if(search != ""){
         var ID = <?= $impact_id?>;
            $.ajax({
                url: '<?=BASEPATH?>/ajax/search_message.php',
                type: 'post',
                data: {user_nameImpact:search, type:1, userID : ID},
                dataType: 'json',
                success:function(response){
                
                    var len = response.length;

                    $("#searchResultCreator2").empty();
                    for( var i = 0; i<len; i++){

                        var id = response[i]['id'];
                        var fname = response[i]['name'];
                        var image = response[i]['image'];

                        $("#searchResultCreator2").append("<li value='"+id+"'><div class='small-creater' style='background-image:url("+image+");  background-size:cover;width:25px; height:25px'></div>"+fname+"</li>");
                    }

                    $("#searchResultCreator2 li").bind("click",function(){
                        setText(this);
                    });

                }
            });
        }
		}
		else
		{
		$("#searchResultCreator2").empty();
		}
    });



function setText(element){

   // var value = $(element).text();
    var userid = $(element).val();

  //  $("#txt_search").val(value);
    $("#searchResultCreator2").empty();
    
    // Request User Details
    $.ajax({
        url: '<?=BASEPATH?>/ajax/search_message.php',
        type: 'post',
        data: {userid:userid},
        dataType: 'json',
        success: function(response){

           var impact_name = response[0].impact_name;
           var email_id = response[0].email_id;
           var user_id = response[0].user_id;

          $('#impact_name').val(impact_name);
		  $('#impact_id').val(user_id);

        }

    });
}

});
    </script>
    <script>
	$(document).ready(function() {
	 
	 
	  $("#message-submit2").click(function(){
	  var impact_id = $("#impact_id").val();
	  var impact_name = $("#impact_name").val();
	  var user_i = $("#user_i").val(); 
	  var subject2 = $("#subject2").val();
	  if(user_i=="" || impact_id=="" || impact_name=="" )
	  {
	           $("#ErrorMsg2").fadeIn().html("Please Choose Any Creator");
			   setTimeout(function(){ $("#ErrorMsg2").fadeOut(); }, 3000);
			   
			   $("#searchResultCreator2").empty();
			    $("#impact_name").val("");
			    $("#impact_name").focus();
			   return false; 
	  }
	  else if(subject2.trim()=="" )
	  {
	           $("#ErrorMsg2").fadeIn().html("Please Write Your Message");
			   setTimeout(function(){ $("#ErrorMsg2").fadeOut(); }, 3000);
			   $("#subject2").focus();
			   return false; 
	  }
	  else
	  {
	     $.ajax({
                url: '<?=BASEPATH?>/ajax/search_message.php',
                type: 'post',
                data: {impact_id:impact_id,user:user_i,subject:subject2.trim()},
                dataType: 'json',
                success:function(response){
				if(response==false)
				{
				 $("#ErrorMsg2").fadeIn().html("Message Not Sent");
				}
				else
				{
               
                   $("#SuccessMsg2").fadeIn().html("Your Message Has Been Sent");
				   $("#impact_name").val("");
				   $("#impact_id").val("");
				   $("#subject2").val("");
			       setTimeout(function(){ $("#SuccessMsg2").fadeOut(); 
				   $("#impact1").hide();
				  // document.getElementById('id01').style.display='none'; 
				   
				   }, 1500);
				   var a = $('#message-tab li.active').attr("id");
				   $.ajax({
										dataType: 'html',			
										type: 'GET',cache : false,
										url: '<?=BASEPATH?>/message.php?get_type=load&email_id=<?php echo $email_id; ?>',
										success: function(response){ 
											$('#message-box').html('');
											$('#message-box').html(response);
											settab();
											setAccordion();
                      $('#'+a).click();

											//var valo = $('#hidd_<?php echo $ext; ?>').val();
												//$('#tab<?php echo $ext; ?>').html(valo);
										}});
				
			     // 
			       return false; 

                }
				}
            });
	  
	  }
	  });
	  
	  });
	
	
	</script>              
                                        
                        <?php
    $html = ob_get_contents();
	   ob_get_clean();
	   return $html;	
  
  }
  
  function load_user_message_list($from_id,$to_id){
 ob_start();	
 $sql = "select * from impact_message where ( from_id='".$from_id."' and to_id='".$to_id."' ) or ( from_id='".$to_id."' and to_id='".$from_id."' ) order by send_date asc";

 $sql_update = $this->db->runQuery("update impact_message set status=1 where  from_id='".$to_id."' and to_id='".$from_id."'");
?>
<div class="mesgs">
          <div class="msg_history">
          <?php $sql_query = $this->db->runQuery($sql);
		  foreach($sql_query as $row)
		  {
			  
		
            $from_user = $this->db->fetch_object("select image_path from impact_user where user_id='".$row['from_id']."'");
			//$to_user = $this->db->fetch_object("select * from impact_user where user_id='".$row['to_id']."'");
		    
		  ?>
          <?php if($row['to_id']==$from_id) {?>
            <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="<?=IMAGEPATH.$from_user->image_path?>" alt=""> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p><?=html_entity_decode($row['message'])?></p>
                  <span class="time_date"> <?=date('h:i a | M d', strtotime($row['send_date']))?> <?=$from_id?></span></div>
              </div>
            </div>
            <?php } else { ?>
            <div class="outgoing_msg">
             
              <div class="sent_msg">
                <p><?=html_entity_decode($row['message'])?></p>
                <span class="time_date"> <?=date('h:i a | M d', strtotime($row['send_date']))?></span> </div>
            </div>
            <?php } ?>
          
          <?php } ?>
          <div class="down"></div>
          </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" class="write_msg" placeholder="Type a message" value="" id="write_msg" />
              <button class="msg_send_btn" type="button" id="msg_send_btn">
                <i class="fa fa-paper-plane-o plane" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>
        <script>
		  $(".write_msg").keypress(function (e) {					  
			if(e.which == 13 && !e.shiftKey) {  
			  var from_id = <?=$from_id?>;
			  var to_id = <?=$to_id?>;   //get form ID
			//id = id.match(/\[(.*?)\]/)[1];
		   // console.log(post_id);
			 var msg = $('#write_msg').val();
			
			    form_submit_new(from_id, to_id, msg);
				e.preventDefault();
				return false;
			}
		});
		
		$('#msg_send_btn').click(function(){
			 var from_id = <?=$from_id?>;
			 var to_id = <?=$to_id?>;   //get form ID
			 var msg = $('#write_msg').val();
			 form_submit_new(from_id, to_id, msg);
		});
		
		function form_submit_new(from_id,to_id,msg) {

             
			$.ajax({
                dataType: 'html',
			    type: 'GET',cache : false,
				url: '<?=BASEPATH?>/ajax/ajax_message.php?get_type=message_add&from_id='+from_id+'&to_id='+to_id+'&msg='+msg,
				success: function(response)
				{
                if(response==false)
				{
				 alert("Message Not Sent");
				}
				else
				{
				 $.ajax({
                dataType: 'html',
			    type: 'GET',cache : false,
				url: '<?=BASEPATH?>/ajax/ajax_message.php?get_type=load_user_message_list&from_id='+from_id+'&to_id='+to_id,
				success: function(response2)
				{
                 $('.chat_list').removeClass('active_chat');
                
                 $('#write_msg').val('');
			 	$('#loadUserMessage').html(response2);
				
				 $('#ChatActive'+to_id).addClass('active_chat');
			
				  $('.msg_history').animate({
					 scrollTop: $('.down').offset().top
				 }, 10);
				 
	 
				}
             });
			     }
			 
             
				}
             })
               
            }
		</script>
        
      
<?php
   $html = ob_get_contents();
	   ob_get_clean();
	   return $html;		
  }
  function load_user_message_list_impact($from_id,$to_id){
 ob_start();	
 $sql = "select * from impact_message where ( from_id='".$from_id."' and to_id='".$to_id."' ) or ( from_id='".$to_id."' and to_id='".$from_id."' ) order by send_date asc";
 
  $sql_update = $this->db->runQuery("update impact_message set status=1 where  from_id='".$to_id."' and to_id='".$from_id."'");
?>
<div class="mesgs">
          <div class="msg_history msg_history2" id="msg_history2">
          <?php $sql_query = $this->db->runQuery($sql);
		  foreach($sql_query as $row)
		  {
            $from_user = $this->db->fetch_object("select image_path from impact_user where user_id='".$row['from_id']."'");
			//$to_user = $this->db->fetch_object("select * from impact_user where user_id='".$row['to_id']."'");
		    
		  ?>
          <?php if($row['to_id']==$from_id) {?>
            <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="<?=IMAGEPATH.$from_user->image_path?>" alt=""> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p><?=html_entity_decode($row['message'])?></p>
                  <span class="time_date"> <?=date('h:i a | d M ', strtotime($row['send_date']))?> <?=$from_id?></span></div>
              </div>
            </div>
            <?php } else { ?>
            <div class="outgoing_msg">
             
              <div class="sent_msg">
                <p><?=html_entity_decode($row['message'])?></p>
                <span class="time_date"> <?=date('h:i a | d M', strtotime($row['send_date']))?></span> </div>
            </div>
            <?php } ?>
          
          <?php } ?>
          <div class="down2"></div>
          </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" class="write_msg2" placeholder="Type a message" value="" id="write_msg2" />
              <button class="msg_send_btn" type="button" id="msg_send_btn2">
                <i class="fa fa-paper-plane-o plane" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>
        <script>
		  $(".write_msg2").keypress(function (e) {					  
			if(e.which == 13 && !e.shiftKey) {  
			  var from_id = <?=$from_id?>;
			  var to_id = <?=$to_id?>;   //get form ID
			//id = id.match(/\[(.*?)\]/)[1];
		   // console.log(post_id);
			 var msg = $('#write_msg2').val();
			
			    form_submit_new2(from_id, to_id, msg);
				e.preventDefault();
				return false;
			}
		});
		
		$('#msg_send_btn2').click(function(){
			 var from_id = <?=$from_id?>;
			 var to_id = <?=$to_id?>;   //get form ID
			 var msg = $('#write_msg2').val();
			 form_submit_new2(from_id, to_id, msg);
		});
		
		function form_submit_new2(from_id,to_id,msg) {

             
			$.ajax({
                dataType: 'html',
			    type: 'GET',cache : false,
				url: '<?=BASEPATH?>/ajax/ajax_message.php?get_type=message_add&from_id='+from_id+'&to_id='+to_id+'&msg='+msg,
				success: function(response)
				{
                if(response==false)
				{
				 alert("Message Not Sent");
				}
				else
				{
				 $.ajax({
                dataType: 'html',
			    type: 'GET',cache : false,
				url: '<?=BASEPATH?>/ajax/ajax_message.php?get_type=load_user_message_list_impact&from_id='+from_id+'&to_id='+to_id,
				success: function(response2)
				{
                 $('.chat_list2').removeClass('active_chat');
                
                 $('#write_msg2').val('');
			 	$('#loadUserMessage2').html(response2);
				 $('#ChatActive2'+to_id).addClass('active_chat');
				  $('.msg_history2').animate({
					 scrollTop: $('.down2').offset().top
				 }, 10);
				 
				}
             });
			  }
			 
             
				}
             })
               
            }
		</script>
<?php
   $html = ob_get_contents();
	   ob_get_clean();
	   return $html;		
  }  
  function message_add($from_id=0, $to_id=0, $message='')
  {
	   $creator_id = $this->db->filter($from_id);
	   $user = $this->db->filter($to_id);
	   $subject = $this->db->filter(trim($message));
	   $date = date('Y-m-d H:i:s');
	   if(empty($subject) || $subject == "" || $user==0 || $creator_id==0) {
		echo false;
	   }
	   else
	   {
		$sql = "insert into impact_message (message_id, from_id, to_id, message, send_date, status) values(NULL, '".$creator_id."' , '".  $user."' , '".$subject."' , '".$date."',0 )";
	   $result = $this->db->Query($sql);
	   echo $result;	
	   }
	   
		
	}





}



?>

