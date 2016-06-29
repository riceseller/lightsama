<style>
    #favicon{
        width: 40px;
        height:40px;
        position: absolute;
        left: 50%;
        top: 50%;
        border: 3px solid yellow;
    }
    #favicon input[type=checkbox].css-checkbox {
	position:absolute; z-index:-1000; left:-1000px; overflow: hidden; clip: rect(0 0 0 0); height:1px; width:1px; margin:-1px; padding:0; border:0;
    }

    #favicon input[type=checkbox].css-checkbox + label.css-label {
	padding-left:45px;
	height:40px; 
	display:inline-block;
	line-height:40px;
	background-repeat:no-repeat;
	background-position: 0 0;
	font-size:40px;
	vertical-align:middle;
	cursor:pointer;
    }

    #favicon input[type=checkbox].css-checkbox:checked + label.css-label {
	background-position: 0 -40px;
    }
    
    #favicon label.css-label {
        background-image:url(http://csscheckbox.com/checkboxes/u/csscheckbox_019807af606f0dea9eb28a8d35a7afc6.png);
	-webkit-touch-callout: none;
        -webkit-user-select: none;
	-khtml-user-select: none;
        -moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
    }
</style>

<script>
    window.onload = function () {
    var input = document.querySelector('input[type=checkbox]');


    function check() {
        var a = input.checked ? "checked" : "not checked";
        document.getElementById('result').innerHTML = a+' result';
    }
    
    
    input.onchange = check;
    check();
    
}
</script>

<div id="favicon">
    <input type="checkbox" name="checkboxG5" id="checkboxG5" class="css-checkbox" autocomplete="off" onclick="myFunction()"/>
    <label for="checkboxG5" class="css-label"></label>
</div>

<span id="result"></span>

