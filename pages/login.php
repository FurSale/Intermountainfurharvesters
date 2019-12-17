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



   <!-- START CONTENT -->
   <section id="content">
          <!--start container-->
          <div class="container">
              <!--Responsive Table-->
              <div id="responsive-table">
				<h4 class="header">Admin Login</h4>
				<form method="post" class="col s12">
					<div class="row">
						<div class="input-field col s12">
							<input placeholder="Username / Buyer ID" id="username" name="username" type="text" class="validate" value="<?php echo $login['username']; ?>">
							<label for="username">Username / Buyer ID</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input placeholder="Password" id="password" name="password" type="password" class="validate">
							<label for="password">Password</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12"><input type="submit" name="submit" class="waves-effect waves-light btn submit" value="Login"></input></div>
					</div>
				</form>
            </div>
          </div>
	</section>
	<!-- END WRAPPER -->
</main>

<?php
include '../includes/footer.php';
include '../includes/end_html.php';
?>