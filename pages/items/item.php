<?php
  require_once("../../includes/db_connection.php");
  require_once("../../includes/functions.php");

  verify_logged_in(array("administrator"));

  if (!isset($_GET['id'])) {
      header("Location: list_items.php");
  }

  $item['id'] = null;
  $item['seller_id'] = null;
  $item['lot'] = null;
  $item['item'] = null;
  $item['unit_of_measure'] = null;
  $item['count'] = null;
  $item['tag_id'] = null;
  $item['asking'] = null;
  $item['origin_state'] = null;
  $item['bid_start'] = null;
  $item['bid_end'] = null;
  $item['sale_made'] = null;
  $item['date_created'] = null;

  $id = htmlspecialchars($_GET["id"]);
  $query="SELECT * FROM `seller_item` WHERE `id`={$id}";
  $result=mysqli_query($connection, $query);
  confirm_query($result);
  //Redirect if nothing returned from DB
  if (mysqli_num_rows($result) == 0) {
      header("Location: list_items.php");
  } else {
      $item=mysqli_fetch_array($result);
  }

  $query="SELECT * FROM `seller` WHERE `id`={$item['seller_id']}";
  $result=mysqli_query($connection, $query);
  confirm_query($result);
  $seller=mysqli_fetch_array($result);

  if (isset($_POST['submit'])) {
      //Safely escape all data in _POST
      $data = $_POST;
      foreach ($data as $key => $value) {
          if (is_string($value)) {
              $data[$key] = mysqli_real_escape_string($connection, $value);
          }
      }
      //Set the custom item type if custom
      if ($data['item'] == "Custom") {
          $data['item'] = $data['item_custom'];
      }

      $date = date("Y-m-d H:i:s");

      $query = "UPDATE `seller_item` SET
    `item` = '{$data['item']}', `unit_of_measure`='{$data['unit_of_measure']}', `count`='{$data['count']}', `origin_state`='{$data['origin_state']}',
    `asking` = '{$data['asking']}'
    WHERE `id` = {$data['id']}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);
      if (mysqli_affected_rows($connection) == 1) {
          header("Location: list_items.php");
      } else {
          $error = "Couldn't update";
          $error .= "<br />" . mysqli_error($connection);
          $item = $data;
      }

      //Get updated data from DB
      $query="SELECT * FROM `seller_item` WHERE `id`={$id}";
      $result=mysqli_query($connection, $query);
      $item=mysqli_fetch_array($result);
  }

  $itemBids = get_item_bids($item['id']);

  $itemStatus = "No Sale";
  if (count($itemBids) > 0) {
      if (get_winning_bid($item['id']) !== false) {
          $itemStatus = "Sold";
      } else {
          $itemStatus = "Low";
      }
  }
  function DeleteBid()
  {
      global $connection;
      $id = mysqli_real_escape_string($connection, $_GET['deleteID']);

      $query = "SELECT * FROM `bid` WHERE `id` = {$id}";
      $result = mysqli_query($connection, $query);
      confirm_query($result);
      if (mysqli_num_rows($result)!=1) {
          return array('success' => false, 'message' => null);
      }

      $bidData = mysqli_fetch_array($result);
      //Make sure the bid is this user's and it is not finalized
      if ($bidData['buyer_id'] == $_SESSION['username'] && $bidData['bid_status'] == "Unconfirmed") {
          $query = "DELETE FROM `bid` WHERE `id` = {$id}";
          $result = mysqli_query($connection, $query);
          confirm_query($result);
          if (mysqli_affected_rows($connection) == 1) {
              return array('success' => true, 'message' => "Bid deleted");
          } else {
              return array('success' => false, 'message' => "Couldn't update" . "<br />" . mysqli_error($connection));
          }
      } else {
          return array('success' => false, 'message' => "Cannot delete this bid");
      }
  }

    $pgsettings = array(
        "title" => "Edit Items",
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
<div class="row">
  <div class="col s1">Lot: #<?php echo $item['lot']; ?></div>
  <div class="col s4 offset-s1">Seller: <?php echo $seller['first_name']." ".$seller['last_name']; ?></div>
  <div class="col s4">Sold Status: <?php echo $itemStatus; ?></div>
</div>
<div class="row">
  <form method="post" class="col s12">
    <input id="id" name="id" type="hidden" value="<?php echo $item['id']; ?>">
    <div class="input-field col s2">
    <input list="item" name="item" class="select-item" value="<?php echo $item['item']; ?>">
    <datalist id="item">
        <?php echo echo_item_types(); ?>
      </datalist>
      <input name="item_custom" type="text" class="validate item-custom" style="display:none;">
      <input name="tag_id" type="text" class="validate tag-ID" placeholder="Tag ID" style="display:none;">
    </div>
    <div class="input-field col s2">
      <div style="display: inline;"><label><input name="unit_of_measure" value="ct" type="radio" class="radio-count" <?php if ($item['unit_of_measure'] == "ct") {
              echo "checked";
          } ?> /><span>ct</span></label></div>
      <div style="display: inline;"><label><input name="unit_of_measure" Value="lbs" type="radio" class="radio-lbs" <?php if ($item['unit_of_measure'] == "lbs") {
              echo "checked";
          } ?> /><span>lbs</span></label></div>
      <div style="display: inline;"><label><input name="unit_of_measure" Value="oz" type="radio" class="radio-lbs" <?php if ($item['unit_of_measure'] == "oz") {
              echo "checked";
          } ?> /><span>oz</span></label></div>
    </div>
    <div class="input-field col s1">
      <input name="count" type="number" class="validate" value="<?php echo $item['count']; ?>">
    </div>
    <div class="input-field col s2">
      <input list="origin_state" placeholder="State" name="origin_state" value="<?php echo $item['origin_state']; ?>">
      <datalist id="origin_state">
        <?php echo echo_states(); ?>
      </datalist>
    </div>
    <div class="input-field col s1">
      <input name="asking" type="number" min="0" class="validate" value="<?php echo $item['asking']; ?>">
    </div>
    <div class="col s3"><input type="submit" name="submit" class="waves-effect waves-light btn submit" value="Save"></input></div>
  </form>
</div>
<div class="row">
  <div class="col s2">Bids</div>
</div>
<div class="row">
  <div class="col s2">Buyer Name</div>
  <div class="col s2">Price</div>
  <div class="col s2">Date</div>
</div>
<?php
foreach ($itemBids as $bid) {
              $query="SELECT * FROM `buyer` WHERE `id`={$bid['buyer_id']}";
              $result=mysqli_query($connection, $query);
              confirm_query($result);
              $buyer=mysqli_fetch_array($result); ?>
<div class="row">
  <div class="col s2"><?php echo $buyer['first_name']." ".$buyer['last_name']; ?></div>
  <div class="col s2"><?php echo $bid['bid_amount']; ?></div>
  <div class="col s2"><?php echo format_date_timezone($bid['date_created']); ?></div>
  <div class="col s2"><a href="item.php?deleteID=<?php echo $bid['id']; ?>" class="btn waves-effect waves-light red" id="deletebid1"><i class="material-icons">close</i></a></div>
</div>
<?php
          }
?>

</section>
<script>
	$(document).ready(function(){
		$( "body" ).on("change", "input.select-item", function(e) {
			if($(this).val() == "Custom"){
				$(this).parents().eq(1).find("input.item-custom").css( "display", "block" );
			}else{
				$(this).parents().eq(1).find("input.item-custom").css( "display", "none" );
			}

			if($(this).val() == "Antlers" || $(this).val() == "Castor" ){
				$(this).parents().eq(2).find("input.radio-lbs").prop("checked", true);
			}
      if($(this).val() == "Antlers" || $(this).val() == "Castor" ){
				$(this).parents().eq(2).find("input.radio-oz").prop("checked", true);
			}

      if($(this).val() == "Bobcat"){
				$(this).parents().eq(1).find("input.tag-ID").css( "display", "block" );
			}else{
				$(this).parents().eq(1).find("input.tag-ID").css( "display", "none" );
			}
		});
	});
	</script>
<?php include '../../includes/end_html.php'; ?>
