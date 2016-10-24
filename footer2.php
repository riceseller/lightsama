<style>
    .wrapper{
        background-color: black; 
        margin: 0;
        padding: 0;
    }
    
    .foot-part{
        margin:0;
        padding-top: 15px;
        text-align: center;
        color: white;
    }
    .footer-title{
        font-family: arial,sans-serif;
        color: white;
        font-size: 18px;
        font-style: oblique;
        margin: 6px 0 14px 0;
        white-space: nowrap;
        position: relative;
    }
    .footer-list{
        font-family: arial,sans-serif;
        color: #cccccc;
        font-size: 12px;
        margin: 0;
        padding: 0;
        white-space: nowrap;
        position: relative;
        list-style-type:none;
    }
    
    .footer-list a{
        color: #cccccc;
    }
    
    .footer-list a:hover{
        color: #ebf0f0;
    }
    
</style>

<script>
        // load remote page via jquery
        $(document).on('click','.formload',function(event) {
            event.preventDefault();            
            document.getElementById("ttt").innerHTML=$(this).html();
            var modal = $('#modal').modal();
            modal.find('.modal-body').load($(this).attr('href'), function () {
                    modal.show();
                });
        });
</script>

<div class="wrapper container-fluid">
    <div class="row foot-part">
        <h2 class="logo" style="margin:2px;">
            PicShell
        </h2>
        <em>
            The best website for picture indexing
        </em>
    </div>
    <div class="row foot-part" style="margin-top: 20px;margin-bottom: 40px;">
        <div class="col-sm-4">
            <div class="footer-title">
                About Us
            </div>
            <ul class="footer-list">
                <li>
                    <a href="formloadterm.php?iden=picshell" class="formload">What is PicShell</a>
                </li>
                <li>
                    <a href="formloadterm.php?iden=developers" class="formload">Developers</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-4">
            <div class="footer-title">
                Report problems
            </div>
            <ul class="footer-list">
                <li>
                    <a href="formloadterm.php?iden=reportbug" class="formload">Report a bug</a>
                </li>
                <li>
                    <a href="formloadterm.php?iden=recomm" class="formload">Recommmandation</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-4">
            <div class="footer-title">
                Contact Us
            </div>
            <ul class="footer-list">
                <li>Facebook</li>
                <li>Twitter</li>
                <li>
                    <a href="formloadterm.php?iden=contact" class="formload">E-mail</a>
                </li>
                <li>Advertisement</li>
            </ul>
        </div>
    </div>
</div>

<div id="modal" class="modal fade" 
     tabindex="-1" role="dialog" aria-labelledby="plan-info" aria-hidden="true">
    <div class="modal-dialog modal-full-screen">
        <div class="modal-content">
            <div class="modal-header">               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="ttt">Default</h4>
            </div>
            <div class="modal-body">
                <center class="loader m-x-auto"> </center>
            </div>
        </div>
    </div>
</div>