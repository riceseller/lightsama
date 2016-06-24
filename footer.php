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
        padding: 30px;
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

<footer>
    <div class="logo">
        <p>PHOTOLIB</p>
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
