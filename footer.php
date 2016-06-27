<?php
    require_once 'init.php';
?>



<style>
    footer{
        width: 100%;
        height: 100px;
        justify-content: flex-start;
        align-items: center;
        background: black;
        text-decoration: none;
        display: flex;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
     
    }
    
    footer .logo{
        width: 20%;
        height: 140px;
        display: block;
        position: relative;
        order: 1;
        justify-content: center;
        align-items: center;
        text-align: left;
    }
    
    footer .logo p{
        font-size: 25px;
        color: white;
        font-weight: bold;
        line-height: 2.4em;
        font-family: "Proxima Nova", "Helvetica Neue", HelveticaNeue, Helvetica, 
        TeXGyreHeros, FreeSans, "Nimbus Sans L", "Liberation Sans", 
        Arial, sans-serif;
        position: relative;
        padding: 0;
        margin-left: 20px;
    }    
    
    footer .description{
        width: 30%;
        height: 140px;
        display: block;
        position: relative;
        order: 2;
        justify-content: center;
        align-items: center;
        text-align: left;
    }
    
    
    footer .description p.title{
        font-size: 20px;
        font-weight: bold;
        text-transform: uppercase;
        line-height: 1.4em;
        color: white;
        font-family: "Proxima Nova", "Helvetica Neue", HelveticaNeue, Helvetica, 
        TeXGyreHeros, FreeSans, "Nimbus Sans L", "Liberation Sans", 
        Arial, sans-serif;
        position: relative;
    }   
    
    footer .description p.descript{
        font-size:14px;
        line-height: 1.4em;
        color: white;
        font-family: "Proxima Nova", "Helvetica Neue", HelveticaNeue, Helvetica, 
        TeXGyreHeros, FreeSans, "Nimbus Sans L", "Liberation Sans", 
        Arial, sans-serif;
        position: relative;
    }    
    
    footer .link{
        width: 49%;
        height: 140px;
        display: block;
        position: relative;
        order: 3;
        justify-content: center;
        align-items: center;
        text-align: right;
    }
    footer .link button{
        font-size:14px;
        padding: 19px;
        color: white;
        font-family: "Proxima Nova", "Helvetica Neue", HelveticaNeue, Helvetica, 
        TeXGyreHeros, FreeSans, "Nimbus Sans L", "Liberation Sans", 
        Arial, sans-serif;
        position: relative;
        text-decoration: underline;
        background-color: black;
        padding: 2px 6px 2px 6px;
        border-top: 0;
        border-right: 0;
        border-bottom: 0;
        border-left: 0;
        text-align: right;
    }    
    
</style>


<style>
    #abc {     
        width:100%;
        height:100%;
        opacity:.95;
        top:0;
        left:0;
        display:none;
        position:fixed;
        background-color:#313131;
        overflow:auto
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
        top:17%;
        margin-left:-202px;
        font-family:'Raleway',sans-serif
    }
    #abc form {
        width: 500px;
        padding:10px 50px;
        border:2px solid gray;
        border-radius:10px;
        font-family:raleway;
        background-color:#fff
    }
    #abc p {
        margin-top:30px
    }
    #abc h2 {
        background-color:#FEFFED;
        padding:20px 35px;
        margin:-10px -50px;
        text-align:center;
        border-radius:10px 10px 0 0
    }
    #abc hr {
        margin:10px -50px;
        border:0;
        border-top:1px solid #ccc
    }
    #abc input[type=text] {
        width:82%;
        padding:10px;
        margin-top:30px;
        border:1px solid #ccc;
        padding-left:40px;
        font-size:16px;
        font-family:raleway
    }
    #abc #name {
        background-image:url(/media/name.png);
        background-size: contain;
        background-repeat:no-repeat;
        background-position:0px 0px
    }
    #abc #email {
        background-image:url(/media/msg.png);
        background-size: 35px 37.1px;
        background-repeat:no-repeat;
        background-position:0px 0px
    }
    #abc textarea {
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
    #abc #submit {
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
    #abc span {
        color:red;
        font-weight:700
    }
    #abc button {
        width:10%;
        height:45px;
        border-radius:3px;
        background-color:#cd853f;
        color:#fff;
        font-family:'Raleway',sans-serif;
        font-size:18px;
        cursor:pointer
    } 
</style>

<style>
    #abc2 {     
        width:100%;
        height:100%;
        opacity:.95;
        top:0;
        left:0;
        display:none;
        position:fixed;
        background-color:#313131;
        overflow:auto
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
        display:none;
        position:fixed;
        background-color:#313131;
        overflow:auto
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
        top:17%;
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
    // Validating Empty Field
    
    function check_empty() {
        if (document.getElementById('name').value == "" || document.getElementById('email').value == "" || document.getElementById('msg').value == "") {
        alert("Fill All Fields !");
    } else {
        document.getElementById('form').submit();
        alert("Form Submitted Successfully...");
        }
    }
    
    function check_empty2() {
        if (document.getElementById('name2').value == "" || document.getElementById('email2').value == "" || document.getElementById('msg2').value == "") {
        alert("Fill All Fields !");
    } else {
        document.getElementById('form2').submit();
        alert("Form Submitted Successfully...");
        }
    }
   
    //Function To Display Popup
    function div_show() {
        document.getElementById('abc').style.display = "block";
        return true;
    }
    //Function to Hide Popup
    function div_hide(){
        document.getElementById('abc').style.display = "none";
        
         //Function To Display Popup
   
    }
    function div_show2() {
        document.getElementById('abc2').style.display = "block";
        return true;
    }
    function div_hide2(){
        document.getElementById('abc2').style.display = "none";
        
         //Function To Display Popup
   
    }
    
    function div_show3() {
        document.getElementById('abc3').style.display = "block";
        return true;
    }
    function div_hide3(){
        document.getElementById('abc3').style.display = "none";
        
         //Function To Display Popup
   
    }
    
    
    
    
</script>



<footer>
    <div class="logo">
        <p>HAILOINN</p>
    </div>
    <div class="description">
        <p class="title">About</p>
        <p class="descript">photolib is a website for indexing pictures only</p>
    </div>
    <div class="link">
        <br>
        <button onclick="div_show2()">term/privacy</button>
        <br>
        <br>
        <button onclick="div_show()">Report a bug</button>
        <br>
        <br>
        <button onclick="div_show3()">Contact Us</button>
    </div>
</footer>

<div id="abc">
    <!-- Popup Div Starts Here -->
    <div id="popupContact">
    <!-- Contact Us Form -->
        <form action="<?=$us_url_root?>emailresponse.php?purpose=bug" id="form" method="post" name="form">
            <img id="close" src="../media/close.png" onclick ="div_hide()">
            <h2>Report Problem</h2>
            <hr>
            <input id="name" name="name" placeholder="Name" type="text">
            <input id="email" name="email" placeholder="Email" type="text">
            <textarea id="msg" name="message" placeholder="Describe Your Problem"></textarea>
            <a href="javascript:%20check_empty()" id="submit">Send</a>
        </form>
    </div>
<!-- Popup Div Ends Here -->
</div>

<div id="abc2">
    <div id="popupContact">
        <div id="term">
           <img id="close" src="../media/close.png" onclick ="div_hide2()">
            <h2>Term & Privacy</h2>
            <hr>
            <textarea>legal rights preserved</textarea>
        </div>
    </div>
</div>

<div id="abc3">
    <!-- Popup Div Starts Here -->
    <div id="popupContact">
    <!-- Contact Us Form -->
        <form action="<?=$us_url_root?>emailresponse.php?purpose=contact" id="form2" method="post" name="form2">
            <img id="close" src="../media/close.png" onclick ="div_hide3()">
            <h2>Contact Us</h2>
            <hr>
            <input id="name2" name="name" placeholder="Name" type="text">
            <input id="email2" name="email" placeholder="Email" type="text">
            <textarea id="msg2" name="message" placeholder="leave your feedback"></textarea>
            <a href="javascript:%20check_empty2()" id="submit">Send</a>
        </form>
    </div>
<!-- Popup Div Ends Here -->
</div>