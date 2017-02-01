
<?php 
    error_reporting(0);    
    include("newNavBar.php");
    include "supplyment/dbAccess.php";
?>
<!--this is a huge script section that controls button operations-->
<script>
function changeContent(classActive){
    $(document).on('click',classActive,function(e) {
        document.getElementById('beauty').className="nav-link disabled";
        document.getElementById('skyscraper').className="nav-link disabled";
        document.getElementById('landscape').className="nav-link disabled";            
        e.preventDefault();       
    });
        
                                
    if(classActive==='#landscape')
    {
        $('.favClass').load("sectionLoad.php?tabClick=landscape #landscapeSection", function(){
            collage();
            document.getElementById('beauty').className="nav-link";
            document.getElementById('skyscraper').className="nav-link";
            document.getElementById('landscape').className="nav-link active";
        });
    }
    else if(classActive==='#beauty')
    {
        $('.favClass').load("sectionLoad.php?tabClick=beauty #beautySection", function(){
            collage();
            document.getElementById('beauty').className="nav-link active";
            document.getElementById('skyscraper').className="nav-link";
            document.getElementById('landscape').className="nav-link";
        });
    }
    else
    {
        $('.favClass').load("sectionLoad.php?tabClick=skyscraper #skyscraperSection", function(){
            collage();
            document.getElementById('beauty').className="nav-link";
            document.getElementById('skyscraper').className="nav-link active";
            document.getElementById('landscape').className="nav-link";
        });
    }
        
}    
</script>
<!--script ends-->

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

<div class="container second" style="text-align: center;">
    <ul class="nav nav-tabs" style="display:inline-block;">
        <li class="nav-item">
            <a class="nav-link" href="#" id="landscape">Landscape</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#/beauty" id="beauty">Beauty</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#/skyscraper" id="skyscraper">Skyscraper</a>
        </li>
    </ul>
</div>


    <div class="favClass">
        <div ng-view></div>
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


