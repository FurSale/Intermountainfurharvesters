<?php
  require_once("../../includes/db_connection.php");
  require_once("../../includes/functions.php");

  if(!logged_in()){
    header("Location: ../login.php");
  }

  $seller['id'] = null;
  $seller['first_name'] = null;
  $seller['last_name'] = null;
  $seller['address_1'] = null;
  $seller['address_2'] = null;
  $seller['city'] = null;
  $seller['state'] = null;
  $seller['zip'] = null;
  $seller['phone'] = null;
  $seller['email'] = null;
  $seller['commission'] = 6.00;
  $seller['trapper_id'] = null;
  $seller['date_created'] = null;

  if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET["id"]);
    $query="SELECT * FROM `seller` WHERE `id`={$id}";
    $result=mysqli_query($connection, $query);
    //confirm_query($result);
    //Redirect to blog page if nothing returned from DB
    if(mysqli_num_rows($result) == 0){
      header("Location: list_sellers.php");
    }else{
      $seller=mysqli_fetch_array($result);
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
      $query = "INSERT INTO `seller` (`first_name`, `last_name`, `address_1`, `address_2`, `city`, `state`, `zip`, `phone`, `email`, `commission`, `trapper_id`, `date_created`)
      VALUES ('{$data['first_name']}', '{$data['last_name']}', '{$data['address_1']}', '{$data['address_2']}', '{$data['city']}', '{$data['state']}',
      '{$data['zip']}', '{$data['phone']}', '{$data['email']}', {$data['commission']}, '{$data['trapper_id']}', '{$date}')";
    }
    else{
      $query = "UPDATE `seller` SET
      `first_name` = '{$data['first_name']}', `last_name`='{$data['last_name']}', `address_1`='{$data['address_1']}',
      `address_2` = '{$data['address_2']}', `city`='{$data['city']}', `state`='{$data['state']}', `zip`='{$data['zip']}',
      `phone` = '{$data['phone']}', `email`='{$data['email']}', `commission`={$data['commission']}, `trapper_id`='{$data['trapper_id']}'
      WHERE `id` = {$data['id']}";
    }
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    if (mysqli_affected_rows($connection) == 1) {
      if($new){
        $success = "Seller added";
      }else{
        $success = "Seller updated";
      }
    } else {
      $error = "Couldn't update";
      $error .= "<br />" . mysqli_error($connection);
      $seller = $data;
    }

    if(!$new){
      //Get updated data from DB
      $query="SELECT * FROM `seller` WHERE `id`={$data['id']}";
      $result=mysqli_query($connection, $query);
      $seller=mysqli_fetch_array($result);
    }
  }

  //Set page title
  if(isset($_GET['id'])){
    $title = "Editing Seller";
  }else{
    $title = "Adding Seller";
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
           <input id="id" name="id" type="hidden" value="<?php echo $seller['id']; ?>">
             <div class="row">
               <div class="input-field col s3">
                 <i class="material-icons prefix">contacts</i>
                 <input placeholder="Trapper ID" id="trapper_id" name="trapper_id" type="text" class="validate" value="<?php echo $seller['trapper_id']; ?>"">
                 <label for="trapper_id">Trapper ID</label>
               </div>
             </div>
             <div class="row">
               <div class="input-field col s3">
                 <i class="material-icons prefix">account_circle</i>
                 <input id="first_name" name="first_name" type="text" class="validate" value="<?php echo $seller['first_name']; ?>">
                 <label for="first_name">First Name</label>
               </div>
               <div class="input-field col s3">
                 <input id="last_name" name="last_name" type="text" class="validate" value="<?php echo $seller['last_name']; ?>">
                 <label for="last_name">Last Name</label>
               </div>
              <div class="input-field col s3">
                <i class="material-icons prefix">contact_phone</i>
                <input id="phone" name="phone" type="tel" class="validate" value="<?php echo $seller['phone']; ?>">
                <label for="phone">Telephone</label>
              </div>
               <div class="input-field col s3">
                 <i class="material-icons prefix">contact_mail</i>
                 <input id="email" name="email" type="email" class="validate" value="<?php echo $seller['email']; ?>">
                 <label for="email">Email</label>
               </div>
             </div>
             <div class="row">
               <div class="input-field col s3">
                 <i class="material-icons prefix">home</i>
                 <input placeholder="Address 1" id="address_1" name="address_1" type="text" class="validate" value="<?php echo $seller['address_1']; ?>">
                 <label for="address_1">Address 1</label>
               </div>
               <div class="input-field col s3">
                 <input placeholder="Address 2" id="address_2" name="address_2" type="text" class="validate" value="<?php echo $seller['address_2']; ?>">
                 <label for="address_2">Address 2</label>
               </div>
               <div class="input-field col s3">
                 <input id="city" name="city" type="text" class="validate" value="<?php echo $seller['city']; ?>">
                 <label for="city">City</label>
               </div>
              <div class="input-field col s3">
                <select name="state" id="state">
                  <?php echo echo_states($seller['state']); ?>
                </select>
              </div>
             </div>
             <div class="row">
              <div class="input-field col s3">
                 <input id="zip" name="zip" type="number" class="validate" value="<?php echo $seller['zip']; ?>">
                 <label for="zip">Zip</label>
               </div>
               <div class="input-field col s3">
                 <input id="commission" name="commission" type="number" class="validate" value="<?php echo $seller['commission']; ?>">
                 <label for="commission">Commission %</label>
               </div>
              </div>
             <div class="input-field col s3"><input type="submit" name="submit" class="waves-effect waves-light btn submit" value="Save"></input></div>
           </form>
         </div>
          <!--Responsive Table-->
          <h4 class="header red">Below is Currently Disabled - Go to add items</h4>
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
              <th>Region</th>
              <th>Asking Price</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td><div class="input-field"> <i class="material-icons prefix">local_offer</i><input placeholder="#1000" id="lot" type="text" class="validate"><label for="lot">Lot #</label></div></td>
            <td><?php require_once("../../includes/itemtype.php"); ?>
              <div id="custom" class="hide"><input placeholder="Custom" type="text" class="validate">
            <label for="License">Custom</label></div></td>
            <td><div class="input-field"><input placeholder="1" id="Quantity" type="text" class="validate"><label for="Quantity">Quantity</label></div></td>
            <td><label><input name="group1" type="radio" id="item_count1" checked /><span>ct</span><label><input name="group1" type="radio" id="item_weight1" /><span>lbs</span></label></td>
            <td><?php require("../../includes/states.php"); ?></td>
            <td><div class="input-field"><input placeholder="$0" id="Asking_Price" type="number" class="validate"><label for="Asking_Price">Asking Price</label></div></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
       <div class="input-field col s3"><a class="waves-effect waves-light btn">Add another Item</a></div>
       <div class="input-field col s3"><a class="waves-effect waves-light btn">Save</a></div>
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
