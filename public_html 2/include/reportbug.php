<?php if (isset($_SESSION['is_user_login']) and $_SESSION['is_user_login'] == 1){ ?>

<div class="support">
	<div class="join_btn support-launcher" id="support-launcher">
		<div class="open-icon">
			<span class="material-icons">headset_mic</span>
		</div>

		<div class="close-icon">
			<span class="material-icons">close</span>
		</div>
		<div class="support-click-area" onclick="document.getElementById('support-launcher').classList.toggle('sup-active'); document.getElementById('support-body').classList.toggle('sup-active');">
		</div>
	</div>

	<div class="support-body card" id="support-body">
		<div class="card-header shadow-sm rounded" style="color: #fff;background: #3a9cb5; padding:15px;">
			<h4 style="margin:0;">Submit a request</h4>
		</div>
		<div class="card-body" style="color: #455058; height:400px; overflow:scroll;"> <!--style="
		    background: #fff;
		    height: 300px;
		    padding: 15px;
		    overflow: scroll;"-->
		    <form method="post" enctype="multipart/form-data" name="query_form" id="query_form">
		    	<br>
		    	<div class="form-group">
		    		<label for="sup_request_type"><small>Please select a request type</small></label>
		    		<select class="form-control" id="sup_request_type" name="query_type" required>
		    			<option value="0" selected>I want to report a bug or error</option>
		    			<option value="1">I have a question about ImpactMe</option>
		    			<option value="2">I want to report a user or post</option>
		    			<option value="3">I have a trust and safety related question regarding my account</option>
		    			<option value="4">Other</option>
		    		</select>
		    	</div>
		    	<br>
		    	<!--div class="form-group">
		    		<label for="sup_email"><small>Email address associated with your ImpactMe account</small></label>
		    		<input type="email" class="form-control" id="sup_email" name="email_id" required/>
		    	</div-->
		    	<br>
		    	<small>Attach image or video to help us understand your issue better (optional)</small>
		    	<div class="custom-file">
		    		<label class="custom-file-label" for="sup_attachment"><small id="sup_attachment_filename">Attach image or video</small></label>
		    		<input class="custom-file-input" type="file" accept="image/*, video/*" name="sup_attachment" id="sup_attachment"/>		    		
		    	</div>
		    	<br>
		    	<br>
		    	<div class="form-group">
		    		<label for="sup_device_type"><small>Device type</small></label>
		    		<select class="form-control" id="sup_device_type" name="device_type" required>
		    			<option value="0" selected>Desktop</option>
		    			<option value="1">Mobile browser (Android)</option>
		    			<option value="2">Mobile browser (Apple)</option>
		    		</select>
		    	</div>
		    	<br>
		    	<div class="form-group">
		    		<label for="sup_description"><small>Description</small></label>
		    		<textarea class="form-control" id="sup_description" rows=5 name="description" required></textarea>
		    	</div>
		    	<br>
		    	<button class="join_btn" id='support-query-submit'>Submit</button>

		    </form>

		    <div id="request-sending" style="
			    position: fixed;
			    top: inherit;
			    left: 0;
			    bottom:0;
			    height: inherit;
			    width: 100%;
			    background: rgba(255,255,255,0.8);
			    z-index: 10000;
			    display: none;
			">
				<div class="spinner-border" role="status" style="
				    position: absolute;
				    margin: auto;
				    top: 0;
				    left: 0;
				    right: 0;
				    bottom: 0;
				"></div>
			</div>
			<div id="request-sent" style="position:fixed;width: 100%;height: inherit;background: #fff;top: inherit;left: 0; bottom:0; z-index: 10;display: none;align-items: center;">
				<div style="text-align: center; padding: 20px;">
					<h5>Your request has been submitted. We will respond to you as fast as we can on the email provided.</h5>
					<small id="request-token"></small>
					<button id="another-request-btn" class="join_btn">Submit another request</button>
				</div>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript" src="<?=BASEPATH?>/js/jquery-1.9.1.min.js"></script>
<script src="<?=BASEPATH?>/image_upload_js/jquery.form.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
/*$(document).on('change', '#sup_attachment', function (event) {
    $(this).next('.custom-file-label').next('small').html(event.target.files[0].name);
});*/
$('#sup_attachment').on('change', function (event) {
	console.log(event.target.files[0].name);
	$('#sup_attachment_filename').text(event.target.files[0].name);
});

$('#query_form').on('submit', function (e) {
	e.preventDefault();
	$.ajax({
		url: '<?=BASEPATH?>/ajax/reportbug_submit.php',
		data: new FormData(this),
		cache: false,
		type: 'post',
		processData: false,
		contentType: false,
		beforeSend: function () {
			$('#request-sending').show();
		},
		success: function (html, statusText, xhr, $form) {
			obj = $.parseJSON(html);
			$('#request-sending').hide();
			$('#request-sent').css("display", "flex");
			$('#request-token').text("Your request token is #"+obj.token);
		},
		complete: function(xhr){
			console.log("complete");
			$('#query_form')[0].reset();
		}
	});
});

$('#another-request-btn').on('click', function () {
	$('#request-sent').css("display", "none");
});
</script>

<script> </script>
<?php } ?>