<?php require_once 'init.php'; 
      require_once '../supplyment/dbAccess.php'; ?>

<?php if($user->isLoggedIn()) : ?>
    <style>
        #avaMod {
            width: 340px;
            margin: auto;
        }
        #avaModBox{
            border-radius: 2px;
        }
        #avaMod_text{
            width: 300px;
            padding: 1px 0 1px 2px;
            font-size: 16px;
            border: 0 none;
            height: 34px;
            margin-right: 0;
            color: #78787a;
            outline: none;
            background: #d0d0d1;
            float: left;
            box-sizing: border-box;
            border-top-left-radius: 2px;
            border-bottom-left-radius: 2px;
            transition: all 0.15s;
        }
        ::-webkit-input-placeholder { /* WebKit browsers */
            color: #78787a;
        }
        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
            color: #78787a;
        }
        ::-moz-placeholder { /* Mozilla Firefox 19+ */
            color: #78787a;
        }
        :-ms-input-placeholder { /* Internet Explorer 10+ */
            color: #78787a;
        }
        #avaMod_text:focus {
            background: #ffffff;
        }
        #avaMod_button {
            border: 0 none;
            background: #d0d0d1 url(../media/search.png) center no-repeat;
            width: 29px;
            float: left;
            padding: 0;
            text-align: center;
            height: 34px;
            cursor: pointer;
            border-top-right-radius: 2px;
            border-bottom-right-radius: 2px;
        }
    </style>
    <div id='avaMod'>
        <form id='avaModBox' action="avaAdd.php" method="POST">
            <input type="text" name="avaUrl" id="avaMod_text" placeholder="Input your avatar Url"/>
            <input type="submit" value=" " name="avaMod_button" id="avaMod_button"/>
        </form>
    </div>
<?php else : ?>
    <a href='account.php'>Please login to modify your avatar!</a>
<?php endif; ?>