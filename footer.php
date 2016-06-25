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
    
    #abc {     //this is pop-up whole cover
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
        <a>Report a bug</a>
    </div>
</footer>
