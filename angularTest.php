
<?php 
    error_reporting(0);    
    include("newNavBar.php");
    include "supplyment/dbAccess.php";
?>

<!--this is a section that redirects main page to user control screen-->
<script>
    function jumpLink(userId){
        window.location = "/indUser.php?id="+userId;
    }
</script>
<!--section ends-->

<!--this is a section that initiates picture pop-up on the full screen -->
<script>
        // load remote page via jquery
        $(document).on('click','.overlay',function(event) {
            event.preventDefault();            
            var modal = $('#gridSystemModal').modal();
            modal.find('.modal-content').load($(this).attr('href'), function () {
                    //$('.modal-content').css('height',$( window ).height());
                    modal.show();                   
                });
        });
</script>
<!--section ends-->

<div class="jumbotron" style="min-height: calc(80vh);">
    <h1>Link Your Flickr To The Outside World</h1>
    <p><a class="btn btn-primary btn-lg" href="<?=$us_url_root?>users/new_login.php?category=signup" role="button">Get Started</a></p>
</div>

<div class="container first">
    <h2>an indexing of high quality images</h2>
    <p>All images are scrapped from Flickr, 500px and Pixabay. You may connect your Flickr account
            to exchange resources with other sites. We make it faster<br><br><br></p>
</div>
    
<!--page redirection controlling-->
<div class="container second" style="text-align: center;">
    <ul class="nav nav-tabs" style="display:inline-block;">
        <li class="nav-item">
            <a class="nav-link" ng-class="{'active': category === 'landscape'}" href="#/landscape" id="landscape">Landscape</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" ng-class="{'active': category === 'beauty'}" href="#/beauty" id="beauty">Beauty</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" ng-class="{'active': category === 'skyscraper'}" href="#/skyscraper" id="skyscraper">Skyscraper</a>
        </li>
    </ul>
</div>

<!--the portion below is the associated image info-->
<div class="favClass">
    <section class="Collage effect-parent">
        <div ng-repeat="pic in indexResult.list">
            <div class="Image_Wrapper" style="width: {{pic.width}}; height: {{pic.height}}">
                <div class="hovereffecrt">
                    <a style="text-decoration: none" href="#">
                        <img src="https:\/\/drscdn.500px.org\/photo\/183076705\/q%3D80_m%3D2000\/8054abe7df52315d5a48d8f89ddba0e4" width="{{pic.width}}" height="{{pic.height}}">
                    </a>
                    <a class="overlay" href="/indDisplay4.php?pid={{pic.uid}}&url=https:\/\/drscdn.500px.org\/photo\/183076705\/q%3D80_m%3D2000\/8054abe7df52315d5a48d8f89ddba0e4">
                    </a>
                    <div class="overlay_shadow">
                        <h2>{{pic.title}}</h2>
                        <div class="info">
                            <!--<div class="users" onclick="JumpLink({{pic.id}})" style="background-image: url(https://c2.staticflickr.com/{{pic.extraTwo}}/{{pic.extraOne}}/buddyicons/{{pic.userID}}.jpg)">
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
    include "footer2.php";
?>
<?php mysqli_close($conn); ?>

<div id="gridSystemModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modalDialogID">
    <div class="modal-content" id="modalContentID">
      
    </div>
  </div>
</div>

</body>
</html>


