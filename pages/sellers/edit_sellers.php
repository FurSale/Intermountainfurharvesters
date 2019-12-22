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
               <div class="input-field col s9">
                 <i class="material-icons prefix">contacts</i>
                 <input placeholder="Trapper ID" id="trapper_id" name="trapper_id" type="text" class="validate" value="<?php echo $seller['trapper_id']; ?>">
                 <label for="trapper_id">Trapper ID</label>
               </div>
               <div class="input-field col s3">
                 <i class="material-icons prefix">attach_money</i>
                 <input id="commission" name="commission" type="number" class="validate" value="<?php echo $seller['commission']; ?>">
                 <label for="commission">Commission %</label>
               </div>
             </div>
             <div class="row">
             <div class="row">
               <div class="input-field col s6">
                 <div class="input-field col s6">
                   <i class="material-icons prefix">account_circle</i>
                   <input placeholder="First" id="first_name" name="first_name" type="text" class="validate" value="<?php echo $seller['first_name']; ?>">
                   <label for="first_name">First Name</label>
                 </div>
                 <div class="input-field col s6">
                   <input placeholder="Last" id="last_name" name="last_name" type="text" class="validate" value="<?php echo $seller['last_name']; ?>">
                   <label for="last_name">Last Name</label>
                 </div>
                <div class="input-field col s6">
                  <i class="material-icons prefix">contact_phone</i>
                  <input onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);" id="phone" name="phone" type="tel" class="validate" value="<?php echo $seller['phone']; ?>">
                  <label for="phone">Telephone</label>
                </div>
                 <div class="input-field col s6">
                   <i class="material-icons prefix">contact_mail</i>
                   <input placeholder="@" id="email" name="email" type="email" class="validate" value="<?php echo $seller['email']; ?>">
                   <label for="email">Email</label>
                 </div>
               </div>
                 <div class="input-field col s6 white-text">
                   <div class="card-content">
                   <div class="input-field col s12">
                     <i class="material-icons prefix">home</i>
                     <input placeholder="Address 1" id="address_1" name="address_1" type="text" class="validate" value="<?php echo $seller['address_1']; ?>">
                     <label for="address_1">Address 1</label>
                   </div>
                   <div class="input-field col s12">
                     <input placeholder="Address 2" id="address_2" name="address_2" type="text" class="validate" value="<?php echo $seller['address_2']; ?>">
                     <label for="address_2">Address 2</label>
                   </div>
                   <div class="input-field col s12">
                     <input id="city" name="city" type="text" class="validate" value="<?php echo $seller['city']; ?>">
                     <label for="city">City</label>
                   </div>
                  <div class="input-field col s6">
                    <select name="state" id="state">
                      <?php echo echo_states($seller['state']); ?>
                    </select>
                  </div>
                  <div class="input-field col s6">
                     <input id="zip" name="zip" type="number" class="validate" value="<?php echo $seller['zip']; ?>">
                     <label for="zip">Zip</label>
                   </div>
                 </div>
               </div>
             </div>
             <div class="input-field col s3"><input type="submit" name="submit" class="waves-effect waves-light btn submit" value="Save"></input></div>
           </form>
         </div>
         </div>
         <form id="main-form" method="post">
          <div id="editor-rows">
            <div class="row">
            <input id="[0]seller_id" name="items[0][seller_id]" type="hidden" value="<?php echo $seller['id']; ?>">
              <div class="input-field col s2">
                <i class="material-icons prefix">local_offer</i>
                <input name="items[0][lot]" type="text" class="validate">
                <label>Lot</label>
              </div>
              <div class="input-field col s2">
                <input list="items[0][item]" name="items[0][item]" class="select-item">
              <datalist id="items[0][item]">
                  <?php echo echo_item_types(); ?>
                </datalist>
                <input name="items[0][item_custom]" type="text" class="validate item-custom" style="display:none;">
                <input name="items[0][tag_id]" type="text" class="validate tag-ID" placeholder="Tag ID" style="display:none;">
              </div>
              <div class="input-field col s2">
                <div style="display: inline;"><label><input name="items[0][unit_of_measure]" value="ct" type="radio" class="radio-count" checked /><span>ct</span></label></div>
                <div style="display: inline;"><label><input name="items[0][unit_of_measure]" Value="lbs" type="radio" class="radio-lbs" /><span>lbs</span></label></div>
                <div style="display: inline;"><label><input name="items[0][unit_of_measure]" Value="oz" type="radio" class="radio-lbs" /><span>oz</span></label></div>
              </div>
              <div class="input-field col s1">
                <label>Qty</label>
                <input name="items[0][count]" type="number" class="validate">
              </div>
              <div class="input-field col s2">
                <label>Origin State</label>
                  <input list="items[0][origin_state]" name="items[0][origin_state]">
                <datalist id="items[0][origin_state]">
                  <?php echo echo_states(); ?>
                </datalist>
              </div>
              <div class="input-field col s1">
                <input name="items[0][asking]" type="number" class="validate">
                <label>Asking $</label>
              </div>
              <div class="input-field col s1">
                <!-- JS parent index number will need to be changed if this button is moved up or down in the DOM -->
                <a class="waves-effect waves-yellow red btn-small btn-delete-row">Delete</a>
              </div>
            </div>
          </div>
          </form>
          <div class="row">
            <span class="waves-effect waves-light btn" id="btn-add-row"><i class="material-icons left">add_box</i>Add Items</span>
            <span class="waves-effect waves-light btn" id="btn-save">Save</span>
          </div>
</section>
<script>
	var _editorRow = $("#editor-rows").html();
	var _rowIndex = 1;
	$(document).ready(function(){
		$( "#btn-add-row" ).click(function() {
			//Replace index
			var modified = _editorRow.toString().replace(/\[0\]/g, "["+_rowIndex+"]");
			$("#editor-rows").append(modified);
			//materialize
			$('#editor-rows select').formSelect();

			_rowIndex += 1;
		});
		$( "#btn-save" ).click(function() {
			$.ajax({
				type: "POST",
				url: "../items/add_items_post.php",
				data: $("#main-form").serialize(),
				success: function(data){
					console.log(data);
					if(data.success){
						M.toast({html:data.message});
						$("#editor-rows").html(_editorRow);
						//materialize
						$('#editor-rows select').formSelect();
					}else{
						M.toast({html:data.message});
					}
					//console.log(JSON.parse(data));
				},
        error:function(data){
          console.log(data.responseText);
        }
			});
		});

		$( "body" ).on("click", ".btn-delete-row", function(e) {
      $(this).parents().eq(1).remove();
		});

		$( "body" ).on("change", "input.select-item", function(e) {
			if($(this).val() == "Custom"){
				$(this).parents().eq(1).find("input.item-custom").css( "display", "block" );
			}else{
				$(this).parents().eq(1).find("input.item-custom").css( "display", "none" );
			}

			if($(this).val() == "Antlers" || $(this).val() == "Castor" ){
				$(this).parents().eq(2).find("input.radio-lbs").prop("checked", true);
			}

      if($(this).val() == "Bobcat"){
				$(this).parents().eq(1).find("input.tag-ID").css( "display", "block" );
			}else{
				$(this).parents().eq(1).find("input.tag-ID").css( "display", "none" );
			}
		});
	});
	</script>
 <!-- END WRAPPER -->
 </main>
<?php
include '../../includes/footer.php';
include '../../includes/end_html.php';
?>
