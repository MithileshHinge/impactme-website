 
 
 $(".comment").keypress(function (e) {
								  
    if(e.which == 13 && !e.shiftKey) {  
	var id = e.target.id;   //get form ID
	
    id = id.match(/\[(.*?)\]/)[1];
   // console.log(post_id);
   var str = $("#frm-comment"+id).serialize();
   str = str.replace(/\+/g, '%20');
    if(decodeURIComponent(str.split("&", 2)[0].split("=", 2)[1]).replace(/^\s+|\s+$/g, '') != ""){
     listComment(id);
	//
      form_submit(id);
        e.preventDefault();
        return false;
    }
    }
});
 
function	post_like(id,uid)
  {
     $.ajax({
                    url: path_name+"include/comment_delete.php",
                     data: {post_like_id:id,user_id :uid},
                    type: 'post',
					 dataType: 'json',
                    success: function (response)
                    {
						//listComment(post_id);
						
						$("#postLikeText"+id).html(response);
                     
                    }
                });
  }
	
 
           function postReply(commentId,post_id,fname, user_id) {
			   //comment_reply
			   if($('.rep').length == 0) { 
			   $('#comment_reply'+commentId).append('<form id="frm-comment'+post_id+'"  method="post" action="" onSubmit="form_submit('+post_id+'); return false;" class="rep"><div class="media comment-item"><div class="media-body"><div class="input-row"><input class="comment2 input-field comm'+post_id+'" type="text" name="comment" id="comment['+post_id+']" placeholder="Add a Comment"></div></div></div><input  type="hidden" name="name" id="name'+post_id+'" value="'+fname+'" /><input  type="hidden" name="user_id" id="user_id'+post_id+'" value="'+user_id+'" /><input  type="hidden" name="post_id" id="post_id'+post_id+'" value="'+post_id+'" class="post_id" /><input type="hidden" name="comment_id" id="commentId'+post_id+'" placeholder="Name" value="'+commentId+'" /> </form>');
                $('#commentId'+post_id).val(commentId);
                $(".comm"+post_id).focus();
			   }
			    else
				{
				   $('.rep').remove();	
				}
            }

           function postDelete(commentId,post_id) {
                $.ajax({
                    url: path_name+"include/comment_delete.php",
                     data: {comment_id:commentId},
                    type: 'post',
                    success: function (response)
                    {
						listComment(post_id);
                     
                    }
                });
            }
			
			function postLike(commentId,post_id) {
                $.ajax({
                    url: path_name+"include/comment_delete.php",
                     data: {comment_like_id:commentId},
                    type: 'post',
                    success: function (response)
                    {
						listComment(post_id);
                     
                    }
                });
            }
			
			
			
			function form_submit(post_id) {
           						
			//alert(post_id);
            	   $("#comment-message"+post_id).css('display', 'none');
                   var str = $("#frm-comment"+post_id).serialize();

                $.ajax({
                    url: path_name+"include/comment_add.php",
                    data: str,
                    type: 'post',
                    success: function (response)
                    {
                        var result = eval('(' + response + ')');
                        if (response)
                        {
							// $("#comment-message"+post_id).fadeIn().html("Comments Added Successfully");
                            setTimeout(function(){ $("#comment-message"+post_id).fadeOut(); }, 3000);
	   
                        	//$("#comment-message"+post_id).css('display', 'inline-block');
                           // $("#name").val("");
						  $(".com"+post_id).val("");
                            $("#commentId"+post_id).val("");
                     	   listComment(post_id);
                        } else
                        {
                            alert("Failed to add comments !");
                            return false;
                        }
                    }
                });
            }
			
			
			 $(document).ready(function() {
             $('.post_id').each(function(){
						
				listComment(this.value);		
						
										 });
         });

            function listComment(post_id) {
				//alert(post_id);
                $.post(path_name+"include/comment_list_details.php?post_id="+post_id,
                        function (data) {
							
                               var data = JSON.parse(data);
                      
                            var comments = "";
							var comments1 = "";
							var comments2 = "";
							var icon = "";
							var no_of_like = "";
                            var replies = "";
                            var item = "";
                            var parent = -1;
                            var results = new Array();

                            var list = $("<ul class='outer-comment'>");
                            var item = $("<li>").html(comments);

                            for (var i = 0; (i < data.length); i++)
                            {
                                var commentId = data[i]['comment_id'];
                                parent = data[i]['parent_comment_id'];

                                if (parent == "0")
                                {
									if(data[i]['delete']==1) { 
									
									comments1 ="<a class='btn-reply fc-gray be-fc-orange'  onClick='postDelete(" + commentId + " , "+ post_id +")' title='Delete'><i class='fa fa-trash'></i> Delete</a> "; 
									} 
									else
									comments1 =""; 
									
									if(data[i]['no_of_like']>0) { 
									 no_of_like = data[i]['no_of_like'];
									}
									else
									 no_of_like="";
									
									if(data[i]['my_like']>0) { 
									icon = "<i class='fa fa-heart'></i>";
									}
									else
									 icon = "<i class='fa fa-heart-o'></i>";
									var fname = data[i]['user_name'];
                                    comments = "<div class='comment-row'>"+
                                    
									"<div class='media comment-item' id='comment_reply"+commentId+"'><a href='#' class='thumb-left1'><img src='" + data[i]['image'] + "'></a>"+
									"<div class='media-body'><h4 class='rs comment-author'><a href='#' class='be-fc-orange fw-b'>"+data[i]['comment_sender_name']+"</a><span class='fc_comment_time'> "+data[i]['date']+" </span></h4><p class='rs comment-content'>"+data[i]['comment']+"</p><p class='rs reply-post'><a class='btn-reply fc-gray be-fc-orange'  onClick='postReply(" + commentId + " , "+ post_id +", \""+fname+"\", "+data[i]['user_id']+" )' title='Reply'><i class='fa fa-reply'></i> Reply</a>"+ comments1 + "<a class='btn-reply fc-gray be-fc-orange'  onClick='postLike(" + commentId + " , "+ post_id +")' title='Like/Dislike'>"+icon+" "+no_of_like+"</a> </p></div>"+
									
                                    "</div>";

                                    var item = $("<li>").html(comments);
                                    list.append(item);
                                    var reply_list = $('<ul>');
                                    item.append(reply_list);
                                    listReplies(commentId, data, reply_list,post_id);
                                }
                            }
							     // alert(list);
                            $("#output"+post_id).html(list);
                        });
            }

            function listReplies(commentId, data, list,post_id) {
				// data.length
				var len_reply = data.length;
				
                for (var i = 0; (i < len_reply ); i++)
                {
                    if (commentId == data[i].parent_comment_id)
                    {
						if(data[i]['delete']==1) { 
									
									comments1 ="<a class='btn-reply fc-gray be-fc-orange'  onClick='postDelete(" + data[i]['comment_id'] + " , "+ post_id +")' title='Delete'><i class='fa fa-trash'></i> Delete</a> "; 
									} 
									else
									comments1 =""; 
									
									if(data[i]['no_of_like']>0) { 
									 no_of_like = data[i]['no_of_like'];
									}
									else
									 no_of_like="";
									
									if(data[i]['my_like']>0) { 
									icon = "<i class='fa fa-heart'></i>";
									}
									else
									 icon = "<i class='fa fa-heart-o'></i>";
									 
								var fname = data[i]['user_name'];	 
                        var comments = "<div class='comment-row'>"+
                       
                        "<div class='media comment-item' id='comment_reply"+data[i]['comment_id']+"'><a href='#' class='thumb-left1'><img src='" + data[i]['image'] + "'></a>"+
						"<div class='media-body'><h4 class='rs comment-author'><a href='#' class='be-fc-orange fw-b'>"+data[i]['comment_sender_name']+"</a><span class='fc_comment_time'> "+data[i]['date']+" </span></h4><p class='rs comment-content'>"+data[i]['comment']+"</p><p class='rs reply-post'><a class='btn-reply fc-gray be-fc-orange' onClick='postReply(" + data[i]['comment_id'] + " , "+ post_id +", \""+fname+"\", "+data[i]['user_id']+" )' ><i class='fa fa-reply'></i> Reply</a>"+ comments1 + "<a class='btn-reply fc-gray be-fc-orange'  onClick='postLike(" + data[i]['comment_id'] + " , "+ post_id +")' title='Like/Dislike'>"+icon+" "+no_of_like+"</a>  </p></div>"+
                        "</div>";
                        var item = $("<li>").html(comments);
                        var reply_list = $('<ul>');
						// Change 
						//if(i<=10) {
                        list.append(item); //}
                        item.append(reply_list);
                        listReplies(data[i].comment_id, data, reply_list,post_id);
                    }
                }
				
            }