<div class="col-md-12 phone" style="    padding: 0 0 0 0;">
    <div class="col-md-12" style="background-color:#3a9cb5;">
              <h2>For Whom?</h2>
          </div>
         <div class="container">
          
             <div class="col-md-6  podcasters" >

          <ul >
              <li style="margin-top: 0px;"><a href="#" id="pod" onMouseOver="mouseOverPodcasters()">Video Creators</a></li>
              <li><a href="#" id="vid" onMouseOver="mouseOverVideoCreators()">Music Producers</a></li>
              <li><a href="#" id="mus" onMouseOver="mouseOverMusicians()">Choreographers</a></li>
              <li><a href="#" id="vis" onMouseOver="mouseOverVisualArtists()">Writers</a></li>
              <li><a href="#" id="com" onMouseOver="mouseOverCommunities()">Visual Artists</a></li>
              <li><a href="#" id="wri" onMouseOver="mouseOverWriters()">Community Admins</a></li>
              <li><a href="#" id="cre" onMouseOver="mouseOverCreators()">Content Creators</a></li>

          </ul>
  </div>
            <div class="col-md-6 podcasters" >
              <img id="pic" src="images/video-creators.jpg"  alt="">
            </div>
        
       
        </div >
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript">
            var timeoutID = setTimeout(function() {
                  $('#pod').trigger('onmouseover');
                }, 3000);
            function mouseOverPodcasters(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#vid').trigger('onmouseover');
                }, 3000);
                document.getElementById("pic").src='images/video-creators.jpg'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverVideoCreators(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#mus').trigger('onmouseover');
                }, 3000);
                document.getElementById("pic").src='images/musicians.jpg'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }

            function mouseOverMusicians(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#vis').trigger('onmouseover');
                }, 3000);
                document.getElementById("pic").src='images/choreographers.jpg'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverVisualArtists(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#com').trigger('onmouseover');
                }, 3000);
                document.getElementById("pic").src='images/writers.jpg'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverCommunities(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#wri').trigger('onmouseover');
                }, 3000);
                document.getElementById("pic").src='images/visual-artists.jpg'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverWriters(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#cre').trigger('onmouseover');
                }, 3000);
                document.getElementById("pic").src='images/community-admins.jpg'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverCreators(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#pod').trigger('onmouseover');
                }, 3000);
                document.getElementById("pic").src='images/content-creators.jpg'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
        </script>

    </div>