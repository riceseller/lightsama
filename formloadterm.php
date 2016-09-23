<?php
$purpose=$_GET["iden"];
?>

<style>
    .form-control{
        display: block !important;
    }
    
    .developper-div{
        height: 150px;
        width: auto;
    }
    
    .developper-img{
        height: auto;
        float: left;
    }
    
    .circle-img{
        width: 70px;
        height: 70px;
        position: relative;
        overflow: hidden;
        border-radius: 50%;
    }
    
    .circle-img img{
        display: inline;
        margin-left: auto;
        margin-right: 0;
        height: 100%;
        width: auto;
    }
    
    .developper-p p{
        text-align: left;
    }
</style>



<script>
    function metaSubmitClick(purpose, action){
    //$(document).on('click','#submitMeta',function(event){
        //event.preventDefault();
        $('button[id^="formButton"]').prop('disabled', true); //disable all button
        var url="<?=$us_url_root?>emailresponse.php?purpose="+purpose;
        $.ajax({
               type: "POST",
               url: url,
               data: $("#"+action).serialize(), // serializes the form's elements.
               success: function(){
                   //console.log('hide fired via ajax success');
                   $('.modal').modal('hide');
               }
             });

        
    }//});
</script>

<?php if($purpose=='reportbug'||$purpose=='recomm'):?>
<div id="albumModModal">
        <form id="problemSubmit">
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
                <?php if($purpose=='reportbug'):?>
                <label for="exampleTextarea">Report the bug</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Describe the bug that you find" name="message"></textarea>
                <?php else:?>
                <label for="exampleTextarea">Give us your advice</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Type the advice here" name="message"></textarea>
                <?php endif;?>
            </div>
            <button id="formButton" onclick="metaSubmitClick('bug','problemSubmit');" type="button" class="btn btn-primary">Submit</button>            
        </form>
</div>

<?php elseif($purpose=='contact'): ?>
<div id="albumModModal">
        <form id="contactSubmit">
            <div class="form-group">
                <label for="title">Your Name</label>
                <input class="form-control" type="text" name="name" id="Atitle" id="example-text-input" placeholder="Enter Your Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Please leave your message below</label>
                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Leave a Comment Here and we will reply you ASAP" name="message"></textarea>
            </div>
            <button id="formButton" onclick="metaSubmitClick('contact', 'contactSubmit');" type="button" class="btn btn-primary">Submit</button>            
        </form>
</div>

<?php elseif($purpose=='picshell'): ?>
<div id="albumModModal">
    <p>Captain Yu can write something here!</p>
</div>

<?php elseif($purpose=='developers'): ?>
<div id="albumModModal">
    <div class="container">
        <div class="row">
        <div class="developper-img col-sm-2">
            <div class="circle-img">
                <img src="media/icon.png" alt="Bowei Yu" />
            </div>
        </div>
        <div class="developper-p col-sm-10">
            <p>
                blablablaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            </p>
            <br>
        </div>
        </div>
        <div class="row">
        <div class="developper-img col-sm-2">
            <div class="circle-img">
                <img src="media/icon.png" alt="Yichen cheng" />
            </div>
        </div>
        <div class="developper-p col-sm-10">
            <p>
                blablablaaaa<br>
                aaaaaaaaa<br>
                aaaaaaaaaa<br>
                aaaaaaaaa
            </p>
            <br>
        </div>
        </div>
        <div class="row">
        <div class="developper-img col-sm-2">
            <div class="circle-img">
                <img src="media/icon.png" alt="Wenqian Zhao" />
            </div>
        </div>
        <div class="developper-p col-sm-10">
            <p>
                blablablaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
            </p>
            <br>
        </div>
        </div>
    </div>
    
</div>

<?php else:?>
<div id="albumModModal">
    <p>let me see if there is something printed on the form</p>
</div>

<?php endif; ?>