<?php
require_once "../users/init.php";
require_once "../newNavBar.php";
require_once "../supplyment/dbAccess.php";
if(isset($_GET['category'])&&$_GET['category']=='register') {
    $category = 1; //1 for register
}else{
    $category = 2; //2 for login
}
//error_reporting(error_reporting() & ~E_NOTICE);
?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php
//this section of php code handles existing user to login to the page. It includes php code 
//for future management. 
ini_set("allow_url_fopen", 1);       //for controling initial display use
$through=$_GET["through"];          //for controling form submission use
?>

<?php       //login handling set down here
    if($through=='login')
    {
        $category='login';
        $settingsQ = $db->query("SELECT * FROM settings");
        $settings = $settingsQ->first();
        $error_message = '';
        $reCaptchaValid=FALSE;

        if (Input::exists()) {
            $token = Input::get('csrf');
            if(!Token::check($token)){
               	die('Token doesn\'t match!');
        }

            //Check to see if recaptcha is enabled
        if($settings->recaptcha == 1){
            require_once 'includes/recaptcha.config.php';

            //reCAPTCHA 2.0 check
            $response = null;

            // check secret key
            $reCaptcha = new ReCaptcha($privatekey);

            // if submitted check response
            if ($_POST["g-recaptcha-response"]) {
                $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
            }
            if ($response != null && $response->success) {
                $reCaptchaValid=TRUE;

            }else{
                $reCaptchaValid=FALSE;
                $error_message .= 'Please check the reCaptcha.';
            }
	}else{
            $reCaptchaValid=TRUE;
	}

	if($reCaptchaValid || $settings->recaptcha == 0){ //if recaptcha valid or recaptcha disabled
            //start of verifying if user is logged in
            $validate = new Validate();
            $validation = $validate->check($_POST, array('username' => array('display' => 'Username','required' => true),'password' => array('display' => 'Password', 'required' => true)));

            if ($validation->passed()) {
			//Log user in

                $remember = (Input::get('remember') === 'on') ? true : false;
                $user = new User();
                $login = $user->loginEmail(Input::get('username'), trim(Input::get('password')), $remember);
                if ($login) {
				//if(file_exists($abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php')){
				//	require_once $abs_us_root.$us_url_root.'usersc/scripts/custom_login_script.php';
				//}else{
					//Feel free to change where the user goes after login!
                    Redirect::to('../users/account.php');
				//}
                } //end of the validation code
                else {
                    $error_message .= 'Log in failed. Please check your username and password and try again.';
                    echo "<script>passwordwrong()</script>";
                    $category='login';
                }
            } else{
                $error_message .= '<ul>';
                foreach ($validation->errors() as $error) {
                    $error_message .= '<li>' . $error . '</li>';
                }
                $error_message .= '</ul>';
            }
        }
    }
}
else if($through=='signup')
{
    $category='signup';
    if (!securePage($_SERVER['PHP_SELF'])){die();}
    $settingsQ = $db->query("SELECT * FROM settings");
    $settings = $settingsQ->first();
    if($settings->recaptcha == 1){
	require_once("includes/recaptcha.config.php");
    }
    //There is a lot of commented out code for a future release of sign ups with payments
    $form_method = 'POST';
    $form_action = 'join.php';  //source of the error in the future
    $vericode = rand(100000,999999);

    $form_valid=FALSE;

    //Decide whether or not to use email activation
    $query = $db->query("SELECT * FROM email");
    $results = $query->first();
    $act = $results->email_act;

    //Opposite Day for Pre-Activation - Basically if you say in email
    //settings that you do NOT want email activation, this lists new
    //users as active in the database, otherwise they will become
    //active after verifying their email.
    if($act==1){
	$pre = 0;
    } else {
	$pre = 1;
    }

    //$token = Input::get('csrf');
    //if(Input::exists()){
	//if(!Token::check($token)){
	//	die('Token doesn\'t match!');
	//}
    //}

    $reCaptchaValid=FALSE;

    if(Input::exists()){
	$username = Input::get('username');
	$fname = Input::get('fname');
	$lname = Input::get('lname');
	$email = Input::get('email');
	//$company = Input::get('company');
	//$agreement_checkbox = Input::get('agreement_checkbox');
        $company = 'northeastern university';
        $agreement_checkbox = 'on';
	
	if ($agreement_checkbox=='on'){
		$agreement_checkbox=TRUE;
	}else{
		$agreement_checkbox=FALSE;
	}

	$db = DB::getInstance();
	$settingsQ = $db->query("SELECT * FROM settings");
	$settings = $settingsQ->first();
	$validation = new Validate();
	$validation->check($_POST,array(
	  'username' => array(
		'display' => 'Username',
		'required' => true,
		'min' => 5,
		'max' => 35,
		'unique' => 'users',
	  ),
	  'fname' => array(
		'display' => 'First Name',
		'required' => true,
		'min' => 2,
		'max' => 35,
	  ),
	  'lname' => array(
		'display' => 'Last Name',
		'required' => true,
		'min' => 2,
		'max' => 35,
	  ),
	  'email' => array(
		'display' => 'Email',
		'required' => true,
		'valid_email' => true,
		'unique' => 'users',
	  ),
	  //'company' => array(
	//	'display' => 'Company Name',
	//	'required' => false,
	//	'min' => 0,
	//	'max' => 75,
	  //),
	  'password' => array(
		'display' => 'Password',
		'required' => true,
		'min' => 6,
		'max' => 25,
	  ),
	  'confirm' => array(
		'display' => 'Confirm Password',
		'required' => true,
		'matches' => 'password',
	  ),
	));
	
	//if the agreement_checkbox is not checked, add error
	if (!$agreement_checkbox){
		$validation->addError(["Please read and accept terms and conditions"]);
	}
	
	if($validation->passed() && $agreement_checkbox){			
		//Logic if ReCAPTCHA is turned ON
		if($settings->recaptcha == 1){
			require_once("includes/recaptcha.config.php");
			//reCAPTCHA 2.0 check
			$response = null;

			// check secret key
			$reCaptcha = new ReCaptcha($privatekey);

			// if submitted check response
			if ($_POST["g-recaptcha-response"]) {
				$response = $reCaptcha->verifyResponse(
					$_SERVER["REMOTE_ADDR"],
					$_POST["g-recaptcha-response"]);
			}
			if ($response != null && $response->success) {
				// account creation code goes here
				$reCaptchaValid=TRUE;
				$form_valid=TRUE;
			}else{
				$reCaptchaValid=FALSE;
				$form_valid=FALSE;
				$validation->addError(["Please check the reCaptcha box."]);
			}
			
		} //else for recaptcha
		
		if($reCaptchaValid || $settings->recaptcha == 0){
			
			//add user to the database
			$user = new User();
			$join_date = date("Y-m-d H:i:s");
			$params = array(
				'fname' => Input::get('fname'),
				'email' => $email,
				'vericode' => $vericode,
			);

			if($act == 1) {
				//Verify email address settings
				$to = $email;
				$subject = 'Welcome to UserSpice!';
				$body = email_body('_email_template_verify.php',$params);
				email($to,$subject,$body);
			}
			try {
				// echo "Trying to create user";
				$user->create(array(
					'username' => Input::get('username'),
					'fname' => Input::get('fname'),
					'lname' => Input::get('lname'),
					'email' => Input::get('email'),
					'password' =>
					password_hash(Input::get('password'), PASSWORD_BCRYPT, array('cost' => 12)),
					'permissions' => 1,
					'account_owner' => 1,
					'stripe_cust_id' => '',
					'join_date' => $join_date,
					'company' => Input::get('company'),
					'email_verified' => $pre,
					'active' => 1,
					'vericode' => $vericode,
				));
			} catch (Exception $e) {
				die($e->getMessage());
			}
                        //login code add on after adding to the database
                        
                        $remember=false;
                        $login = $user->loginEmail(Input::get('username'), trim(Input::get('password')), $remember);
                        
                        
                        //login code finishes after adding to the database
			Redirect::to($us_url_root.'../users/account.php');
		}
	
	} //Validation and agreement checbox
    } //Input exists
}
?>

<customHeader> 
    <style>
        .card-header{
            padding: 0;
        }
        .form-signin {
            max-width: 330px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin .checkbox {
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
                    box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-control{
            /* remove rounded edges */
            border-radius: 0;
        }
        .login-page{
            /* fix conflict with newNavBar styling*/
            max-width: 100%;
        }
        .login-card{
            /* fix conflict with newNavBar styling*/
            display:inline-block;
            margin-top: 0.75rem;
        }
        .reg-form{
            min-width:500px;
        }
    </style>
    <script>
        function passwordwrong() {
            alert("login failed, please type in the correct username and password!");
        }
    </script>
</customHeader>

<div class="footerPusher">
<div class="container" style="padding: 0.75rem;display:flex;">
    <div class="card login-card m-x-auto">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link <?php if($category==2){echo 'active';}?>" id='signInTab' data-toggle="tab" href="#sectionA">Sign In</a></li>
                <li class="nav-item"><a class="nav-link <?php if($category==1){echo 'active';}?>" id='regTab' data-toggle="tab" href="#sectionB">Join us!</a></li>
            </ul>
        </div>
        <div class="card-block">
            <div class="tab-content">
                <div id="sectionA" class="tab-pane <?php if($category==2){echo 'active';}?> text-xs-center">
                    <form class="form-signin" action="new_login.php?through=login" method="post">
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input name="username" type="text" id="inputEmail" class="form-control login-page" placeholder="Username" required autofocus>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input name="password" type="password" id="inputPassword" class="form-control login-page" placeholder="Password" required>
                        <a href="forgot_password">Forgot Password?</a>
                        <div class="checkbox" style="display:none">
                            <label>
                                <input type="checkbox" value="remember-me"> Remember me
                            </label>
                        </div>
                        <input type="hidden" name="csrf" value="<?=TOken::generate();?>">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    </form>
                </div>
                <div id="sectionB" class="tab-pane <?php if($category==1){echo 'active';}?>">
                    <form class="form-signin" action="new_login.php?through=signup" method="post" autocomplete="off" style="display:flex;flex-direction:column;max-width:100%;">
                        <label for="firstName">First Name</label>
                        <input type="text" placeholder="First Name" name="fname" class="form-control reg-form" required>
                        <label for="lastName">Last Name</label>
                        <input type="text" placeholder="Last Name" name="lname" class="form-control reg-form" required>
                        <label for="inputEmail">Username</label>
                        <input name="username" type="text" id="inputEmail" class="form-control reg-form" placeholder="Username" required>
                        <label for="inputEmail">Email Address</label>
                        <input name="email" type="email" id="inputEmail" class="form-control reg-form" placeholder="Email Address" required>
                        <label for="inputPassword">Password</label>
                        <input name="password" type="password" id="inputPassword" class="form-control reg-form" placeholder="Password" required>
                        <label for="inputPassword">Confirm Your Password</label>
                        <input name="confirm" type="password" id="inputPassword" class="form-control reg-form" placeholder="Password" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:10px;">Register</button>
                    </form>
                </div><!--sectionB-->
            </div><!--tab-content-->
        </div><!--card-block-->
    </div><!--card-->
</div>
</div>
    
<?php mysqli_close($conn); ?>
<?php require_once '../footer.php'; ?>