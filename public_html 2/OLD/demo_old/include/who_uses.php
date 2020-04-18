<div class="col-md-12 phone">
         <div style="padding: 0px;" class="container">
          <h2>Who uses ImpactMe</h2>
             <div class="col-md-6  podcasters" >

          <ul >
              <li><a href="#" id="pod" onMouseOver="mouseOverPodcasters()">Podcasters</a></li>
              <li><a href="#" id="vid" onMouseOver="mouseOverVideoCreators()">Video Creators</a></li>
              <li><a href="#" id="mus" onMouseOver="mouseOverMusicians()">Musicians</a></li>
              <li><a href="#" id="vis" onMouseOver="mouseOverVisualArtists()">Visual Artists</a></li>
              <li><a href="#" id="com" onMouseOver="mouseOverCommunities()">Communities</a></li>
              <li><a href="#" id="wri" onMouseOver="mouseOverWriters()">Writers & Journalists</a></li>
              <li><a href="#" id="cre" onMouseOver="mouseOverCreators()">Creators-of-all-kinds</a></li>

          </ul>
  </div>
            <div class="col-md-6" >
              <img id="pic" src="images/post3.png"  alt="">
            </div>
        
       
        </div >
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript">
            var timeoutID = setTimeout(function() {
                  $('#pod').trigger('onmouseover');
                }, 400);
            function mouseOverPodcasters(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#pod').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post2.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverVideoCreators(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#vid').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post3.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }

            function mouseOverMusicians(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#mus').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post4.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverVisualArtists(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#vis').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post5.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverCommunities(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#com').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post6.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverWriters(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#wri').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post7.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverCreators(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#cre').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post8.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
        </script>

    </div>