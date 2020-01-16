<?php
  require_once("../includes/db_connection.php");
  require_once("../includes/functions.php");

  verify_logged_in(array("administrator"));

  $site['site_name'] = null;
  $site['timezone'] = null;
  $site['bid_cutoff_days'] = null;

  if(isset($_POST['submit'])){

    //Safely escape all data in _POST
    $data = $_POST;
    foreach ($data as $key => $value) {
      if(is_string($value)){
        $data[$key] = mysqli_real_escape_string($connection, $value);
      }
    }

    $date = date("Y-m-d H:i:s");

    $query = "UPDATE `site_info` SET
    `site_name` = '{$data['site_name']}', `timezone`='{$data['timezone']}', `bid_cutoff_days`='{$data['bid_cutoff_days']}' 
    WHERE `id` = 1";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    if (mysqli_affected_rows($connection) == 1) {
        $success = "Site settings updated";
    } else {
      $error = "Couldn't update";
      $error .= "<br />" . mysqli_error($connection);
      $buyer = $data;
    }
  }

  if(isset($_POST['submit_pass'])){
    $pass=$_POST['current_password'];
    $nPass=$_POST['new_password'];
    $confPass=$_POST['confirm_password'];

    if($pass == '' || $nPass == '' || $confPass == ''){
      $error = "Field left blank";
    }else{
      if($nPass != $confPass){
        $error = "New Password does not match Confirm Password";
      }else{
        $query="SELECT * FROM `user`
        WHERE `username` = 'admin'";
        $result=mysqli_query($connection, $query);
        confirm_query($result);
        $found_user = mysqli_fetch_array($result);
        if(password_verify($pass, $found_user['password'])){
          $hashed = password_hash($nPass, PASSWORD_DEFAULT);
          $query="UPDATE `user` SET `password` = '{$hashed}'
          WHERE `username` = 'admin'";
          $result=mysqli_query($connection, $query);
          confirm_query($result);
          $success = "Password changed";
        }else{
          $error = "Incorrect current password";
        }
      }
    }
  }

  //Get updated data from DB
  $query="SELECT * FROM `site_info` WHERE `id`= 1";
  $result=mysqli_query($connection, $query);
  $site=mysqli_fetch_array($result);

  //Set page title
  $title = "Site Settings";

	$pgsettings = array(
		"title" => $title,
		"icon" => "icon-newspaper"
	);
	$nav = ("1");
	require_once("../includes/begin_html.php");
	require_once("../includes/nav.php");
	 ?>
	 <!-- START CONTENT -->
 <section id="content" class="print">

	 <?php
     require_once("../includes/crumbs.php");
	 	 ?>
      <div class="container">
        <div class="row">
           <form method="post" class="col s12">
             <div class="row">
                <div class="input-field col s3">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="site_name" name="site_name" type="text" class="validate" value="<?php echo $site['site_name']; ?>" />
                  <label for="site_name">Auction Name</label>
                </div>
                <div class="input-field col s3">
                  <select id="timezone" name="timezone">
                  <?php foreach(DateTimeZone::listIdentifiers(DateTimeZone::AMERICA) as $timezone){
                    $target_time_zone = new DateTimeZone($timezone);
                    $date_time = new DateTime('now', $target_time_zone);
                    ?>
                    <option value="<?php echo $timezone; ?>"<?php if($site['timezone'] == $timezone){echo " selected";} ?>><?php echo "(UTC ".$date_time->format('P').") ".$timezone; ?></option>
                  <?php } ?>
                  </select>
                  <label for="timezone">Time Zone</label>
                </div>
               <div class="input-field col s3">
                 <input id="bid_cutoff_days" name="bid_cutoff_days" type="number" min="1" class="validate" value="<?php echo $site['bid_cutoff_days']; ?>" />
                 <label for="bid_cutoff_days">Bid Cutoff (days)</label>
               </div>
             </div>
             <div class="input-field col s3"><input type="submit" name="submit" class="waves-effect waves-light btn submit" value="Save"></input></div>
           </form>
         </div>
          <div class="row">
            <h5>Change Admin Password</h5>
          </div>
          <form method="post">
          <div class="row">
              <div class="input-field col s3">
                <input id="current_password" name="current_password" type="password" class="validate" />
                <label for="current_password">Current Password</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s3">
                <input id="new_password" name="new_password" type="password" class="validate" />
                <label for="new_password">New Password</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s3">
                <input id="confirm_password" name="confirm_password" type="password" class="validate" />
                <label for="confirm_password">Confirm Password</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s3">
                <input type="submit" name="submit_pass" class="waves-effect waves-light btn submit" value="Change"></input>
              </div>
            </div>
         </form>
   </section>
 <!-- END WRAPPER -->
 </main>
<?php
include '../includes/footer.php';
include '../includes/end_html.php';
?>
