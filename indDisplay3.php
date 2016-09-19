<?php
$pid=$_GET["pid"];
?>

<style>
    .form-control{
        display: block !important;
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

<div id="albumModModal">
    <p>let me see if there is something printed on the form</p>
</div>

