<?php
  require_once("../../includes/db_connection.php");
  require_once("../../includes/functions.php");

  $buyer['id'] = null;
  $buyer['first_name'] = null;
  $buyer['last_name'] = null;
  $buyer['company_name'] = null;
  $buyer['address_1'] = null;
  $buyer['address_2'] = null;
  $buyer['city'] = null;
  $buyer['state'] = null;
  $buyer['zip'] = null;
  $buyer['phone'] = null;
  $buyer['email'] = null;
  $buyer['fur_buyer_license_num'] = null;
  $buyer['date_last_logged_in'] = null;
  $buyer['date_created'] = null;
  
  if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET["id"]);
    $query="SELECT * FROM `buyer` WHERE `id`={$id}";
    $result=mysqli_query($connection, $query);
    //confirm_query($result);
    //Redirect to blog page if nothing returned from DB
    if(mysqli_num_rows($result) == 0){
      //header("Location: {$GLOBALS['HOST']}");
    }else{
      $buyer=mysqli_fetch_array($result);
    }
  }
  
  if(isset($_POST['submit'])){
    $new = true;
    if($_POST['id'] != ""){
      $new = false;
    }

    //Safely escape all data in _POST
    $data = $_POST;
    foreach ($data as $key => $value) {
      $data[$key] = mysqli_real_escape_string($connection, $value);
    }

    $date = date("Y-m-d H:i:s");
    
    if($new){
      $query = "INSERT INTO `buyer` (`first_name`, `last_name`, `company_name`, `address_1`, `address_2`, `city`, `state`, `zip`, `phone`, `email`, `fur_buyer_license_num`, `date_created`) 
      VALUES ('{$data['first_name']}', '{$data['last_name']}', '{$data['company_name']}', '{$data['address_1']}', '{$data['address_2']}', '{$data['city']}', '{$data['state']}', 
      '{$data['zip']}', '{$data['phone']}', '{$data['email']}', '{$data['fur_buyer_license_num']}', '{$date}')";
    }
    else{
      $query = "UPDATE `buyer` SET 
      `first_name` = '{$data['first_name']}', `last_name`='{$data['last_name']}', `company_name`='{$data['company_name']}', `address_1`='{$data['address_1']}', 
      `address_2` = '{$data['address_2']}', `city`='{$data['city']}', `state`='{$data['state']}', `zip`='{$data['zip']}', 
      `phone` = '{$data['phone']}', `email`='{$data['email']}', `fur_buyer_license_num`='{$data['fur_buyer_license_num']}' 
      WHERE `id` = {$data['id']}";
    }
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    if (mysqli_affected_rows($connection) == 1) {
      if($new){
        $success = "Buyer added";
      }else{
        $success = "Buyer updated";
      }
    } else {
      $error = "Couldn't update";
      $error .= "<br />" . mysqli_error($connection);
    }

    if(!$new){
      //Get updated data from DB
      $query="SELECT * FROM `buyer` WHERE `id`={$data['id']}";
      $result=mysqli_query($connection, $query);
      $buyer=mysqli_fetch_array($result);
    }
  }


  //Set page title
  if(isset($_GET['id'])){
    $title = "Editing Buyer";
  }else{
    $title = "Adding Buyer";
  }
	$pgsettings = array(
		"title" => $title,
		"icon" => "icon-newspaper"
	);
	$nav = ("1");
	require_once("../../includes/begin_html.php");
	require_once("../../includes/nav.php");
	 ?>
	 <!-- START CONTENT -->
 <section id="content">
	 <?php
	 	require_once("../../includes/crumbs.php");
	 	 ?>
      <div class="container">
        <div class="row">
           <form method="post" class="col s12">
           <input id="id" name="id" type="hidden" value="<?php echo $buyer['id']; ?>">
             <div class="row">
               <div class="input-field col s3">
                 <i class="material-icons prefix">contacts</i>
                 <input placeholder="License" id="fur_buyer_license_num" name="fur_buyer_license_num" type="text" class="validate" value="<?php echo $buyer['fur_buyer_license_num']; ?>">
                 <label for="fur_buyer_license_num">License</label>
               </div>
               <div class="input-field col s3">
                 <i class="material-icons prefix">contacts</i>
                 <input placeholder="Company" id="company_name" name="company_name" type="text" class="validate" value="<?php echo $buyer['company_name']; ?>">
                 <label for="company_name">Company</label>
               </div>
             </div>
             <div class="row">
               <div class="input-field col s3">
                 <i class="material-icons prefix">account_circle</i>
                 <input id="first_name" name="first_name" type="text" class="validate" value="<?php echo $buyer['first_name']; ?>">
                 <label for="first_name">First Name</label>
               </div>
               <div class="input-field col s3">
                 <input id="last_name" name="last_name" type="text" class="validate" value="<?php echo $buyer['last_name']; ?>">
                 <label for="last_name">Last Name</label>
               </div>
              <div class="input-field col s3">
                <i class="material-icons prefix">contact_phone</i>
                <input id="phone" name="phone" type="tel" class="validate" value="<?php echo $buyer['phone']; ?>">
                <label for="phone">Telephone</label>
              </div>
               <div class="input-field col s3">
                 <i class="material-icons prefix">contact_mail</i>
                 <input id="email" name="email" type="email" class="validate" value="<?php echo $buyer['email']; ?>">
                 <label for="email">Email</label>
               </div>
             </div>
             <div class="row">
               <div class="input-field col s3">
                 <i class="material-icons prefix">home</i>
                 <input placeholder="Address 1" id="address_1" name="address_1" type="text" class="validate" value="<?php echo $buyer['address_1']; ?>">
                 <label for="address_1">Address 1</label>
               </div>
               <div class="input-field col s3">
                 <input placeholder="Address 2" id="address_2" name="address_2" type="text" class="validate" value="<?php echo $buyer['address_2']; ?>">
                 <label for="address_2">Address 2</label>
               </div>
               <div class="input-field col s3">
                 <input id="city" name="city" type="text" class="validate" value="<?php echo $buyer['city']; ?>">
                 <label for="city">City</label>
               </div>
              <div class="input-field col s3">
                <select name="state" id="state">
                  <?php echo echo_states($buyer['state']); ?>
                </select>
              </div>
             </div>
             <div class="row">
             <div class="input-field col s3">
                 <input id="zip" name="zip" type="number" class="validate" value="<?php echo $buyer['zip']; ?>">
                 <label for="zip">Zip</label>
               </div>
              </div>
             <div class="input-field col s3"><input type="submit" name="submit" class="waves-effect waves-light btn submit" value="Save"></input></div>
           </form>
         </div>
          <!--Responsive Table-->
          <div id="responsive-table">
	<h4 class="header">Items</h4>
	<div class="row">
		<div class="col s12">
			<table>
				<thead>
					<tr>
						<th>Lot #</th>
						<th>Item Type</th>
						<th>Quantity</th>
						<th>lbs / ct</th>
						<th>Asking Price</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							#1000
						</td>
						<td>
							ID
						</td>
						<td>
							10
						</td>
						<td>
							ct
						</td>
						<td>
							<div class="input-field">
								<input placeholder="$0" id="Asking_Price" type="number" class="validate">
								<label for="Asking_Price">Asking Price</label>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="input-field col s3"><a class="waves-effect waves-light btn">Save</a>
			</div>
		</div>
	</div>
</div>
   </section>
 <!-- END WRAPPER -->
 </main>
<?php
include '../../includes/footer.php';
include '../../includes/end_html.php';
?>
