
<!--page redirection controlling-->
<div class="container second" style="text-align: center;">
    <ul class="nav nav-tabs" style="display:inline-block;">
        <li class="nav-item">
            <a class="nav-link" ng-class="{'active': category === 'landscape'}" href="#/landscape" id="landscape">Landscape</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" ng-class="{'active': category === 'beauty'}" href="#/beauty" id="beauty">Beauty</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" ng-class="{'active': category === 'skyscraper'}" href="#/skyscraper" id="skyscraper">Skyscraper</a>
        </li>
    </ul>
</div>

<script>
// All images need to be loaded for this plugin to work so
    $(document).ready(function(){
            collage();
            //$('.Collage').collageCaption();
    });
    // Here we apply the actual CollagePlus plugin
    function collage() {
        $('.Collage').removeWhitespace().collagePlus(
            {
                'fadeSpeed'     : 1000,
                'targetHeight'  : 400,
                'allowPartialLastRow' : true
            }
        );
    };
</script>

<!--the portion below is the associated image info-->
<div class="favClass">
    <section class="Collage effect-parent">
        <div ng-repeat="pic in indexResult.list">
            <div class="Image_Wrapper" style="width: {{pic.width}}; height: {{pic.height}}">
                <div class="hovereffecrt">
                    <a style="text-decoration: none" href="#">
                        <img src="https:\/\/drscdn.500px.org\/photo\/183076705\/q%3D80_m%3D2000\/8054abe7df52315d5a48d8f89ddba0e4" width="{{pic.width}}" height="{{pic.height}}">
                    </a>
                    <a class="overlay" href="/indDisplay4.php?pid={{pic.uid}}&url=https:\/\/drscdn.500px.org\/photo\/183076705\/q%3D80_m%3D2000\/8054abe7df52315d5a48d8f89ddba0e4">
                    </a>
                    <div class="overlay_shadow">
                        <h2>{{pic.title}}</h2>
                        <div class="info">
                            <!--<div class="users" onclick="JumpLink({{pic.id}})" style="background-image: url(https://c2.staticflickr.com/{{pic.extraTwo}}/{{pic.extraOne}}/buddyicons/{{pic.userID}}.jpg)">
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
