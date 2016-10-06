<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <title>Vertical Responsive Timeline UI - Template Monster Demo</title>
    <link rel="shortcut icon" href="http://static.tmimgcdn.com/img/favicon.ico">
    <link rel="icon" href="http://static.tmimgcdn.com/img/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" integrity="sha384-MIwDKRSSImVFAZCVLtU0LMDdON6KVCrZHyVQQj6e8wIEJkW4tvwqXrbMIya1vriY" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/js/bootstrap.min.js" integrity="sha384-ux8v3A6CPtOTqOzMKiuo3d/DomGaaClxFYdCu2HPMBEkf6x2xiDyJ7gkXU0MWwaD" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../font-awesome-4.6.3/css/font-awesome.min.css">
</head>

<style>
body { background: #333; }

img { border: 0; max-width: 100%; }
 
.page-header h1 {
  font-size: 3.26em;
  text-align: center;
  color: #efefef;
  text-shadow: 1px 1px 0 #000;
}
 
/** timeline box structure **/
.timeline {
  list-style: none;
  padding: 20px 0 20px;
  position: relative;
}
 
.timeline:before {
  top: 0;
  bottom: 0;
  position: absolute;
  content: " ";
  width: 3px;
  background-color: #eee;
  left: 50%;
  margin-left: -1.5px;
}
 
.tldate {
  display: block;
  width: 200px;
  background: #414141;
  border: 3px solid #212121;
  color: #ededed;
  margin: 0 auto;
  padding: 3px 0;
  font-weight: bold;
  text-align: center;
  -webkit-box-shadow: 0 0 11px rgba(0,0,0,0.35);
}
 
.timeline li {
  margin-bottom: 25px;
  position: relative;
}
.timeline li .timeline-panel {
  width: 46%;
  float: left;
  background: #fff;
  border: 1px solid #d4d4d4;
  padding: 20px;
  position: relative;
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  border-radius: 8px;
  -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.15);
  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.15);
}
 
/** panel arrows **/
.timeline li .timeline-panel:before {
  position: absolute;
  top: 26px;
  right: -15px;
  display: inline-block;
  border-top: 15px solid transparent;
  border-left: 15px solid #ccc;
  border-right: 0 solid #ccc;
  border-bottom: 15px solid transparent;
  content: " ";
}
 
.timeline li .timeline-panel:after {
  position: absolute;
  top: 27px;
  right: -14px;
  display: inline-block;
  border-top: 14px solid transparent;
  border-left: 14px solid #fff;
  border-right: 0 solid #fff;
  border-bottom: 14px solid transparent;
  content: " ";
}
.timeline li .timeline-panel.noarrow:before, .timeline li .timeline-panel.noarrow:after {
  top:0;
  right:0;
  display: none;
  border: 0;
}
.timeline li.timeline-inverted .timeline-panel {
  float: right;
}
 
.timeline li.timeline-inverted .timeline-panel:before {
  border-left-width: 0;
  border-right-width: 15px;
  left: -15px;
  right: auto;
}
 
.timeline li.timeline-inverted .timeline-panel:after {
  border-left-width: 0;
  border-right-width: 14px;
  left: -14px;
  right: auto;
}
@media (max-width: 991px) {
  .timeline li .timeline-panel {
    width: 44%;
  }
}
 
@media (max-width: 700px) {
  .page-header h1 { font-size: 1.8em; }
 
  ul.timeline:before {
    left: 40px;
  }
 
  .tldate { width: 140px; }
 
  ul.timeline li .timeline-panel {
    width: calc(100% - 90px);
    width: -moz-calc(100% - 90px);
    width: -webkit-calc(100% - 90px);
  }
 
  ul.timeline li .tl-circ {
    top: 22px;
    left: 22px;
    margin-left: 0;
 
  }
  ul.timeline > li > .tldate {
    margin: 0;
  }
 
  ul.timeline > li > .timeline-panel {
    float: right;
  }
 
  ul.timeline > li > .timeline-panel:before {
    border-left-width: 0;
    border-right-width: 15px;
    left: -15px;
    right: auto;
  }

  ul.timeline > li > .timeline-panel:after {
    border-left-width: 0;
    border-right-width: 14px;
    left: -14px;
    right: auto;
  }
}
</style>

<body>
<ul class="timeline">
    <li><div class="tldate">Apr 2014</div></li>
 
    <li>
        <div class="tl-circ"></div>
        <div class="timeline-panel">
            <div class="tl-heading">
                <h4>Surprising Headline Right Here</h4>
                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 3 hours ago</small></p>
            </div>
            <div class="tl-body">
                <p>Lorem Ipsum and such.</p>
            </div>
        </div>
    </li>
 
    <li class="timeline-inverted">
        <div class="tl-circ"></div>
        <div class="timeline-panel">
            <div class="tl-heading">
                <h4>Breaking into Spring!</h4>
                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 4/07/2014</small></p>
            </div>
            <div class="tl-body">
                <p>Hope the weather gets a bit nicer...</p>
                <p>Y'know, with more sunlight.</p>
            </div>
        </div>
    </li>
</body>

