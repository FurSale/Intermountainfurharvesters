<?php
  require_once("../includes/db_connection.php");
  require_once("../includes/functions.php");

  if(!logged_in()){
    header("Location: login.php");
  }

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
                  <input id="site_name" name="site_name" type="text" class="validate" value="<?php echo $site['site_name']; ?>">
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
                 <input id="bid_cutoff_days" name="bid_cutoff_days" type="number" min="1" class="validate" value="<?php echo $site['bid_cutoff_days']; ?>">
                 <label for="bid_cutoff_days">Bid Cutoff (days)</label>
               </div>
             </div>
             <div class="input-field col s3"><input type="submit" name="submit" class="waves-effect waves-light btn submit" value="Save"></input></div>
           </form>
         </div>
   </section>
 <!-- END WRAPPER -->
 </main>
<?php
include '../includes/footer.php';
include '../includes/end_html.php';
?>
