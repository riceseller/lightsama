<style>
    footer{
        width: 100%;
        height: 150px;
        justify-content: flex-start;
        align-items: center;
        background: black;
        text-decoration: none;
        display: flex;
        position: relative;
        order: 20;
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
        text-align: center;
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
        width: 47%;
        height: 140px;
        display: block;
        position: relative;
        order: 3;
        justify-content: center;
        align-items: center;
        text-align: right;
    }
    footer .link a{
        font-size:14px;
        padding: 19px;
        color: white;
        font-family: "Proxima Nova", "Helvetica Neue", HelveticaNeue, Helvetica, 
        TeXGyreHeros, FreeSans, "Nimbus Sans L", "Liberation Sans", 
        Arial, sans-serif;
        position: relative;
        text-decoration: underline;
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
    #abc img #close {
        position:absolute;
        right:-14px;
        top:-14px;
        cursor:pointer
    }
    #abc div #popupContact {
        position:absolute;  
        left:50%;
        top:17%;
        margin-left:-202px;
        font-family:'Raleway',sans-serif
    }
    #abc form {
        max-width:300px;
        min-width:250px;
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
        background-image:url(../images/name.jpg);
        background-repeat:no-repeat;
        background-position:5px 7px
    }
    #abc #email {
        background-image:url(../images/email.png);
        background-repeat:no-repeat;
        background-position:5px 7px
    }
    #abc textarea {
        background-image:url(../images/msg.png);
        background-repeat:no-repeat;
        background-position:5px 7px;
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
    //Function To Display Popup
    function div_show() {
        document.getElementById('abc').style.display = "block";
        return true;
    }
    //Function to Hide Popup
    function div_hide(){
        document.getElementById('abc').style.display = "none";
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
        <a>term/privacy</a>
        <br>
        <br>
        <a onclick="return div_show()">Report a bug</a>
    </div>
</footer>

<div id="abc">
<!-- Popup Div Starts Here -->
<div id="popupContact">
<!-- Contact Us Form -->
<form action="#" id="form" method="post" name="form">
<img id="close" src="images/3.png" onclick ="div_hide()">
<h2>Contact Us</h2>
<hr>
<input id="name" name="name" placeholder="Name" type="text">
<input id="email" name="email" placeholder="Email" type="text">
<textarea id="msg" name="message" placeholder="Message"></textarea>
<a href="javascript:%20check_empty()" id="submit">Send</a>
</form>
</div>
<!-- Popup Div Ends Here -->
</div>
