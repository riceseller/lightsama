<style>
        .wrapper{
            background-color: black; 
            margin: 0;
            padding: 0;
        }
        .fifth{
            order:10;
            display: flex;
            justify-content: center;
            flex-flow: row wrap;
            margin: 0 auto;
            padding: 20px 0;
            word-wrap: break-word;
        }
        .wrapper .logo{
            margin:auto;
        }
        .wrapper h3{           
            color: white;
            font-size: 30px;
        }
        .wrapper .despwrap{
            margin:auto;
        }
        .wrapper .despwrap h4{
            color: white;
            font-size: 25px;
            text-align: center;
        }
        .wrapper .despwrap p{
            color: white;
            font-size: 20px;
            margin-left: 0;
        }
        .wrapper .formwrap{
            margin:auto;
            text-align: center;
        }
        .wrapper .formwrap a{
            color: white;
            font-size: 15px;
            margin-right: 0;           
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




<div class="wrapper">
        <div class="fifth">
            <div class="logo">
                <h3>PicShell</h3>
            </div>
            <div class="despwrap">
                <h4>About</h4>
                <p>PicShell is a website for picture indexing only</p>
            </div> 
            <div class="formwrap">
                <a href="formloadterm.php?iden=term" class="formload">term and privacy</a><br><br>
                <a href="formloadterm.php?iden=problem" class="formload">report a problem</a><br><br>
                <a href="formloadterm.php?iden=contact" class="formload">contact us</a>           
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