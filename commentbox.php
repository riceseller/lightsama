<style>
.comments-container {
	margin: 60px auto 15px;
        margin-bottom: 0;
	width: 768px;
        border: 3px solid green;
}
.comments-container ul {
        list-style-type: none;
}
.comments-container * {   
 	margin: 0;
 	padding: 0;
 	-webkit-box-sizing: border-box;
 	-moz-box-sizing: border-box;
 	box-sizing: border-box;
}
.comments-container h1 {
	font-size: 36px;
	color: #283035;
	font-weight: 400;
}
.comments-container h1 a {
	font-size: 18px;
	font-weight: 700;
}
.comments-container .comments-list {
	margin-top: 30px;
	position: relative;
}
.comments-container .comments-list:before {
	content: '';
	width: 2px;
	height: 100%;
	background: #c7cacb;
	position: absolute;
	left: 32px;
	top: 0;
}
.comments-container .comments-list:after {
	content: '';
	position: absolute;
	background: #c7cacb;
	bottom: 0;
	left: 27px;
	width: 7px;
	height: 7px;
	border: 3px solid #dee1e3;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	border-radius: 50%;
}
.comments-container .reply-list:before, .reply-list:after {display: none;}
.comments-container .reply-list li:before {
	content: '';
	width: 60px;
	height: 2px;
	background: #c7cacb;
	position: absolute;
	top: 25px;
	left: -55px;
}
.comments-container .comments-list li {
	margin-bottom: 15px;
	display: block;
	position: relative;
}
.comments-container .comments-list li:after {
	content: '';
	display: block;
	clear: both;
	height: 0;
	width: 0;
}
.comments-container .reply-list {
	padding-left: 88px;
	clear: both;
	margin-top: 15px;
}
.comments-container .comments-list .comment-avatar {
	width: 65px;
	height: 65px;
	position: relative;
	z-index: 99;
	float: left;
	border: 3px solid #FFF;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	overflow: hidden;
        border-radius: 50%;
}
.comments-container .comments-list .comment-avatar img {
        width: 100%;
        height: 100%;
        /* fill the container, preserving aspect ratio, and cropping to fit */
        background-size: cover;
        /* center the image vertically and horizontally */
        /* round the edges to a circle with border radius 1/2 container size */
        border-radius: 50%;      
}
.comments-container .reply-list .comment-avatar {
	width: 50px;
	height: 50px;
}
.comments-container .comment-main-level:after {
	content: '';
	width: 0;
	height: 0;
	display: block;
	clear: both;
}
.comments-container .comments-list .comment-box {
	width: 680px;
	float: right;
	position: relative;
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.15);
	-moz-box-shadow: 0 1px 1px rgba(0,0,0,0.15);
	box-shadow: 0 1px 1px rgba(0,0,0,0.15);
}
.comments-container .comments-list .comment-box:before, .comments-list .comment-box:after {
	content: '';
	height: 0;
	width: 0;
	position: absolute;
	display: block;
	border-width: 10px 12px 10px 0;
	border-style: solid;
	border-color: transparent #FCFCFC;
	top: 8px;
	left: -11px;
}
.comments-container .comments-list .comment-box:before {
	border-width: 11px 13px 11px 0;
	border-color: transparent rgba(0,0,0,0.05);
	left: -12px;
}
.comments-container .reply-list .comment-box {
	width: 610px;
}
.comments-container .comment-box .comment-head {
	background: #FCFCFC;
	padding: 10px 12px;
	border-bottom: 1px solid #E5E5E5;
	overflow: hidden;
	-webkit-border-radius: 4px 4px 0 0;
	-moz-border-radius: 4px 4px 0 0;
	border-radius: 4px 4px 0 0;
}
.comments-container .comment-box .comment-head i {
	float: right;
	margin-left: 14px;
	position: relative;
	top: 2px;
	color: #A6A6A6;
	cursor: pointer;
	-webkit-transition: color 0.3s ease;
	-o-transition: color 0.3s ease;
	transition: color 0.3s ease;
}
.comments-container .comment-box .comment-head i:hover {
	color: #03658c;
}
.comments-container .comment-box .comment-name {
	color: #283035;
	font-size: 14px;
	font-weight: 700;
	float: left;
	margin-right: 10px;
}
.comments-container .comment-box .comment-name a {
	color: #283035;
        text-decoration: none;
}
.comments-container .comment-box .comment-head span {
	float: left;
	color: #999;
	font-size: 13px;
	position: relative;
	top: 1px;
}
.comments-container .comment-box .comment-content {
	background: #FFF;
	padding: 12px;
	font-size: 14px;
        font-weight: 400;
        word-wrap: break-word;
	color: #717274;
	-webkit-border-radius: 0 0 4px 4px;
	-moz-border-radius: 0 0 4px 4px;
	border-radius: 0 0 4px 4px;
}
.comments-container .comment-box .comment-name.by-author, .comment-box .comment-name.by-author a {color: #03658c;}
.comment-box .comment-name.by-author:after {
	content: 'autor';
	background: #03658c;
	color: #FFF;
	font-size: 12px;
	padding: 3px 5px;
	font-weight: 700;
	margin-left: 10px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
        text-decoration: none;
}
@media only screen and (max-width: 766px) {
	.comments-container {
		width: 480px;
	}
	.comments-list .comment-box {
		width: 390px;
	}
	.reply-list .comment-box {
		width: 320px;
	}
}
</style>

<style>
    #submission{
        margin: 0;
 	padding: 0;
 	-webkit-box-sizing: border-box;
 	-moz-box-sizing: border-box;
 	box-sizing: border-box;
        border: 3px solid brown;
        margin: 60px auto 15px;
        margin-top: 0;
        width: 768px;
        height: 100px;
    }
</style>

<style>
    #fdb{
        border: 3px solid blue;
        display: flex;
        flex-direction: column;
        width: 100%;
        height: auto;
        margin-top: 30px;
        margin-bottom: 30px;
        font-family: 'Roboto', Arial, Helvetica, Sans-serif, Verdana;
	background: #f3f5f6;
}    
</style>

<div id="fdb">
<!-- Contenedor Principal -->
	<div class="comments-container">
		<ul id="comments-list" class="comments-list">
			<li>
				<div class="comment-main-level">
					<!-- Avatar -->
					<div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_1_zps8e1c80cd.jpg" alt=""></div>
					<!-- Contenedor del Comentario -->
					<div class="comment-box">
						<div class="comment-head">
							<h6 class="comment-name by-author"><a href="http://creaticode.com/blog">Agustin Ortiz</a></h6>
							<span>see how it goes</span>
							<i class="fa fa-reply"></i>
							<i class="fa fa-heart"></i>
						</div>
						<div class="comment-content">
							analysis
						</div>
					</div>
				</div>
				<!-- Respuestas de los comentarios -->
				<ul class="comments-list reply-list">
					<li>
						<!-- Avatar -->
						<div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_2_zps7de12f8b.jpg" alt=""></div>
						<!-- Contenedor del Comentario -->
						<div class="comment-box">
							<div class="comment-head">
								<h6 class="comment-name"><a href="http://creaticode.com/blog">Lorena Rojero</a></h6>
								<span>88555555</span>
								<i class="fa fa-reply"></i>
								<i class="fa fa-heart"></i>
							</div>
							<div class="comment-content">
								this is shit bro
							</div>
						</div>
					</li>

					<li>
						<!-- Avatar -->
						<div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_1_zps8e1c80cd.jpg" alt=""></div>
						<!-- Contenedor del Comentario -->
						<div class="comment-box">
							<div class="comment-head">
								<h6 class="comment-name by-author"><a href="http://creaticode.com/blog">Agustin Ortiz</a></h6>
								<span>88686868</span>
								<i class="fa fa-reply"></i>
								<i class="fa fa-heart"></i>
							</div>
							<div class="comment-content">
								 i want smoke too
							</div>
						</div>
					</li>
				</ul>
			</li>
			<li>
				<div class="comment-main-level">
					<!-- Avatar -->
					<div class="comment-avatar"><img src="http://i9.photobucket.com/albums/a88/creaticode/avatar_2_zps7de12f8b.jpg" alt=""></div>
					<!-- Contenedor del Comentario -->
					<div class="comment-box">
						<div class="comment-head">
							<h6 class="comment-name"><a href="http://creaticode.com/blog">Lorena Rojero</a></h6>
							<span>22222222</span>
							<i class="fa fa-reply"></i>
							<i class="fa fa-heart"></i>
						</div>
						<div class="comment-content">
							I want smoke
						</div>
					</div>
				</div>
			</li>
		</ul>
	</div>

    <!-- comment submission form goes down there -->
    
    <div id="submission">        
    </div>
    
</div>
