
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
        top:5%;
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
