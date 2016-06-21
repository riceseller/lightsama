<?php require_once 'init.php'; 
error_reporting( error_reporting() & ~E_NOTICE );
$category=$_GET["category"]; ?>
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
                    Redirect::to('../index.php');
				//}
                } //end of the validation code
                else {
                    $error_message .= 'Log in failed. Please check your username and password and try again.';
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
			Redirect::to($us_url_root.'../index.php');
		}
	
	} //Validation and agreement checbox
    } //Input exists
}
?>




<style>
    #formbody{
        
    }
</style>

<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
<link rel="stylesheet" href="css/reg/css/normalize.css">

<link rel="stylesheet" href="css/reg/css/style.css">

<div id="formbody">

    <div class="form3">

      <ul class="tab-group">
        <li <?php if($category=='signup'){print "class=\"tab active\"";}else{print "class=\"tab\"";}?>>
            <a id='sup' href="#signup">Sign Up</a></li>
        <li <?php if($category=='login'){print "class=\"tab active\"";}else{print "class=\"tab\"";}?>>
            <a id='log' href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
            <?php 
                if (!$form_valid && Input::exists()){
                    echo display_errors($validation->errors());
                }   //exact copy from join.php
            ?>
          
        <form action="new_login.php?through=signup" method="POST">
            <div class="top-row">
                <div class="field-wrap">
                    <input type="text" placeholder="First Name" name="fname" value="<?php if (!$form_valid && !empty($_POST)){ echo $fname;} ?>" required autocomplete="off" />
                </div>
        
                <div class="field-wrap">
                    <input type="text" name="lname" placeholder="Last Name" value="<?php if (!$form_valid && !empty($_POST)){ echo $lname;} ?>" required autocomplete="off"/>
                </div>
            </div>
          
            <div class="field-wrap">
                <input type="text"required placeholder="username with minimum 5 letters no space" name="username" value="<?php if (!$form_valid && !empty($_POST)){ echo $username;} ?>" autocomplete="off"/>
            </div>
              
            <div class="field-wrap">
                <input type="text" name="email" placeholder="Email Address" value="<?php if (!$form_valid && !empty($_POST)){ echo $email;} ?>" required autocomplete="off"/>
            </div>
          
            <div class="field-wrap">
                <input type="password" name="password" placeholder="Password at least 6 characters" required autocomplete="off"/>
            </div>
              
            <div class="field-wrap">
                <input type="password" name="confirm" placeholder="Confirm Password" required autocomplete="off"/>
            </div>
            
           
            <input type="hidden" value="<?=Token::generate();?>" name="csrf">
            <button type="submit" class="button button-block"/>Get Started</button>
          </form>

        </div>
      
        <div id="login">
            
          <h1>Welcome Back to Photolib</h1>
       
          <form action="new_login.php?through=login" method="post">
          
            <div class="field-wrap">
                <input type="text" name="username" placeholder="Username/Email" required autocomplete="off"/>
            </div>
          
            <div class="field-wrap">
                <input type="password" name="password" placeholder="Password" required autocomplete="off"/>
            </div>
          
          <p class="forgot"><a href="forgot_password.php">Forgot Password?</a></p>
          
          <input type="hidden" name="csrf" value="<?=Token::generate(); ?>">
          <button class="button button-block" type="submit"/>Log In</button>
          
          </form>
          
        </div>
        
      </div><!-- tab-content -->
      
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script type="text/javascript" src="css/reg/js/index.js"></script>
<script>
    var mode = '<?php print $category; ?>';
    $( document ).ready(function(){
    console.log(mode);
    if(mode==='login'){
        $('#log').click();
        console.log('click log');
    }else{
        $('#sup').click();
    }
});
</script>

    </body>
    </html>