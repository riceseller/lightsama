<?php
$purpose=$_GET["iden"];
?>





<script>
    function metaSubmitClick(action){
    //$(document).on('click','#submitMeta',function(event){
        //event.preventDefault();
        $('button[id^="formButton"]').prop('disabled', true); //disable all button 
        document.getElementById(action).submit();             //submit the form to emailresponse

        $('.modal').modal('hide');                            //hide modal content
             
        return true; // avoid to execute the actual submit of the form.
    }//});
</script>

<?php if($purpose=='problem'):?>
<div id="albumModModal">
        <form id="problemSubmit" action="<?=$us_url_root?>emailresponse.php?purpose=contact" method="post">
            <div class="form-group">
                <label for="title">Your Name</label>
                <input class="form-control" type="text" name="name" id="Atitle" id="example-text-input" placeholder="Enter Your Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your Email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Describe your problem</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Type the Problem Encountered" name="message"></textarea>
            </div>
            <button id="formButton" onclick="metaSubmitClick('problemSubmit');" type="button" class="btn btn-primary">Submit</button>            
        </form>
</div>

<?php elseif($purpose=='contact'): ?>
<div id="contactSubmit" action="<?=$us_url_root?>emailresponse.php?purpose=contact">
        <form id="modAlbum">
            <div class="form-group">
                <label for="title">Your Name</label>
                <input class="form-control" type="text" name="Atitle" id="Atitle" id="example-text-input">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Please leave your message below</label>
                <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
            </div>
            <button id="formButton" onclick="metaSubmitClick('contactSubmit');" type="button" class="btn btn-primary">Submit</button>            
        </form>
</div>


<?php endif; ?>