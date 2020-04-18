<?php
class Message
{

  function __construct()
  {
    $this->db = new query();
	
  }

  function creator($email_id,$type)
  {
   $row = $this->db->fetch_object("select * from impact_user where email_id='".$email_id."' and user_type='create'");
   return $this->db->filter($row->$type);
  }
  
   function impact($email_id,$type)
  {
   $row= $this->db->fetch_object("select * from impact_user where email_id='".$email_id."' and user_type='ucreate'");
   return $this->db->filter($row->$type);
  }


  function load($email_id)
  {
    ob_start();
	?>
  
      <ul class="nav nav-tabs clearfix" id="message-tab">
                      <li class="active">
                        <div class="message-image" style="background-image:url(<?=IMAGEPATH.$this->creator($email_id,"image_path")?>); background-size:cover;"></div>
                        <a href="#" id="message-name"><span class="message-rock"><?=$this->creator($email_id,"impact_name") ?></span><br>
                            <span style="color:black">Creator Inbox</span>

                        </a>
                      </li>
                      <li style="margin: 0 0 0 33px;">
                      <div class="message-image" style="background-image:url(<?=IMAGEPATH.$this->impact($email_id,"image_path")?>); background-size:cover;"></div>
                        <a href="#" id="message-name"><span class="message-rock"><?=$this->impact($email_id,"impact_name") ?></span><br>
                            <span style="color:black">Impact Inbox</span>

                        </a>
                      </li>
                      
                    </ul>

      <div class="tab-content">
		  <?php
            echo  $this->creator_tab($email_id);
            echo  $this->impact_tab($email_id);
          
          ?>
      </div>
  <?php
   $html = ob_get_contents();
	   ob_get_clean();
	   return $html;	
  }

  function creator_tab($email_id)
  {
  ob_start();?>
  <div>
                            <div class="tab-pane accordion-content active" style="margin: 33px 0 0 -30px;">
                                <div class="form form-profile">
                                        <br/><br/>
                                        <div class="tabs  message-clicking">
                                          <div class="tab-button-outer">
                                            <ul id="tab-button">
                                                <li style="border: 1px solid #ddd;">
                                                    <button id="creatorTab" onClick="document.getElementById('id01').style.display='block'" style="width:auto;" class="new-message">New Message</button>
                                                </li>
                                                
                                              <li class="is-active"><a href="#tab01">All</a></li>
                                              <li><a href="#tab02">Unread</a></li>
                                              <li><a href="#tab03">Read</a></li>
                                             
                                            </ul>
                                          </div>
                                          <div class="tab-select-outer">
                                            <select id="tab-select">
                                              <option value="#tab01">Tab 1</option>
                                              <option value="#tab02">Tab 2</option>
                                              <option value="#tab03">Tab 3</option>
                                             
                                            </select>
                                          </div>

                                          <div id="tab01" class="tab-contents active">
                                            <div class="row">
                                             <div class="col-md-3">
                                            <p><button onClick="document.getElementById('id01').style.display='block'" style="width:auto;" class="new-message pop-message">New Message</button></p>
                                            </div>
                                             <div class="col-md-9">
                                             <?php $sql_fetch = $this->db->runQuery("select * from impact_message order by message_id desc");
											 foreach($sql_fetch as $row_fetch) {?>
                                             <div class="set" id="set">
                                                 
    <a href="javascipt:void(0);" id="drive">
        <div class="message-sendimage"></div>
      <span class="message-name">Akshay Bhoyar</span>
      <span><i class="fa fa-reply message-reply"></i></span>
      <span class="message-date">15 Nov 2019</span>
      <span><i class="fa fa-plus"></i></span>
    </a>
    <span class="impact-message" id="12">
        <a href="" class="message-delete" id="12" > <i class="fa fa-trash delete-icon"></i></a>
        </span>  
    
    <div class="set_content">
      <p><?=$row_fetch['message']?></p>
    </div>
    
  </div>
  
  <?php } ?>
  
  
  
                                             
                                             </div>
                                             </div>
                                            
                                          </div>
                                          <div id="tab02" class="tab-contents active">
                                          <div class="row">
                                             <div class="col-md-3">
                                            <p><button onClick="document.getElementById('id01').style.display='block'" style="width:auto;" class="new-message">New Message</button></p>
                                            </div>
                                             <div class="col-md-9">
                                             
                                             <div class="set" id="set">
    <a href="#" id="drive">
     <div class="message-sendimage"></div>
      <span class="message-name">Ritesh</span>
      <span><i class="fa fa-reply message-reply"></i></span>
      <span class="message-date">15 Nov 2019</span>
      <span><i class="fa fa-plus"></i></span>
    </a>
    <span class="impact-message">
        <a href="" class="message-delete" id="12"> <i class="fa fa-trash delete-icon"></i></a>
        </span> 
    <div class="set_content">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
    </div>
  </div>
  
  
  
                                             
                                             </div>
                                             </div>
                                          </div>
                                          <div id="tab03" class="tab-contents active">
                                              
                                            <div class="row">
                                             <div class="col-md-3">
                                            <p><button onClick="document.getElementById('id01').style.display='block'" style="width:auto;" class="new-message">New Message</button></p>
                                            </div>
                                             <div class="col-md-9">
                                             
                                             <div class="set" id="set">
    <a href="#" id="drive">
     <div class="message-sendimage"></div>
      <span class="message-name">Chetan</span>
      <span><i class="fa fa-reply message-reply"></i></span>
      <span class="message-date">15 Nov 2019</span>
      <span><i class="fa fa-plus"></i></span>
    </a>
    <span class="impact-message">
        <a href="" class="message-delete" id="12"> <i class="fa fa-trash delete-icon"></i></a>
        </span> 
    <div class="set_content">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
    </div>
  </div>
  
  
  
                                             
                                             </div>
                                             </div>
                                            
                                            
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
          <input type="text" placeholder="To" name="creator_name" id="creator_name" required class="message-input"><br>
           <ul id="searchResultCreator"></ul>
           <input type="hidden" name="creator_id" id="creator_id" value="">
         <textarea id="subject" name="subject" placeholder="Message" style="height:200px" class="message-input"></textarea>
             <button type="button" id="message-submit" class="new-message">Send</button>
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
  $("#creator_name").keyup(function(){

        var search = $(this).val();
       if(search.length>=2) {
        if(search != ""){

            $.ajax({
                url: '<?=BASEPATH?>/ajax/search_message.php',
                type: 'post',
                data: {user_nameCreator:search, type:1},
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
	  else if(subject=="" )
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
                data: {creator_id:creator_id,user:user,subject:subject},
                dataType: 'json',
                success:function(response){
               
                   $("#SuccessMsg").fadeIn().html("Your Message Has Been Sent");
				   $("#creator_name").val("");
				   $("#creator_id").val("");
				   $("#subject").val("");
			       setTimeout(function(){ $("#SuccessMsg").fadeOut(); 
				   $("#id01").hide();
				  // document.getElementById('id01').style.display='none'; 
				   
				   }, 1500);
				   
				   $.ajax({
										dataType: 'html',			
										type: 'GET',cache : false,
										url: '<?=BASEPATH?>/message.php?get_type=load&email_id=<?php echo $email_id; ?>',
										success: function(response){ 
											$('#message-box').html('');
											$('#message-box').html(response);
											settab();
											setAccordion();
											//var valo = $('#hidd_<?php echo $ext; ?>').val();
												//$('#tab<?php echo $ext; ?>').html(valo);
										}});
				
			     // 
			       return false; 

                }
            });
	  
	  }
	  });
	  
	  });
	
	
	</script>
	<script>
     $(document).ready(function(){
  $("#12").click(function(){
    $("#set").remove();
  });
});
 </script>
 
                        <?php
    $html = ob_get_contents();
	   ob_get_clean();
	   return $html;	
  }
  
  
  function impact_tab()
  {
   ob_start();?>
  <div>
                            <h3 class="rs alternate-tab accordion-label">Tiers</h3>
                            <div class="tab-pane accordion-content" style="margin: 33px 0 0 -30px;">
                                <div class="form form-profile">
                                  
                                        <!------ Include the above in your HEAD tag ---------->

                                        <br/><br/>
                                        <div class="tabs">
                                          <div class="tab-button-outer">
                                            <ul id="tab-button">
                                                <li style="border: 1px solid #ddd;">
                                                    <button onClick="document.getElementById('impact1').style.display='block'" style="width:auto;" class="new-message">New Message</button>
                                                </li>
                                                
                                              <li><a href="#tab0111">All</a></li>
                                              <li><a href="#tab0222">Unread</a></li>
                                              <li><a href="#tab0333">Read</a></li>
                                             
                                            </ul>
                                          </div>
                                          <div class="tab-select-outer">
                                            <select id="tab-select">
                                              <option value="#tab0111">Tab 1</option>
                                              <option value="#tab0222">Tab 2</option>
                                              <option value="#tab0333">Tab 3</option>
                                             
                                            </select>
                                          </div>

                                          <div id="tab0111" class="tab-contents active">
                                            <h2 style="text-align: center;font-size: 18px;">From <?= $row_impact->n ?>(Impact)</h2>
                                            <p><button onClick="document.getElementById('impact1').style.display='block'" style="width:auto;" class="new-message">New Messages dfsdf sdfsdfsd f</button></p>
                                          </div>
                                          <div id="tab0222" class="tab-contents">
                                            <h2 style="text-align: center;font-size: 18px;">From <?= $row_impact->n ?>(Impact)</h2>
                                            <p><button onClick="document.getElementById('impact1').style.display='block'" style="width:auto;" class="new-message">New Message sdffds </button></p>
                                          </div>
                                          <div id="tab0333" class="tab-contents">
                                            <h2 style="text-align: center;font-size: 18px;">From <?= $row_impact->n ?>(Impact)</h2>
                                            <p><button onClick="document.getElementById('impact1').style.display='block'" style="width:auto;" class="new-message">New Message sfsdf sdf sdfsdf sdfsdf </button></p>
                                          </div>
                                          
                                        </div>

                                        
                                </div>
                            </div><!--end: .tab-pane -->
                        </div>
                        <?php
    $html = ob_get_contents();
	   ob_get_clean();
	   return $html;	
  
  }




}



?>

