<?php
require_once("../includes/db_connection.php");
$pgsettings = array(
	"title" => "Login to Intermountain Fur Harvesters",
	"icon" => "icon-newspaper"
);
require_once("../includes/functions.php");

if(logged_in()){
	header("Location: sellers/list_sellers.php");
}

$login['username'] = "";

if(isset($_POST['submit'])){

	function setLoginCookie($found_user){
		global $connection;
		$_SESSION['user_id']=$found_user['id'];
		$_SESSION['username']=$found_user['username'];
		// if(isset($_POST['remember'])){$remember=1;}else{$remember=0;}
		// if($remember==1){
		// 	setcookie("rememberme",$found_user['username'], time()+60*60*24*30, '/');
		// }

		//Login cookie is set for 12 hours
		setcookie("rememberme",$found_user['username'], time()+60*60*12, '/');

		session_name("login");
		session_start();

		$date=date("Y-m-d H:i:s");
		$query = "";
		//Set a new one time pass if user is a buyer
		if($found_user['role'] == "buyer"){
			$randomPass = random_generator(6, "0123456789");
			$query="UPDATE `user` SET `password_one_time` = '{$randomPass}', `date_last_logged_in` = '{$date}'
			WHERE `id` = {$_SESSION['user_id']}";
		}else{
			$query="UPDATE `user` SET `date_last_logged_in` = '{$date}'
			WHERE `id` = {$_SESSION['user_id']}";
		}

		$result=mysqli_query($connection, $query);
		confirm_query($result);

		if($found_user['role'] == "buyer"){
			header("Location: frontend/index.php");
		}else{
			header("Location: sellers/list_sellers.php");
		}

	}

	if(!isset($_POST['username']) || !isset($_POST['password'])){
		header("Location: login.php");
	}

	$user=trim($_POST['username']);
	$pass=$_POST['password'];

	if($user == '' || $pass == ''){
		$error = "field left blank";
	}

	$query="SELECT * FROM user
			WHERE `username` = '{$user}'";
	$result=mysqli_query($connection, $query);
	confirm_query($result);
	if (mysqli_num_rows($result)==1){
		$found_user = mysqli_fetch_array($result);
		if($found_user['role'] == "buyer"){
			if($pass == $found_user['password_one_time']){
				setLoginCookie($found_user);
			}else{
				$error = "Wrong password";
			}
		}else{
			//Check if hashed password matches DB password
			if(password_verify($pass, $found_user['password'])){
				setLoginCookie($found_user);
			}else{
				$error = "Wrong password";
			}
		}
		$error = "User does not exist";
	}
}else{
	if(isset($_GET['logout']) && $_GET['logout']==1){
		$success = "You have successfully logged out!";
	}
	//redirect_to("../login.php");
}
require_once("../includes/begin_html.php");
?>


<link rel="stylesheet" href="../../css/login.css">
   <!-- START CONTENT -->
	 <div class="container">
						<form method="post" id="login-form" class="login-form" autocomplete="off">
						  <h1 class="a11y-hidden">Login form</h1>
							<div class="row center">
								<div  class="col s12">
						  <figure aria-hidden="true">
						    <div class="person-body"></div>
						    <div class="neck skin"></div>
						    <div class="head skin">
						      <div class="eyes"></div>
						      <div class="mouth"></div>
						    </div>
						    <div class="hair"></div>
						    <div class="ears"></div>
						    <div class="shirt-1"></div>
						    <div class="shirt-2"></div>
						  </figure>
						</div>
							</div>
						  <div aria-live="polite" class="error-message" id="error-message"></div>
							<div class="row">
							<div  class="col s12">
						    <label class="required">
						      <span>Username</span>
						      <input placeholder="Username / Buyer ID" id="username" name="username" type="text" class="validate" value="<?php echo $login['username']; ?>">
						    </label>
						  </div>
							</div>
							<div class="row">
						  <div  class="col s12">
						    <label class="required">
						      <span>Password</span>
						     							<input placeholder="Password" id="password" name="password" type="password" class="validate">
						    </label>
						  </div>
							<div class="row">
						  <div class="col s12">
						    <label>
						      <input type="checkbox" name="show-password" id="show-password" class="a11y-hidden" />
						      <span class="checkbox-label">Show Password</span>
						    </label>
						  </div>
							</div>
							<div class="row">
								<div  class="col s12 center">
						  <input type="submit" name="submit" class="waves-effect waves-light color-change-5x btn submit" value="Login"></input>
						</div>
						</div>
						</form>
						</div

	<!-- END WRAPPER -->
</main>
<script>
// show password interactivity
document.querySelector("#show-password").addEventListener("input", function() {
  document.querySelector("#password").type = this.checked ? "text" : "password";
  document.querySelector(".eyes").className = `eyes ${this.checked && " closed"}`;
});

// focus within the label input

// form submission = validation


// remove state error on blur
function removeError(e) {
	e.target.parentNode.classList.remove("state-error");
  document.querySelector("#error-message").textContent = "";
}
function checkStatus(e) {
	removeError(e);
  const invalidFields = document.querySelectorAll("input:invalid").length;
  document.querySelector(".mouth").className = `mouth errors-${invalidFields}`;
}
document.querySelector("#password").addEventListener("input", checkStatus);
document.querySelector("#username").addEventListener("input", checkStatus);

// move eyes following username input
function moveEyes(e) {
	const eyes = document.querySelector(".eyes");
  const length = e.target.value.length;
  // this is a bit trickier because the eyes already have a translation!
  eyes.style.transform = `translate(calc(-50% + ${Math.min(length/2 - 7, 7)}px), calc(-50% + 0.1875rem))`;
  // eyes.style.marginTop = "0.25rem";
  // eyes.style.marginLeft = `${Math.min(length/2 - 7, 7)}px`;
}
document.querySelector("#username").addEventListener("focus", moveEyes);
document.querySelector("#username").addEventListener("input", moveEyes);
document.querySelector("#username").addEventListener("blur", function() {
	document.querySelector(".eyes").style.transform = "translate(-50%, -50%)";
});
</script>
<?php
include '../includes/end_html.php';
?>
