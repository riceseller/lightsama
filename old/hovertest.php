<style>
@font-face{
    font-family:'FontAwesome';
    src:url('../fonts/fontawesome-webfont.eot?v=4.2.0');
    src:url('../fonts/fontawesome-webfont.eot?#iefix&v=4.2.0') format('embedded-opentype'),url('../fonts/fontawesome-webfont.woff?v=4.2.0') format('woff'),url('../fonts/fontawesome-webfont.ttf?v=4.2.0') format('truetype'),url('../fonts/fontawesome-webfont.svg?v=4.2.0#fontawesomeregular') format('svg');font-weight:normal;font-style:normal}
figcaption,figure {
    display:block;
}
.grid *, .grid *:after, .grid *:before { 
    -webkit-box-sizing: border-box; 
    box-sizing: border-box; 
}
/* Common style */
.grid figure {
	position: relative;
	overflow: hidden;
	width: auto;
	height: auto;
}
.grid figure .comment-box{
	position: relative;
	display: block;
	width: 350px;
        height: 200px;
        background: yellow;
}
.grid figure figcaption {
	padding: 2em;
	color: #fff;
	backface-visibility: hidden;
}
.grid figure figcaption,
.grid figure figcaption > a {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

/* Anchor will cover the whole item by default */
/* For some effects it will show as a button */
.grid figure figcaption > a {
	text-indent: 200%;
	white-space: nowrap;
	font-size: 0;
	opacity: 0;
}
.grid figure p {
	margin: 0;
}
figure.reply-delete {
	background: #FFF94C;      
	text-align: left;
}
figure.reply-delete:hover .comment-box {
	opacity: 0.5;
}
figure.reply-delete figcaption {
	z-index: 1;
}
figure.reply-delete p {
	padding: 0;
        position: absolute;
        top: 2px;
        right: 0;
	font-weight: 600;	
	font-size: 100%;
	line-height: 1.5em;
	opacity: 0;
	-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
	transition: opacity 0.35s, transform 0.35s;
	-webkit-transform: translate3d(0,-10px,0);
	transform: translate3d(0,-10px,0);
}
figure.reply-delete p a {
	margin: 0 0.5em;
	color: #101010;
}
figure.reply-delete p a:hover,
figure.reply-delete p a:focus {
	opacity: 0.6;
}
figure.reply-delete figcaption::before {
	position: absolute;
	top: 0;
	right: 0;
	left: 0;
	z-index: -1;
	height: 0;
	background: #fff;
	-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
	transition: opacity 0.35s, transform 0.35s;
	-webkit-transform: translate3d(0,4em,0) scale3d(1,0.023,1) ;
        transform: translate3d(0,4em,0) scale3d(1,0.023,1);
	-webkit-transform-origin: 50% 0;
	transform-origin: 50% 0;
}
figure.reply-delete:hover p {
	opacity: 1;
	-webkit-transform: translate3d(0,0,0);
}
.fa{
    display:inline-block;
    font:normal normal normal 14px/1 FontAwesome;
    font-size:inherit;
    -webkit-font-smoothing:antialiased;
    -moz-osx-font-smoothing:grayscale
}
.fa-fw{
    width:1.28571429em;
    text-align:center
}
.fa-trash:before{
    content:"\f014"
}
.fa-reply:before{
    content:"\f064"
}
</style>

<html lang="en" class="no-js">
    <head>
	<meta charset="UTF-8" />	
	<title>Hover Effect Ideas | Set 2</title>	
    </head>
	
    <body>
        <div class="grid">
            <figure class="reply-delete">
                <div class="comment-box"></div>
                <figcaption>
                    <p>
                        <a href="#"><i class="fa fa-fw fa-trash"></i></a>
                        <a href="#"><i class="fa fa-fw fa-reply"></i></a>
                    </p>
                </figcaption>			
            </figure>
        </div>    
    </body>
</html>
