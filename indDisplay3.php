<?php
    $url=$_GET["url"];
?>


    <div class="modal-header">               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="picTitle" style="text-align:center;">picture title put here</h4>
    </div>
    <div class="container-fluid">
        <div class="col-md-9">
            <img class="img-fluid" src="<?php echo $url; ?>" style="max-width: 100%; height: auto;"/>
        </div>
        <div class="col-md-3">
            <div class="row userInfo"><p>this portion puts user info including userpic, username and upload time</p></div>
            <div class="row picViewerInfo">
                <div class="col-md-4"><p>no. views</p></div>
                <div class="col-md-4"><p>no. favs</p></div>
                <div class="col-md-4"><p>no. comments</p></div>
            </div>
            <div class="row commentDisplay">
                <p>this is a whole portion that puts comments as ul lists including comment submission and comment sync button</p>
            </div>           
            <div class="row exifFirstLine">
                <div class="col-md-9"><p>CameraPic</p></div>
                <div class="col-md-3"><p>CameraDesp</p></div>
            </div>
            <div class="row exifSecondLine">
                <div class="col-md-6"><p>Aperture</p></div>
                <div class="col-md-6"><p>Exposure</p></div>
            </div>
            <div class="row exifThirdLine">
                <div class="col-md-6"><p>Focal</p></div>
                <div class="col-md-6"><p>Iso</p></div>
            </div>           
        </div>
    </div>

