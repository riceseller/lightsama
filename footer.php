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




<style>
    #abc {     
        width:100%;
        height:200vh;
        opacity:.95;
        top:0;
        left:0;
        display:block;
        position:fixed;
        background-color:#313131;
        overflow:auto;
        z-index: 100;
    }
    #abc #close {
        position:absolute;
        right:-14px;
        top:-14px;
        cursor:pointer
    }
    #abc #popupContact {
        position:absolute;  
        left:50%;
        top:5%;
        margin-left:-202px;
        font-family:'Raleway',sans-serif
    }
    #abc #popupContact form {
        width: 500px !important;
        padding:10px 50px !important;
        border:2px solid gray !important;
        border-radius:10px !important;
        font-family:raleway !important;
        background-color:#fff !important
    }
    #abc #popupContact p {
        margin-top:30px !important
    }
    #abc #popupContact h2 {
        background-color:#FEFFED !important;
        padding:20px 35px !important;
        margin:-10px -50px !important;
        text-align:center !important;
        border-radius:10px 10px 0 0 !important
    }
    #abc #popupContact hr {
        margin:10px -50px !important;
        border:0 !important;
        border-top:1px solid #ccc !important
    }
    #abc #popupContact input[type=text] {
        width:82% !important;
        padding:10px !important;
        margin-top:30px !important;
        border:1px solid #ccc !important;
        padding-left:40px !important;
        font-size:16px !important;
        font-family:raleway !important
    }
    #abc #popupContact #name {
        background-image:url(/media/name.png);
        background-size: contain !important;
        background-repeat:no-repeat !important;
        background-position:0px 0px !important;
    }
    #abc #popupContact #email {
        background-image:url(/media/msg.png);
        background-size: 35px 37.1px !important;
        background-repeat:no-repeat !important;
        background-position:0px 0px !important
    }
    #abc #popupContact textarea {
        background-image:url(/media/email.png);
        background-size: 37px 37px !important;
        background-repeat:no-repeat !important;
        background-position:0px 0px !important;
        width:82% !important;
        height:95px !important;
        padding:10px !important;
        resize:none !important;
        margin-top:30px !important;
        border:1px solid #ccc !important;
        padding-left:40px !important;
        font-size:16px !important;
        font-family:raleway !important;
        margin-bottom:30px !important
    }
    #abc #popupContact #submit {
        text-decoration:none !important;
        width:100% !important;
        text-align:center !important;
        display:block !important;
        background-color:#FFBC00 !important;
        color:#fff !important;
        border:1px solid #FFCB00 !important;
        padding:10px 0 !important;
        font-size:20px !important;
        cursor:pointer !important;
        border-radius:5px !important
    }
    #abc #popupContact span {
        color:red !important;
        font-weight:700 !important
    }
    #abc #popupContact button {
        width:10%! important;
        height:45px !important;
        border-radius:3px !important;
        background-color:#cd853f !important;
        color:#fff !important;
        font-family:'Raleway',sans-serif !important;
        font-size:18px !important;
        cursor:pointer !important
    } 
</style>
<style>
    #abc2 {     
        width:100%;
        height:100%;
        opacity:.95;
        top:0;
        left:0;
        display:block;
        position:fixed;
        background-color:#313131;
        overflow:auto;
        z-index: 100;
    }   
    #abc2 #close {
        position:absolute;
        right:-14px;
        top:-14px;
        cursor:pointer
    }
    #abc2 #popupContact {
        position:absolute;  
        left:50%;
        top:17%;
        margin-left:-202px;
        font-family:'Raleway',sans-serif
    }
    #abc2 #term {
        width:300px;
        width:250px;
        padding:10px 50px;
        border:2px solid gray;
        border-radius:10px;
        font-family:raleway;
        background-color:#fff
    }
    #abc2 h2 {
        background-color:#FEFFED;
        padding:20px 35px;
        margin:-10px -50px;
        text-align:center;
        border-radius:10px 10px 0 0
    }
    #abc2 hr {
        margin:10px -50px;
        border:0;
        border-top:1px solid #ccc
    }
    #abc2 textarea {
        background-size: 37px 37px;
        background-repeat:no-repeat;
        background-position:0px 0px;
        width:82%;
        height:95px;
        padding:10px;
        resize:none;
        border:none;
        font-family:raleway;
    }
</style>
<style>
    #abc3 {     
        width:100%;
        height:100%;
        opacity:.95;
        top:0;
        left:0;
        display:block;
        position:fixed;
        background-color:#313131;
        overflow:auto;
        z-index: 100;
    }
    #abc3 #close {
        position:absolute;
        right:-14px;
        top:-14px;
        cursor:pointer
    }
    #abc3 #popupContact {
        position:absolute;  
        left:50%;
        top:5%;
        margin-left:-202px;
        font-family:'Raleway',sans-serif
    }
    #abc3 form {
        width: 500px;
        padding:10px 50px;
        border:2px solid gray;
        border-radius:10px;
        font-family:raleway;
        background-color:#fff
    }
    #abc3 p {
        margin-top:30px
    }
    #abc3 h2 {
        background-color:#FEFFED;
        padding:20px 35px;
        margin:-10px -50px;
        text-align:center;
        border-radius:10px 10px 0 0
    }
    #abc3 hr {
        margin:10px -50px;
        border:0;
        border-top:1px solid #ccc
    }
    #abc3 input[type=text] {
        width:82%;
        padding:10px;
        margin-top:30px;
        border:1px solid #ccc;
        padding-left:40px;
        font-size:16px;
        font-family:raleway
    }
    #abc3 #name2 {
        background-image:url(/media/name.png);
        background-size: contain;
        background-repeat:no-repeat;
        background-position:0px 0px
    }
    #abc3 #email2 {
        background-image:url(/media/msg.png);
        background-size: 35px 37.1px;
        background-repeat:no-repeat;
        background-position:0px 0px
    }
    #abc3 textarea {
        background-image:url(/media/email.png);
        background-size: 37px 37px;
        background-repeat:no-repeat;
        background-position:0px 0px;
        width:82%;
        height:95px;
        padding:10px;
        resize:none;
        margin-top:30px;
        border:1px solid #ccc;
        padding-left:40px;
        font-size:16px;
        font-family:raleway;
        margin-bottom:30px
    }
    #abc3 #submit {
        text-decoration:none;
        width:100%;
        text-align:center;
        display:block;
        background-color:#FFBC00;
        color:#fff;
        border:1px solid #FFCB00;
        padding:10px 0;
        font-size:20px;
        cursor:pointer;
        border-radius:5px
    }
    #abc3 span {
        color:red;
        font-weight:700
    }
    #abc3 button {
        width:10%;
        height:45px;
        border-radius:3px;
        background-color:#cd853f;
        color:#fff;
        font-family:'Raleway',sans-serif;
        font-size:18px;
        cursor:pointer;
    } 
</style>




<script>
    function FormLoad(value){
        $.ajax({
                type: 'GET',
                url: 'FavWrite.php',
                data: 'current_request=' + value,
                success: function(result){
                    result = result.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">");               
                    document.getElementById('topwrap').innerHTML+=result;
                }
            });
    }
    function div_hide(){
        var element = document.getElementById("abc");
        element.parentNode.removeChild(element);
    }
    function div_hide2(){
        var element = document.getElementById("abc2");
        element.parentNode.removeChild(element);
    }
    function div_hide3(){
        var element = document.getElementById("abc3");
        element.parentNode.removeChild(element);
    }
</script>

<div class="wrapper">
        <div class="fifth">
            <div class="logo">
                <h3>HAILOINN</h3>
            </div>
            <div class="despwrap">
                <h4>About</h4>
                <p>Hailoinn is a website for picture indexing only</p>
            </div> 
            <div class="formwrap">
                <a href="#" onclick="FormLoad('term')">term/privacy</a><br><br>
                <a href="#" onclick="FormLoad('problem')">report a problem</a><br><br>
                <a href="#" onclick="FormLoad('contact')">contact us</a>           
            </div>
        </div> 
</div>